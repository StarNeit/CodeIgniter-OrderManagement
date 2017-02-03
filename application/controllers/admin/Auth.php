<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends Admin_Controller
{
	function index()
	{
		return $this->login();
	}
	
	function login()
	{ 		
		$data['title'] = 'Login';
		$this->load->view('admin/login_view', $data);
	}

	function try_login()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata("error", validation_errors());
			admin_redirect("auth/login");
		}
		else{
			$username =$this->input->post("username");
			$password = $this->input->post("password");
			
			$this->load->model("admin_m");

			//we get user data if username and password match
			$user=$this->admin_m->login($username, $password);
			if($user){
				if($user->active) //user acount is active
				{
					unset($user->password);
					$session['logged'] = 'admin';
					$session['user'] = $user;
					$this->session->set_userdata($session);

					$this->admin_m->set_last_ip($user->id);

					$return_url = $this->session->userdata('return_url');
					if(!$return_url) $return_url = site_url("admin/dashboard");
                    redirect($return_url);
				}
				else
				{
                   $this->session->set_flashdata("error", "This account is not active");
				}
			}
			else{
		   		$this->session->set_flashdata("error", "Username or password are wrong");
			}
			admin_redirect("auth/login");
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		admin_redirect("auth/login");
	}


	function account()
	{
		$this->load->model('admin_m');
		$id= $this->session->userdata('user')->id;
		$data['title'] = "Edit your data";
		$data['item'] = $this->admin_m->get_record($id);
		$this->render('admin/admin_users/admin_users_account_view', $data);
	}

	function save_account()	{

		$this->load->model('admin_m');
		$user = $this->session->userdata('user');
    	$id = $user->id;

		$_POST['role_code'] = $user->role_code;
      $this->admin_m->save($id);
		$data = $this->admin_m->get_results();
		send_json($data);
	}

	function change_password(){

		$username = $this->session->userdata('user')->username;
		
		$this->load->library("form_validation");
		$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('new_password2', 'New Password Confirm', 'trim|required|matches[new_password]');
		if($this->form_validation->run()){
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password');
			$this->load->model('admin_m');
			if($this->admin_m->change_password($username, $current_password, $new_password)){
				$data['success'] = "Password was changed successfully";
				$data['reset'] = true;
			}
			else{
				$data['error'] = "Invalid current password";
			}
		}
		else{
			$data['error'] = validation_errors();
			$data['errors'] = $this->form_validation->get_errors();
		}
		$data['container'] = '#pass_message';
		send_json($data);
	}



	/**
	 *  Forot password form is sent
	 *	Checks if email exists in our database
	 *	Generate new password key and send an email to user
	 */
	public function forgot_password_request()
	{	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');	
		if($this->form_validation->run()==FALSE){
			$data['error'] = validation_errors();
			$data['errors'] = $this->form_validation->get_errors();
		}
		else{

			$email = $this->input->post('email');
			
			$this->load->model("admin_m");
			
			$user = $this->admin_m->forgot_password_request($email);
			if(!$user){
				$data['error'] = $this->admin_m->get_errors();
			}
			else{
				//send email with reset password link
				$d['email'] = $user->email;
				$d['subject'] = "Reset_password";
				$d['user'] = $user;
				$this->util->send_tpl_email('email/admin_reset_password', $d);

				$data['reset'] = true;
				$data['success'] = "Please check email";
			}
		}
		send_json($data);
	}


	/**
	 *  New password page, user accessed reset password link, from email
	 */	
	public function new_password($user_id='', $password_reset_key='')
	{
		$this->load->model("admin_m");
		
		$user = $this->admin_m->check_pass_key($user_id, $password_reset_key);
		$this->session->set_userdata('user', $user);
		if($user)
		{
			$data = array(
				'user' => $user,
				'password_reset_key' => $password_reset_key,
				'error' => $this->admin_m->get_errors(),
			);
			$this->render('admin/admin_users/admin_set_new_password', $data);
		}	
		else{	
			show_info_page($this->admin_m->get_errors(), 'error');
		}
	}

	/**
	 * User submited new password
	 */
	public function set_new_password()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('new_password2', 'New Password Confirm', 'trim|required|matches[new_password]');
		if($this->form_validation->run())
		{
			$username = $this->session->userdata('user')->username;
			$new_password = $this->input->post('new_password');
			$this->load->model('admin_m');
			if($this->admin_m->set_new_password($username, $new_password)){
				set_success("Password was changed successfully");
				$data['redirect'] = admin_url("auth/login");
			}
			else{
				$data['error'] = "Unexpected error occured";
			}
		}
		else{
			$data['reset'] = 1;
			$data['error'] = validation_errors();
			$data['errors'] = $this->form_validation->get_errors();
		}
		send_json($data);
	}


	/**
	 * Send an email to user with new generated password
	 *	This function is not more used
	 */
	public function reset_password($user_id="", $password_reset_key="")
	{
		$this->load->model('admin_m');
			
		$user = $this->admin_m->reset_password($user_id, $password_reset_key);
		if($user)
		{
			//send email with new password
			$d['email'] = $user->email;
			$d['subject'] = 'your_new_password';
			$d['user'] = $user;
			$this->util->send_tpl_email('email/admin_new_password', $d);
			$message = "You should receive an email with new password";
			show_info_page($message, $type='success');
		}
		else{
			$error = $this->users->get_errors();
			show_info_page($error, $type='error');
		}
	}



}