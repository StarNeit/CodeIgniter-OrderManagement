<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends Care_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->protect_user();
		$this->load->model('visits_m');	
	}	
		
	/**
	 * Upcomming Cases
	 */
	public function index($status = 'pending')
	{
                $this->load->model('carepro_m');	
                $total = array();
		$visits = $this->visits_m->get_visit_by_carepro($this->user_id,$status);
                
                $total['pending'] = $this->visits_m->get_visit_by_carepro($this->user_id,'Pending');
                $total['assigned'] = $this->visits_m->get_visit_by_carepro($this->user_id,'Assigned');
                $total['completed'] = $this->visits_m->get_visit_by_carepro($this->user_id,'Completed');

		$data = array(
			'visits'=> $visits,
			'title' => 'Upcoming Cases',
                        'total'=>$total,
		);
	
		$this->render('carepro/case_upcoming_view', $data);	
	}

	public function bids()
	{
		$data = array(
			'title' => 'Bids View',
		);
	
		$this->render('carepro/case_bids_view', $data);	
	}

	/**
	 * Bid for a case page
	 */
	public function bid($visit_id='')
	{
		$this->load->model('carepro_m');

		$visit = $this->visits_m->get_visit($visit_id);
		$services = $this->cases_m->case_services_skills($visit->case->skills);

//		$carepro_skills = $this->carepro_m->user_skills($this->user_id);
                $skill = $this->visits_m->visit_skill_ids($visit_id);
		$matched_skill = $this->visits_m->visit_match_carepro($this->user_id,explode(',',$skill['skill_ids']));
		$matching_services = $this->cases_m->case_services_skills(explode(',',$matched_skill['skill_ids']));     
		$past_visits = $this->visits_m->past_visit_summary($visit->case_id);
	
		$data = array(
			'title' => 'Case Bid',
			'visit' => $visit,
			'recipient' => $visit->recipient,
			'case' => $visit->case,
			'services' => $services,
			'matching_services' => $matching_services,
			'past_visits' => $past_visits,
		);
//                echo "<pre>";
//                var_dump($data);exit();
		$this->render('carepro/case_bid_view', $data);	
	}
        
        public function bid_visit(){
            $this->load->model('carepro_m');
            $carepro = $this->carepro_m->get_record(array('user_id'=>$this->user_id));
            
            $data = array();
            $visit_id = $_POST['visit_id'];
            
            if(!isset($_POST['visit_id']) && $_POST['visit_id']==''){
                $data['error'] = 'Visit not found!';
                send_json($data);
            }
            
            $visit = $this->visits_m->get_record($visit_id,true);
            
            if($visit->status!='Pending'){
                $data['error'] = 'Visit not found!';
                send_json($data);
            }

            $visit_carepro = $this->visits_m->check_bid($carepro->id, $visit_id);
            
            if($visit_carepro===false){
                $data['error'] = 'This visit already bid!';
                send_json($data);
            }
                
            $result = $this->db->insert('visit_carepro',array('visit_id'=>$visit_id,'carepro_id'=>$carepro->id,'status'=>'Bid','bid_at'=>date('Y-m-d H:i:s')));
            
            if($result){
                set_success('Successfully bid visit');	
                $data['redirect'] = base_url('carepro/cases/bid/'.$visit_id);
                send_json($data);
            }else
                send_json($data['network error']);
            
                
        }

}

/* End of file Cases.php */
/* Location: ./application/controllers/carepro/Case.php */