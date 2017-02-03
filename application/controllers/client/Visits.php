<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visits extends Client_Controller {

    public function __construct()
	{
		parent::__construct();

		$this->protect_user();

		$this->load->model('visits_m');	
                $this->load->model('cases_m');	
	}

	public function index($status = 'pending')
	{
            $total = array();
            
            $visits = $this->visits_m->get_visit_by_client($this->user_id,$status);

            $total['pending'] = $this->visits_m->get_visit_by_client($this->user_id,'Pending');
            $total['assigned'] = $this->visits_m->get_visit_by_client($this->user_id,'Assigned');
            $total['completed'] = $this->visits_m->get_visit_by_client($this->user_id,'Completed');
        
		$data = array(
                        'visits'=>$visits,
			'title' => 'Schedule Visit',
                        'total'=>$total,
		);
	
		$this->render('client/visits_view', $data);	
	}
        
        public function details($visit_id){
          $this->load->model('recipients_m');
          $this->load->model('carepro_m');
          $this->load->model('users_m');
          
            $data = array(
                    'title' => 'Visit Details',
                    'visit' =>$this->visits_m->visit_details($visit_id),
            );
            $this->render('client/visit_details', $data);	
        }

}

/* End of file Visits.php */
/* Location: ./application/controllers/client/Visits.php */