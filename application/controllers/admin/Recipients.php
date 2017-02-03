<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recipients extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('cases_m');
		$this->load->model('recipients_m');
		$this->load->model('clients_m');

	}

	public function index($status = 'new', $offset = 0)
	{
		$q = $this->input->get('q');
		$filter = array(
			'status' => $status,
			'services' => true,
			'upcoming' => true,
		);
		if($q!=''){                        
                $filter = array('q' => $q,
                	'status' => $status,
					'services' => true,
					'upcoming' => true,);
            }
		$items = $this->cases_m->get_items($filter, $offset=0,100);
	

		$data = array(
			'title' => "Recipients",
			'items' => $items,
		);

		$this->render('admin/recipients/recipients_view', $data);
	}

	public function details($id = '')
	{
		$case = $this->cases_m->get_case($id);
		$recipient = $this->recipients_m->get_recipient($case->recipient_id);
		$client  = $this->clients_m->get_client($recipient->user_id);

		$data = array(
			'title' => $recipient->full_name,
			'case' => $case,
			'recipient' => $recipient,
			'client' => $client,
		);
		$this->render('admin/recipients/recipient_detail', $data);
	}

	public function save_details()
	{		
		$validate = array(
                        'relationship',
			'salutation',
			'first_name',
			'last_name',
			'dob',
			'gender',
			'nric',
			'race',			
			'weight',
			'height',
			'medical_condition',
			'diagnosis',			
		);

	
		$id = $this->input->post('recipient_id');
		$recipient_id = $this->recipients_m->save($id, $validate);
		$data = $this->recipients_m->get_results();
		if($recipient_id)
		{
			$this->recipients_m->update_record(array('photo' => $this->input->post('photo')), $recipient_id);	
			set_success('Changes saved');
		}
		send_json($data);
	}

		

	public function visit_request($recipient_id = null)
	{
		$recipient = $this->recipients_m->get_recipient($recipient_id);
		$case_id = $this->cases_m->recipient_case_id($recipient_id);
		$case = $this->cases_m->get_case($case_id, true);

		$data = array(
			'title' => $recipient->full_name,
			'case'	=> $case,
			'locations' => $case->locations,
			'recipient' => $recipient,
		);
		$this->render('admin/recipients/visit_request', $data);
	}

	public function visit_history()
	{
		
	}
	//$client_id
	public function add($client_id=null){

		$clients  = $this->clients_m->clientLists();

		$data = array(
			'title' => "Recipients",
			'clients' => $clients,
			'user_id' => $client_id,
		);

		$this->render('admin/recipients/recipients_add', $data);
	}

	public function save_new()
	{		
		$validate = array(
			'user_id',
			'relationship',
			'salutation',
			'first_name',
			'last_name',
			'dob',
			'gender',
			'nric',
			'race',			
			'weight',
			'height',
			'medical_condition',
			'diagnosis',			
		);
		$id=0;

		$recipient_id = $this->recipients_m->save($id, $validate);
		$data = $this->recipients_m->get_results();
		if($recipient_id)
		{
                    $case = array(
                        'recipient_id'=>$recipient_id,
                        'created_by'=>'Staff',
                        'created_at'=>date('Y-m-d'),
                        'admin_id'=>$this->session->userdata('user')->id
                    );
                    $this->db->insert('case',$case);
                    set_success('Changes saved');
                    $data['redirect'] = admin_url("recipients/visit_request/$recipient_id");
		}
		send_json($data);
	}

	public function save_request(){
            
		$validate = array(
			'recipient_id',
			'postal_code',
		    'unit',
		    'block',
		    'street',
		    'gender_pref',
		    'full_care',
		    'skill[]',	      
		    'special_instructions',	
		    'language[]',
		    'created_by', 
		    'created_at',	    
		);

		//prepopulate some fields		
		$_POST['created_by'] = 'Staff';
		$_POST['created_at'] = date(DATE);
                
		$id = $this->input->post('id');
		$recipient_id = $this->input->post('recipient_id');

        //show add visit button at recipient listing if admin have updated case_checklist table
        if(count($this->input->post('checklist'))>0)
        {   
            $validate[] = 'staff_updated';
            $_POST['staff_updated'] = date(DATE);
        }
                
		$case_id = $this->cases_m->save($id, $validate);
		$data = $this->cases_m->get_results();
		if($case_id)
		{
			//save location	at case_location		
			$location = array(
				'block' => $this->input->post('block'),
				'unit' => $this->input->post('unit'),
				'street' => $this->input->post('street'),
				'postal_code' => $this->input->post('postal_code'),
				'case_id' => $case_id,
			);
			$this->cases_m->save_location($location, $this->input->post('location_id'));

                        //save location at recipient location
                        unset($location['case_id']);
                        $location['recipient_id'] = $recipient_id;
                        
                        $loc = $this->recipients_m->get_recipient_location($recipient_id);
                        
                        if($loc!==false)
                            $this->recipients_m->save_location($location, $loc->id);
                        else
                            $this->recipients_m->save_location($location,'');
                        
			//save language at case_language
			$this->cases_m->save_languages($this->input->post('language'), $case_id);
                        
                        //save language at recipient_language
			$this->recipients_m->save_languages($this->input->post('language'), $recipient_id);

			//save skills 
			$this->cases_m->save_skills($this->input->post('skill'), $case_id);


			//save skills checklist 
			$this->cases_m->save_checklist($this->input->post('item'),$this->input->post('checklist'), $case_id);


			set_success('Changes saved');
			$data['redirect'] = admin_url("recipients/visit_request/$recipient_id");
			
		}
		send_json($data);
	}

	function add_case_skill()
	{
		$case_id = $this->input->post('case_id');
		$skill_id = $this->input->post('skill_id');
		$is_checked = $this->input->post('is_checked');
		$is_active = $is_checked =='true' ? 1 : 0;

		$this->cases_m->save_case_skill($case_id, $skill_id, $is_active);
	}
        
        function history($recipient_id,$offset=0){
            $this->load->model('visits_m');
            
                 $filter = array(
			'services' => true,
                        'recipient_id'=>$recipient_id
		);
		$count = $this->visits_m->get_count($filter);
	
		// pagination
		$config = array(
			'base_url' => admin_url("recipients/history/".$recipient_id),
			'uri_segment' => 5,
			'total_rows' => $count,
			'per_page' => LIMIT,
		);
		$this->load->library('pagination');
		$this->pagination->initialize($config);

                $items =  $this->visits_m->get_items($filter, $offset);
                $recipient =  $this->recipients_m->get_record($recipient_id);
                
                $data = array(
			'title' => "Visit History",
			'items' => $items,
                        'recipient'=>$recipient,
		);		

		$this->render("admin/recipients/recipients_history", $data);
        }


}