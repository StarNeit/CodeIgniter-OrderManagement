<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visits extends Admin_Controller {

	
	function __construct()
	{
		parent::__construct();
		$this->load->model('visits_m');
		
		
	}

	public function index($status='pending',$offset = 0)
	{ 	
		$filter = array(
			'services' => true,
                        'visit_status'=>$status
		);
		$count = $this->visits_m->get_count($filter);
	
		// pagination
		$config = array(
			'base_url' => admin_url("visits/index/"),
			'uri_segment' => 4,
			'total_rows' => $count,
			'per_page' => LIMIT,
		);
		$this->load->library('pagination');
		$this->pagination->initialize($config);

        $items =  $this->visits_m->get_items($filter, $offset);
        
        $count_pending = $this->visits_m->get_count(array('visit_status' => 'pending'));
        $count_assigned = $this->visits_m->get_count(array('visit_status' => 'assigned'));
        $count_completed = $this->visits_m->get_count(array('visit_status' => 'completed'));
        
        
        
        
        

		$data = array(
			'title' => "Visits",
			'items' => $items,
                        'count_pending'=>$count_pending,
                        'count_assigned'=>$count_assigned,
                        'count_completed'=>$count_completed,
		);		

		$this->render("admin/visits/visits_view", $data);
	}

    public function detail($visit_id = ''){
            $data = array(
			'title' => "Visits Details",
			'visit' => $this->visits_m->get_visit_by_id($visit_id),
			'carepros' => $this->visits_m->get_matching_carepro($visit_id),
                        'skills_array'=>$this->visits_m->get_skills(),
		);		
//echo "<pre>";
//var_dump($data);exit();
		$this->render("admin/visits/visits_edit", $data);
    }
	
	function save()
	{
    	$id = $this->input->post('id');
    	$case_id = $this->input->post('case_id');

    	$validate = array(
			'case_id',
			'postal_code',
			'unit',
			'block',
			'street',					
			'language[]',
			'special_instructions',
			'repeat',
			'full_day',
			'last_updated', 
		);		

		
		if($this->input->post('full_day'))
		{
			//24hrs care
			$validate = array_merge($validate, array(
				'visit_from',
				'visit_to',				
			));
		}
		else
		{	//user selected to repeat schedule	
			if($this->input->post('repeat')){
				$validate = array_merge($validate, array(
					'repeat_start[]',
					'repeat_end[]',
					'repeat_days[]',
					'repeat_from',
					'repeat_to',			
				));
			}
			else
			{
				//one day visit
				$validate = array_merge($validate, array(
					'one_day_date',
					'one_day_start',
					'one_day_end',		
				));
			}
		}
		$_POST['last_updated'] = date(DATE);

		$fields = $this->visits_m->get_from_post($validate);
    	$data = $this->visits_m->get_results();
		if($fields)
		{
			if($this->input->post('full_day'))
			{
				$visit_id = $this->visits_m->save($id,$validate);
				$data['success'] = "Your 24hrs Live-in Care, has been scheduled with success";
			}
			else
			{	//save one visit
					$visit_id = $this->visits_m->save($id,$validate);
					$data['success'] = "Your visit has been scheduled with sucess";
			}
			$this->visits_m->save_checklist($_POST,$visit_id);
                        
			$data['redirect'] = admin_url("visits/edit/$id");
			set_success($data['success']);
		}
		send_json($data);
	}
	public function assign_carepro()
	{
		$visit_id = $this->input->post('visit_id');
    	$carepro_id = $this->input->post('carepro_id');

    	$data = $this->visits_m->assign_carepro($visit_id, $carepro_id);
    	if ($data) {
    		send_json("Assigned the visit successfully");
    	}
	}
        
        public function review($visit_id = ''){
            $data = array(
                    'title' => "Visits Details",
                    'visit' => $this->visits_m->get_visit_by_id($visit_id),
                    'carepros' => $this->visits_m->get_matching_carepro($visit_id),
            );		

            $this->render("admin/visits/visits_completed", $data);
        }
        
        public function visit($visit_id = ''){
            $data = array(
                    'title' => "Visits Details",
                    'visit' => $this->visits_m->get_visit_by_id($visit_id),
                    'carepros' => $this->visits_m->get_matching_carepro($visit_id),
            );		

            $this->render("admin/visits/visits_review", $data);
        }
        
        public function search_skill(){
            $term = $this->input->get('term');
            $page = $this->input->get('page');
            $limit = $this->input->get('limit');
            $offset = ($page-1) * $limit;

            $result = $this->visits_m->search_skills($term, $offset, $limit);
            send_json($result);
        }

}


