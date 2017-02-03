<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Site_Controller {

	public function index()
	{
		$data = array(
			'title' => 'Login',
			'meta_d' => '',
		);
		$this->render('login-view', $data);		
	}

	function post()
	{
		$this->load->model('users_m');
		
		$this->load->library("form_validation");
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			set_error(validation_errors());
			redirect("login");
		}
		else
		{
			$this->load->model("users_m");
			
			$email=$this->input->post("email");
			$password = $this->input->post("password");

			$user=$this->users_m->login($email, $password);
			if($user)
			{
                            if($user->is_active==0)
                            {
                                set_error("Your account is not active.");
				redirect("login");
                            }
				$this->util->create_user_session($user);
				/*$return_url = $this->session->userdata('return_url');
				if($return_url){
					redirect($return_url);
				}*/
				
				if($user->user_type=='CarePro'){
					redirect(care_url('calendar'));
				}
				else{
					redirect(client_url('care_recipients'));
				}
			}
			else{
		   		set_error("Username or password are wrong");
				redirect("login");
			}
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect("login");
	}

	public function forgot_password()
	{
		$data = array(
			'title' => 'Forgot Password',
		);
		$this->render('forgot-password', $data);		
	}

	public function reset()
	{
		$this->load->model('users_m');
		$this->load->helper('string');
		$this->load->library('email');
		$this->load->library("form_validation");

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == FALSE)
		{
			set_error(validation_errors());
			redirect("forgot-password");
		}
		else
		{
			$email = $this->input->post("email");
			$user = $this->users_m->get_user_by_email($email);

			if ($user) {
				$new_passord = random_string('alnum', 8);
				$this->users_m->set_password($new_passord,$user->id);
				$user->password = $new_passord;
				$data['user'] = $user;

                        //send email
			$e = array(
				'subject' => 'Homage : Reset Password',
                                'email'=>$user->email,
                                'user'=>$data['user']
			);
                        
			$result = $this->util->send_tpl_email('email/user_new_password', $e);
                        set_success("We have reset your password. Please check your email");
                        redirect(base_url());
			}
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */