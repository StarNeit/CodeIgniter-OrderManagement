<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Care_calendar extends Client_Controller {

	public function index()
	{
		$data = array(
			'title' => 'Care Calendar',
			'is_calendar' => true,
		);
	
		$this->render('client/care_calendar_view', $data);	
	}

	public function visits_json($value='')
	{
		$this->load->model('cases_m');
		$this->load->model('visits_m');
		
		$start =  $this->input->get('start');
		$end =  $this->input->get('end');

		//get user case_ids
		$case_ids = $this->cases_m->user_case_ids($this->user_id);
	
		$events = array();
		if($case_ids)
		{	
			$events = $this->visits_m->all_visits_schedule($start, $end, $case_ids);
			
		}
		echo json_encode($events, JSON_NUMERIC_CHECK);
		exit;
	}

	public function visit_details()
	{
		$this->load->model('cases_m');
		$this->load->model('visits_m');

		$date = $this->input->get('date');
		
		$filter = array(
			'date' => $date,
			'user_id'  => $this->user_id,
		);
		$items = $this->visits_m->get_items($filter);
		
		$data = array(
			'items' => $items,
			'date' => $date,
		);

		$this->load->view('client/visit_popup', $data);
	}

}

/* End of file Care_calendar.php */
/* Location: ./application/controllers/client/Care_calendar.php */