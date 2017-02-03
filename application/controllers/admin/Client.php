<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_m');
		$this->load->model('clients_m');
                $this->load->model('recipients_m');
	}

	public function index()
	{
        $this->load->model('clients_m');
        $q = $this->input->get('q')!='' ? $this->input->get('q'): $this->uri->segment(6);

		$orderby = $this->uri->segment(4);
		$order = $this->uri->segment(5);
		if($orderby==''){
			$orderby ='first_name';
			$order ='asc';
		}
		$url = admin_url("client/index/");

		if($q=='')                        
            $q = 'Nil';

        $filter = array('q' => $q,'orderby'=>$orderby,'order'=>$order);
        $limit = LIMIT;
        
        $count_clients = $this->clients_m->get_count($filter);

        
        $config['base_url'] = admin_url("client/index/".$orderby."/".$order."/");

        $config['uri_segment'] = 7;
		$config['per_page'] = $limit;
		$config['total_rows'] = $count_clients;
		$this->load->library('pagination');
		$this->pagination->initialize($config);
        
        $offset = $this->uri->segment(7)!='' ? $this->uri->segment(7): 0;
        $items = $this->clients_m->get_items($filter,$offset,$limit);

        $data = array(
        	'items' => $items,
        	'url' =>$url,
			'orderby' => $orderby,
			'order'	=> $order,
			'keyword' => $q,
        );

        $this->render('admin/client/client_list', $data);
	}
        
        function activate(){
		$id = $this->input->post('id');		
		echo $this->users_m->activate($id, 'is_active');
	}

	public function add()
	{
		return $this->details(0);
	}
	
	public function details($user_id='')
	{
		$user = $this->clients_m->get_client($user_id);
		$data = array(
			'user' =>$user,
			'title' => $user->id ? $user->full_name : 'Add Client',
		);
		$this->render('admin/client/client_details', $data);
	}

	public function save_details()
	{
		//fields to validate 
		$validate = array(		
			'salutation', 
		    'first_name', 
		    'last_name', 
		    'registered_at', 
		    'email', 
		    'contact_home', 
		    'contact_mobile', 
		    'postal_code', 
		    'unit', 
		    'block', 
		    'street', 	
		    'user_type',	    
		);

		$fields = $this->clients_m->get_from_post($validate);		
		$data = $this->clients_m->get_results();

		if(isset($data['success']))
		{
			$user_id = $this->input->post('id');

			//save user data
			$fields_to_save = array(
				'salutation',
				'email',			
				'first_name',
				'last_name',
				'contact_home',
				'contact_mobile',
				'registered_at', 
				'user_type',	
			);
			if($_POST['registered_at']!='')
                            $_POST['registered_at'] = dbdate($_POST['registered_at']);

			$user_id = $this->users_m->save($user_id, $fields_to_save);		
			

			//SAVE ADDRESS
			$this->load->model('user_location_m');
			if($user_id)
			{			
				//update address
                                $_POST['user_id'] = $user_id;
                                
                                if($this->input->post('id')=='')
                                    $this->user_location_m->save();
                                else
                                    $this->user_location_m->save(array('user_id' => $user_id));
			}
			else
			{
				//insert address
				$_POST['user_id'] = $user_id;
				$this->user_location_m->save();				
			}	


			$data['redirect'] = admin_url("client/details/$user_id");
			$data['success'] = 'Changes saved';		
			set_success('Changes saved!');	
		
		}
		send_json($data);

	}

	public function payment($user_id)
	{
		$user = $this->clients_m->get_client($user_id);
		$data = array(
			'user' =>$user,
		);
		$this->render('admin/client/client_payment', $data);
	}

	public function account($user_id)
	{
		$user = $this->clients_m->get_client($user_id);
		$data = array(
			'user' =>$user,
		);
		$this->render('admin/client/client_account', $data);
	}

	public function save_account()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_id', 'UserID', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');

		if($this->form_validation->run() == TRUE) 
		{
			$user_id = $this->input->post('user_id');
			
			//change password if exists
			if($password = $this->input->post('password'))
			{
				$this->users_m->set_password($password, $user_id);
			}

			//update email 
			$email = $this->input->post('email');
			$this->users_m->update_record(array('email' => $email), $user_id);
		

			set_success("Changes saved");
			$data['redirect'] = admin_url("client/account/$user_id");
		}
		else {
			$data['error'] = validation_errors();
		}
		send_json($data);

	}
        
        function recipient($user_id){
            
            $user = $this->clients_m->get_client($user_id);
            $data = array(
                    'user' =>$user,
                    'title' => 'Care Recipient',
                    'recipients'=>$this->recipients_m->get_recipient_by_client_id($user->id),
            );
//            var_dump($data['recipients']);die();
            $this->render('admin/client/client_recipient',$data);
        }

}