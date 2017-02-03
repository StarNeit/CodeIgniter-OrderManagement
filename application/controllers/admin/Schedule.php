<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('carepro_m');
		$this->load->model('users_m');
		$this->load->model('availability_m');
		$this->load->model('visits_m');
       }
        
	public function index()
	{	          

            $data = array(                  
				'title' => 'Summary Schedule',
            );
            
            $this->render('admin/schedule/schedule_summary_view',$data);
	}

	/**
	 * return slots with number of carepro available each day
	 */
	public function availability_json()
	{
		
		$start =  $this->input->get('start');
		$end =  $this->input->get('end');
		$events = $this->availability_m->all_users_schedule($start, $end);
		echo json_encode($events, JSON_NUMERIC_CHECK);
		exit;
	}

	public function visits_json()
	{
		$start =  $this->input->get('start');
		$end =  $this->input->get('end');

		
		$events = $this->visits_m->all_visits_schedule($start, $end);
		echo json_encode($events, JSON_NUMERIC_CHECK);
		exit;
	}

	public function day_availablity()
	{
		$date = $this->input->get('date');

		$items = $this->availability_m->carepro_day_availablity($date);
		$data = array(
			'items' => $items,
			'date' => $date,
		);

		$this->load->view('admin/schedule/day_availablity_view', $data);
	}

	public function visit_details()
	{
		$date = $this->input->get('date');
		
		$items = $this->visits_m->get_items(array('date' => $date));

		$data = array(
			'items' => $items,
			'date' => $date,
		);

		$this->load->view('admin/schedule/visit_details', $data);
	}


	
}