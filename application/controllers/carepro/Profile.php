<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Care_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->protect_user();
		$this->load->model('carepro_m');
	}

	public function index()
	{
		$user = $this->carepro_m->get_user($this->user_id);

		$rating = $this->carepro_m->get_rating($this->user_id);
		
		$tasks = $this->carepro_m->get_tasks($this->user_id);
		$services = $this->carepro_m->user_services($user->skills);

		$data = array(
			'user' => $user,
			'title' => 'Profile',
			'rating' => $rating,
			'tasks'	=> $tasks,
			'services' => $services,
		);	
		$this->render('carepro/profile_view', $data);	
	}

	public function edit()
	{
		$user = $this->carepro_m->get_user($this->user_id);

		$data = array(
			'user' => $user,
			'title' => 'Edit Profile',
		);
	
		$this->render('carepro/edit_profile_view', $data);	
	}

	public function account()
	{
		$user = $this->carepro_m->get_user($this->user_id);

		$data = array(
			'user' => $user,
			'title' => 'Account Settings',
		);
	
		$this->render('carepro/account_view', $data);	
	}

	public function save()
	{
		$this->load->model('users_m');

		$validate = array(
			'first_name', 
		    'last_name', 
		    'gender', 
		    'race', 
		    'dob', 
                    'summary',
		    'skill[]',
		);
		$fields = $this->carepro_m->get_from_post($validate);		
		$data = $this->carepro_m->get_results();

		if($fields)
		{

			$user_id = $this->user_id;

			//save user data
			$fields_to_update = array(					
				'first_name',
				'last_name',				
			);
			
			$id = $this->users_m->save($user_id, $fields_to_update);

			if($id)
			{
				//update carepro fields
				$this->carepro_m->update_record($fields, array('user_id' => $user_id));	

				//save carepro skills
				$this->carepro_m->save_skills($this->input->post('skill'), $user_id);			
			}			

			$data['redirect'] = care_url("profile");		
			set_success('You have successfully change your profile!');	
		
		}
		send_json($data);
	}
	public function save_account()
	{
		$this->load->model('users_m');
		$this->load->library('form_validation');

		$fields = array(
			'old_password' => $this->input->post('old_password'), 
		    'new_password' => $this->input->post('new_password'), 
		    'confirm_password' => $this->input->post('confirm_password'), 
		);
		
		$this->form_validation->set_rules('old_password', 'Old Password', 'required');
	    $this->form_validation->set_rules('new_password', 'New Password', 'required');
	    $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required');

	    if ($this->form_validation->run() == FALSE)
	    {
	    	$data['error'] = validation_errors();
	        send_json($data);
	    }
	    else
	    {
	    	$user_id = $this->user_id;
	    	if ($fields['new_password']==$fields['confirm_password']) {
	    		$save = $this->users_m->update_password($user_id, $fields['old_password'],$fields['new_password']);
	    		if ($save) {
	    			$data['redirect'] = care_url('profile/account');
					set_success('You have successfully change your password!');
					send_json($data);	
	    		}else{
	    			$data['error'] = "Wrong Old password";
	    			send_json($data);
	    		}
	    	}else{
	    		$data['error'] = "New Passwords are not same";
	    		send_json($data);
	    	}
	    }
	    
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/carepro/Profile.php */