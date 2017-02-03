<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends Care_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->protect_user();
		
		$this->load->model('availability_m');
		$this->load->model('carepro_m');

	}

	public function index()
	{
		$data = array(
			'title' => 'Care Calendar',
			'is_calendar' => true,
		);
	
		$this->render('carepro/calendar_view', $data);
	}


	/**
	 * AJAX - return mentor availability for calendar in JSON format
	 */
	public function schedule()
	{
		$start =  $this->input->get('start');
		$end =  $this->input->get('end');
		$events = $this->availability_m->get_schedule($start, $end, $this->user_id);
		echo json_encode($events, JSON_NUMERIC_CHECK);
		exit;
	}

	/**
	 * AJAX::POST - mentor create an available slot
	 */
	public function save_schedule()
	{
		$id = $this->input->post('id');
		$_POST['user_id'] = $this->user_id;
		$_POST['all_day'] = $this->input->post('allDay')=='true' ? 1 :0;
	
		$id = $this->availability_m->save($id);

		$data['id'] = $id;
		echo json_encode($data, JSON_NUMERIC_CHECK);
	}

	public function delete_schedule()
	{
		$id = $this->input->post('id');
		$this->availability_m->delete_record($id);
	}

	public function visits()
	{
		$start =  $this->input->get('start');
		$end =  $this->input->get('end');

		$user = $this->carepro_m->get_user($this->user_id);
		$carepro_id = $user->carepro_id;

		$this->load->model('visits_m');
		$events = $this->visits_m->carepro_visits($start, $end, $carepro_id);
		

		echo json_encode($events, JSON_NUMERIC_CHECK);
		exit;
	}

	/**
	 * show visits details popup
	 */
	public function visit_details()
	{
		$this->load->model('cases_m');
		$this->load->model('visits_m');
		$date = $this->input->get('date');

		//get visits_ids for this date
		$user = $this->carepro_m->get_user($this->user_id);
		$carepro_id = $user->carepro_id;
		$items = $this->visits_m->carepro_visit_details($date, $carepro_id);
		
	
		$data = array(
			'items' => $items,
			'date' => $date,
		);

		$this->load->view('carepro/visit_popup', $data);
	}


}

/* End of file Calendar.php */
/* Location: ./application/controllers/carepro/Calendar.php */