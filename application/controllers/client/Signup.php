<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('clients_m');
		$this->load->model('users_m');

	}

	public function index()
	{
		$user = $this->clients_m->get_client(0);
		$data = array(
			'title' => 'New account registration',
			'user' => $user,
		);
	
		$this->render('client/signup_view', $data);	
	}

	public function submit()
	{
		$_POST['user_type'] = 'Client';
		$_POST['registered_at'] = date(DATE);

		$validate = array(
			'salutation',
			'first_name',
			'last_name',
			'email',
			'contact_home',
			'contact_mobile',
			'password',
			'password2',
			'user_type',
			'registered_at',			
			'postal_code',
			'unit',
			'block',
			'street',			
			'know_how',
			'agreement',
		);

		$fields = $this->clients_m->get_from_post($validate);		
                
                $password = $_POST['password'];
		$data = $this->clients_m->get_results();

		if(isset($data['success']))
		{
                    if($_POST['email']!='')
                    {
                        $usr = $this->users_m->get_record(array('email'=>$_POST['email']),false);
                        if($usr!==false){
                            $data['error'] = 'Email already existed.';
                            send_json($data);
                        }
                    }
			//create user Care Pro account
			$user_id = $this->users_m->create_account_from_post();
			if(!$user_id){
				$data = $this->users_m->get_results();
				send_json($data);
			}

			//save client related data (user_id, know_how)
			$fields['user_id'] = $user_id;			
			$this->clients_m->insert_record($fields);

			//SAVE ADDRESS
			$this->load->model('user_location_m');	
                        $_POST['user_id'] = $user_id;
			$this->user_location_m->save();				
				

			$user = $this->users_m->get_record($user_id);
			$this->util->create_user_session($user);

                        $emailData = array(
                            'name'=>$_POST['first_name'].' '.$_POST['last_name'],
                            'email'=>$_POST['email'],
                            'password'=>$password,
                        );

                        //send email
			$e = array(
				'subject' => 'Homage : Client Signup',
                                'email'=>$emailData['email'],
                                'user'=>$emailData
			);
                        
			$this->util->send_tpl_email('email/client_signup_email', $e);
                        
			$data['redirect'] = client_url("wizard");
			$data['success'] = 'Changes saved';		
			set_success('Changes saved!');	
		
		}
		send_json($data);	
	}

}

/* End of file Signup.php */
/* Location: ./application/controllers/client/Signup.php */