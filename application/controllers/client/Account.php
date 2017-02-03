<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Client_Controller {

	public function __construct()
	{
		parent::__construct();

		//allow only logged clients to acess this pages
		$this->protect_user();
		
		$this->load->model('clients_m');
		$this->load->model('users_m');
	}

	
	/**
	 * Change password page
	 */
	public function index()
	{
		$user = $this->clients_m->get_client($this->user_id);

		$data = array(
			'title' => 'Account',
			'user' => $user,
		);
	
		$this->render('client/account_view', $data);	
	}

	/**
	 * My Particulars - Update profile details
	 */
	public function particulars()
	{
		$user = $this->clients_m->get_client($this->user_id);

		$data = array(
			'title' => 'Update particulars',
			'user' => $user,
		);
	
		$this->render('client/particulars_view', $data);	
	}

	public function particulars_update()
	{
		$validate = array(
			'first_name','last_name','email', 'contact_home', 'contact_mobile','postal_code','unit','block', 'street'
		);

		//validate fields
		$this->clients_m->get_from_post($validate);
		$data = $this->clients_m->get_results();

		if(isset($data['success']))
		{
			$fields = array('first_name','last_name','email', 'contact_home', 'contact_mobile');
			$this->users_m->save($this->user_id, $fields);

			//save address
			$this->users_m->save_address_from_post($this->user_id);

			$data['success'] = 'Successfully update profile!';
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
	    			$data['redirect'] = client_url('account');
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

/* End of file Account.php */
/* Location: ./application/controllers/client/Account.php */