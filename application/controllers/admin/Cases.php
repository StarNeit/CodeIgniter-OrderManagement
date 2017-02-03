<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('cases_m');
		$this->load->model('recipients_m');
		$this->load->model('clients_m');

	}

	public function index($status = '', $offset = 0)
	{
		$filter = array(
			'status' => $status,
		);
		$items = $this->cases_m->get_items($filter, $offset=0);
		
		//preg($items); die();

		$data = array(
			'title' => "Cases",
			'items' => $items,
		);

		$this->render('admin/cases/cases_view', $data);
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
		$this->render('admin/cases/case_detail', $data);
	}

	public function save_details()
	{		
		$validate = array(
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
			set_success('Changes saved');
		}
		send_json($data);
	}

		

	public function visit_request($id = '')
	{
		$case = $this->cases_m->get_case($id);

		$data = array(
			'title' => 'cases',
			'case'	=> $case,
		);
		$this->render('admin/cases/visit_request', $data);
	}

	public function visit_history()
	{
		
	}

}