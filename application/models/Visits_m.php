<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visits_m extends MY_Model{
	
	protected $table = 'visit';
	protected $primary_key = 'id';
	protected $columns = array(
		'case_id' => array('Case Id', 'trim|required'),
		'visit_from' => array('Visit Date', 'trim|required|database_date|future_date'),
		'visit_to' => array('Visit To', 'trim|required|database_date|future_date|greater_date_than_field[visit_from]'),
		'full_day' => array('Full Day', 'trim'),
		'building' => array('Building', 'trim|required'),
		'street' => array('Street', 'trim|required'),
		'block' => array('Block', 'trim|required'),
		'unit' => array('Unit', 'trim|required'),
		'postal_code' => array('Postal Code', 'trim|required'),
		'instructions' => array('Instructions', 'trim'),
		'clock_in' => array('Clock In', 'trim|required'),
		'clock_out' => array('Clock Out', 'trim|required'),
		'alert' => array('Alert', 'trim|required'),
		'pain' => array('Pain', 'trim|required'),
		'pain_location' => array('Pain Location', 'trim|required'),
		'summary' => array('Summary', 'trim|required'),
		'comments' => array('Comments', 'trim|required'),
		'rating' => array('Rating', 'trim|required'),
		'review' => array('Review', 'trim|required'),
		'status' => array('Status', 'trim|required'),
		'full_day' => array("Full Day", 'trim'),


		'repeat' => array('Repeat', 'trim', FALSE),
		'repeat_days[]' => array('Scheduled Days', 'required', FALSE),
		'repeat_start[]' => array('Repeat Start', 'required', FALSE),
		'repeat_end[]' => array('Repeat End', 'required', FALSE),
		'repeat_from' => array('ServicePeriod Start', 'required|database_date|future_date', FALSE),
		'repeat_to' => array('ServicePeriod End', 'required|database_date|greater_date_than_field[repeat_from]', FALSE),

		'one_day_date' => array('Date', 'trim|required|database_date|future_date', FALSE),
		'one_day_start' => array('Start', 'trim|required', FALSE),
		'one_day_end' => array('End', 'trim|required|great_than_field[one_day_start]', FALSE),

		'fullday_from[]' => array('Date From', 'required', FALSE),
		'fullday_to[]' => array('Date To', 'required', FALSE),

		//skills
		'skill[]' => array('Type of Care', 'required', FALSE),


	);	

	public function get_from_post($cols=NULL, $id='')
	{

		$fields =  parent::get_from_post($cols, $id);

		if($fields)
		{
			if($this->input->post('full_day'))
			{
				//validate visit_from, visit_to
				$fullday_from = $this->input->post('fullday_from');
				$fullday_to = $this->input->post('fullday_to');
				
			

				foreach($fullday_from as $index =>$visit_from)
				{					
					$visit_to = $fullday_to[$index];
					
					if(dbtime($visit_from) >= dbtime($visit_to))
					{
						$this->errors[] = "<div>Invalid Date Interval: $visit_from - $visit_to</div>";
						return FALSE;
					}				
				}
				

			}
			elseif($this->input->post('repeat') == 0)
			{
				//validate one day visit: date, start and end time
				$date = $this->input->post('one_day_date');
				$start = $this->input->post('one_day_start');
				$end = $this->input->post('one_day_end');


				if(strtotime($date) < time())
				{
					$this->errors[] = "<div>Please select a future date for visit</div>";
					return FALSE;
				}

				$fields['visit_from'] = substr($date, 0, 10) . ' ' . $start;
				$fields['visit_to'] = substr($date, 0, 10) . ' ' . $end;
			}
			else
			{ 
				//validate repeat schedule fields
				$days = $this->input->post('repeat_days');
				$start = $this->input->post('repeat_start');
				$end = $this->input->post('repeat_end');


				foreach($start as $group => $s)
				{
					if($start[$group] >= $end[$group]){
						$this->errors[] = "<div>Invalid period, End Time must be greater than Start Time</div>";
					}
				}
				if(count($days) < count($start)){
					$this->errors[] = "<div>Please select at least one week day in each schedule</div>";
				}

				if($this->errors){
					return false;
				}		

			}

			
		}
		return $fields;
	}
	

	
	function set_filter($filter)
	{
		if($date = element('date', $filter)){
			$this->db->where('DATE(v.visit_from)', $date);
		}
		if($user_id = element('user_id', $filter)){
			$this->db->where('r.user_id', $user_id);
		}

		if($visit_ids = element('visit_ids', $filter)){
			$this->db->where_in('v.id', $visit_ids);
		}
                if($status = element('visit_status', $filter)){
			$this->db->where('v.status', $status);
		}
                
                if($recipient_id = element('recipient_id', $filter)){
			$this->db->where('r.id', $recipient_id);
		}

		$this->db->join('case c', 'c.id = v.case_id', 'left');
		$this->db->join('recipient r', 'r.id = c.recipient_id', 'left');

	}

	function get_items($filter, $offset=0, $limit= LIMIT)
	{
		$this->set_filter($filter);
		$this->db->select("v.*, CONCAT(r.first_name, ' ', r.last_name) as recipient", FALSE)
				->from("$this->table v")
				->limit($limit, $offset);		
		
		if($sort_col = element('sort_col', $filter, 'id')){
			$this->db->order_by($sort_col, element('sort_dir', $filter, 'desc'));
		}
		
		$query = $this->db->get();
		$rows = $query->result();
                $case_ids = array();
                
		if(element('services', $filter))
		{
			foreach($rows as $row){
				$case_ids[] = $row->case_id;
			}
                        
                        if(count($case_ids)>0)
                            $rows = $this->common->attach_services($rows, $case_ids);			
		}

		return $query->result();
	}

	function get_count($filter)
	{
		$this->set_filter($filter);
		$this->db->select('count(*) as num');
		$query = $this->db->get("$this->table v");
		$row =  $query->row();
		return $row->num;
	}
        
    function get_visit_by_client($client_id, $status){
        
        $this->db->select('r.user_id,r.gender,r.dob,r.photo, r.first_name as fname,r.last_name as lname,u.first_name as user_fname,u.last_name as user_lname,u.photo as user_photo,v.id,v.visit_from,v.visit_to,v.clock_in,v.clock_out,v.rating,c.id as case_id,r.id as recipient_id');
        $this->db->from('user u');
        $this->db->join('recipient r','r.user_id=u.id');
        $this->db->join('case c','c.recipient_id=r.id');
        $this->db->join('visit v','v.case_id=c.id');
        $this->db->where('v.status',$status);
        $this->db->where('r.user_id',$client_id);
        $this->db->order_by('v.visit_from','asc');
        
        if(strtolower($status)!='pending' )
        {
            $this->db->select('ca.gender as carepro_gender,ca.dob as carepro_dob,uu.photo as usr_photo,uu.id as usr_id');
            $this->db->join('visit_carepro vc','vc.visit_id=v.id','right');
            $this->db->join('carepro ca','vc.carepro_id=ca.id');
            $this->db->join('user uu','uu.id=ca.user_id');
            $this->db->where('vc.status','Assigned');
        }

        
        
        $query = $this->db->get();
        $rows = $query->result();
        

		foreach($rows as $row){
			$row->carepro = $this->attach_carepro($row->id);
			$query = $this->db->select('s.id')->from('skill s')->join('visit_skill vs','vs.skill_id=s.id')->where(array('vs.visit_id' => $row->id))->get();
			$skills = $query->result();
			$skill_ids = array();
			foreach ($skills as $skill) {
				$skill_ids[] = $skill->id;
			}
			$row->services =  $this->common->services_from_skills($skill_ids);
		}	
                
//                echo "<pre>";
//                var_dump($rows);exit();

        if($rows>0)
            return $rows;
        
        return false;
    }

    function get_visit_by_carepro($carepro_id, $status){
        
        $carepro = $this->carepro_m->get_record(array('user_id'=>$carepro_id));
        $qry = $this->db->query("select GROUP_CONCAT(visit_id SEPARATOR ',') as visit_ids from visit_carepro where status!='Assigned' OR (carepro_id=$carepro->id)");
        $ids = array();
        if($qry->num_rows()==1)
            $ids = $qry->row()->visit_ids;
        
        if($status=='Pending')
                $this->db->where('vc.status','Bid');
        else if($status=='Assigned')
                $this->db->where('vc.status','Assigned');
        
    	$this->db->select('u.first_name as u_fname,u.last_name as u_lname,r.photo,r.first_name as re_fname,r.last_name as re_lname,v.id,v.visit_from,v.visit_to,v.clock_in,v.clock_out,c.id as case_id,r.gender,r.dob,v.block,v.unit,v.building,v.postal_code,v.street,r.id as recipient_id')
                ->from('user u')
                ->join('recipient r','r.user_id=u.id')
                ->join('case c','c.recipient_id=r.id')
                ->join('visit v','v.case_id=c.id');
                
        if($status!='bids')
        {
            $this->db->join('visit_carepro vc','vc.visit_id=v.id','left');
            $this->db->where('v.status',$status);
            $this->db->join('carepro cp','cp.id=vc.carepro_id');
            $this->db->where('cp.user_id',$carepro_id);
        }else{
            if(count($ids)>0)
                $this->db->where_not_in('v.id', explode(",",$ids));
        }
        
        $query = $this->db->get();

	    $rows = $query->result();
	    $case_ids = array();

		foreach($rows as $row){
			$case_ids[] = $row->case_id;
		}
	    if(count($case_ids)>0)
	    $rows = $this->common->attach_services($rows, $case_ids);			

	    if($rows>0)
	        return $rows;
	    
	    return false;
    }   

    function attach_carepro($id){
    	$query = $this->db->select('u.*')->from('user u')->join('carepro c','c.user_id=u.id')->join('visit_carepro vc','vc.carepro_id=c.id')->where('vc.visit_id',$id)->get();
    	$rows = $query->result();
    	if(count($query->result())>0){
    		$rows = $query->result()[0];
    	}
    	return $rows;
    }

    public function get_visit_by_id($visit_id)
    {
    	$query = $this->db->select('v.*,c.recipient_id as recipient_id')
						->from('case c')
						->join('visit v','v.case_id = c.id')
						->where('v.id', $visit_id)
						->get();

    	$visit = $query->row();
    	
    	$query = $this->db->select('c.skill_id')
						->from('skill s')
						->join('visit_skill c','c.skill_id = s.id')
						->where('c.visit_id', $visit_id)
						->get();
    	$visit->skills =  $this->result_assoc_array($query, 'skill_id');

        $qry = $this->db->get_where('visit_checklist', array('visit_id' => $visit_id));
    	$visit->checklist = false;
        
        if($qry->num_rows()>0)
            $visit->checklist = $qry->result();

    	return $visit;
    }
    public function save_checklist($post,$visit_id)
	{
                $qry = $this->db->get_where('visit_checklist', array('visit_id' => $visit_id));
                
                if($qry->num_rows()>0)
                {   
                    $delete_ids = array();
                    foreach($qry->result() as $k=>$v)
                    {
                        if(!isset($post['field_name_'.$v->id])){
                                $delete_ids[] = $v->id;
                                continue;
                        }
                            
                        $this->db->where('id',$v->id);
                        $this->db->update('visit_checklist',array('checklist'=>$post['field_name_'.$v->id]));
                    }
                    if(count($delete_ids)>0)
                        $this->db->where_in('id', $delete_ids)->delete('visit_checklist');
               }
                
		$insert = array();

                if(isset($post['field_name']) && count($post['field_name'])>0)
                {
                    foreach($post['field_name'] as $key => $value)
                    {
                        if($value!='')
                            $insert[] = array('visit_id' => $visit_id,'checklist' => $value);
                    }
                }
		if($insert){
			$this->db->insert_batch('visit_checklist', $insert);
		}
	}
        
	public function visit_checklist($visit_id)
	{
		if(!$visit_id){
			return array();
		}
		$query = $this->db->select('vs.skill_id')
						->from('skill s')
						->join('visit_skill vs','vs.skill_id=s.id')
						->where('vs.visit_id',$visit_id);

		$query = $this->db->get();
		return $query->result();
	}
        
        public function get_visit($visit_id='')
    {
    	$this->load->model('cases_m');
    	$this->load->model('recipients_m');

    	$visit = $this->get_record($visit_id);

    	$visit->case = $this->cases_m->get_case($visit->case_id);
    	$visit->recipient = $this->recipients_m->get_recipient($visit->case->recipient_id);

        $visit_carepro =  $this->visit_carepro($visit_id);
        $visit->visit_carepro_status = $visit_carepro !==false ? $visit_carepro->status:'';
    	return $visit;
    }

    public function past_visit_summary($case_id, $limit = 3)
    {
    	$query = $this->db->where('case_id', $case_id)
	    				->where('status', 'Completed')
	    				->limit($limit)
	    				->get($this->table);
        if($query->num_rows()>0)
	    return $query->result();
        
        return false;
    }

    public function case_visit_ids($case_id)
    {
    	$query  = $this->db->select('id')->where('case_id', $case_id)->get($this->table);
    	return $this->result_assoc_array($query, 'id');
    }

    public function update_visits_photo($records, $visit_ids)
    {
    	$this->db->where_in('visit_id', $visit_ids)->delete('visit_photo');
    	$this->db->insert_batch('visit_photo', $records);
    }


    public function all_visits_schedule($start, $end, $case_ids = array())
	{
		$this->db->select('id, concat(status , " (",count(id), ")") as title, status')
				->select('1 AS allDay', FALSE)				
				->select('DATE(visit_from) as start', FALSE) 
				->select('DATE(visit_to) end', FALSE) 
				->select('CONCAT("event-", status) AS className', FALSE)
				->where('visit_from >=', $start)
				->where('visit_to <=', $end)
				->group_by('DATE(visit_from), status');

		if($case_ids){
			$this->db->where_in('case_id', $case_ids);
		}
	
		$query = $this->db->get($this->table);		
		return $query->result();
	}

	public function carepro_visits($start, $end, $carepro_id)
	{
		$this->db->select('v.id, concat(c.status , " (",count(distinct c.id), ")") as title, c.status')
				->select('1 AS allDay', FALSE)				
				->select('DATE(v.visit_from) as start', FALSE) 
				->select('DATE(v.visit_to) end', FALSE) 
				->select('CONCAT("event-", c.status) AS className', FALSE)
				->from("$this->table v")
				->join("visit_carepro c", 'c.visit_id = v.id')
				->where('carepro_id', $carepro_id)
				->where('v.visit_from >=', $start)
				->where('v.visit_to <=', $end)
				->group_by('DATE(v.visit_from), c.status');		
		
	
		$query = $this->db->get($this->table);		
		return $query->result();
	}

	function carepro_visit_details($date, $carepro_id)
	{
		$this->db->select("v.id, v.visit_from, v.visit_to, c.*")
				->from("$this->table v")
				->join("visit_carepro c", 'c.visit_id = v.id')
				->where('DATE(v.visit_from)', $date);
		$query  = $this->db->get();
		return $query->result();
	}

	public function get_matching_carepro($visit_id)
	{
		$this->load->model('carepro_m');

		$query = $this->db->select('vs.skill_id')
						->from('skill s')
						->join('visit_skill vs','vs.skill_id=s.id')
						->where('vs.visit_id',$visit_id)
						->get();
                
                $carepro = array();
                $result = array();
                
                if($query->num_rows()>0)
                {
                    $rows = $query->result();
                    $skills = array();
                    foreach ($rows as $row) {
                            array_push($skills,$row->skill_id);
                    }

                    $query = $this->db->select('user_id')->from('carepro_skill')->where_in('skill_id',$skills)->get();
                    $rows = $query->result();

                    if($query->num_rows()>0)
                    {

                        foreach ($rows as $row) {
                                array_push($carepro,$row->user_id);
                        }
                    }
                

                    $acv=array_count_values($carepro);
                    arsort($acv);
                    $user_ids = array_keys($acv);
                    $result = array();
                    foreach ($user_ids as $key => $user_id) {
                            $query = $this->db->select('u.id as user_id,u.first_name,u.last_name,u.photo,c.id,c.dob')->from('carepro c')->join('user u','u.id=c.user_id')->where_in('u.id',$user_id)->get();
                            
                            if($query->num_rows()>0)
                            {
                                $result[$key] = $query->row();
                                $result[$key]->rating = $this->carepro_m->get_rating($result[$key]->id);
                            }
                    }
                }
		return $result;

	}
	public function assign_carepro($visit_id, $carepro_id)
	{
		$query = $this->db->select('*')->from('visit_carepro')->where_in('visit_id',$visit_id)->get();

		if($query->num_rows()>0){
			$this->db->where('visit_id', $visit_id);
			$this->db->update('visit_carepro', array('carepro_id' => $carepro_id,'assigned_at'=> date(DATE),'status' => 'Assigned'));
		}else{
			$this->db->insert('visit_carepro', array('visit_id' => $visit_id,'carepro_id' => $carepro_id,'assigned_at'=> date(DATE),'status' => 'Assigned'));
		}
		
		$this->db->set(array('status'=> 'Assigned'));
		$this->db->where('id', $visit_id);
		$this->db->update($this->table);
		return true;
	}
        
        public function visit_details($visit_id){
            $visit = $this->get_record($visit_id);
            $case = $this->cases_m->get_record($visit->case_id);
            $recipient = $this->recipients_m->get_recipient($case->recipient_id);

            if($visit->status=='Pending')
            {
                $visit->name = $recipient->first_name.' '.$recipient->last_name;
                $visit->recipient_name = $recipient->first_name.' '.$recipient->last_name;
                $visit->photo = $recipient->photo;
                $visit->recipient_id = $recipient->id;
                $visit->race = $recipient->race;
                $visit->dob = $recipient->dob;
                $visit->weight = $recipient->weight;
                $visit->height = $recipient->height;
                $visit->gender = $recipient->gender;
                $visit->language = $recipient->languages;
                $visit->medical_condition = $recipient->medical_condition;
                $visit->diagnosis = $recipient->diagnosis;
                $visit->summary = $this->common->past_visit_summary($case->id,'recipient');
                
                $skill = $this->visit_skill_ids($visit_id);
                $visit->services = $this->cases_m->case_services_skills(explode(',',$skill['skill_ids']));
            }
            else{
                $visit_carepro = $this->visit_carepro($visit_id);
                $carepro = $this->carepro_m->get_record($visit_carepro->carepro_id);
                $user = $this->carepro_m->get_user($carepro->user_id);
                $visit->name = $user->first_name.' '.$user->last_name;
                $visit->recipient_name = $recipient->first_name.' '.$recipient->last_name;
                $visit->photo = $user->photo;
                $visit->recipient_id = $recipient->id;
                $visit->race = $carepro->race;
                $visit->dob = $carepro->dob;
                $visit->weight = $carepro->weight;
                $visit->height = $carepro->height;
                $visit->gender = $carepro->gender;
                $visit->language = $user->languages;
                $visit->summary = $this->common->past_visit_summary($case->id,'recipient');
                $skill = $this->visit_skill_ids($visit_id);
                $visit->services = $this->cases_m->case_services_skills(explode(',',$skill['skill_ids']));
                
                $matched_skill = $this->visit_match_carepro($carepro->user_id,explode(',',$skill['skill_ids']));
                $visit->match_skill = $this->cases_m->case_services_skills(explode(',',$matched_skill['skill_ids']));
                $visit->user_id = $user->id;
            }
            return $visit;
        }
        
        public function visit_skill_ids($visit_id){
            $qry = $this->db->select("GROUP_CONCAT(skill_id SEPARATOR ',') as skill_ids",false)->get_where('visit_skill', array('visit_id' => $visit_id));
            if($qry->num_rows()==1)
                return $qry->row_array();
            
            return false;
        }
        
        public function visit_carepro($visit_id){
            $qry = $this->db->get_where('visit_carepro', array('visit_id' => $visit_id));
            
            if($qry->num_rows()==1)
                return $qry->row();
            
            return false;
        }
        
        public function visit_match_carepro($user_id,$visit_skill_ids){
//            $qry = $this->db->select("GROUP_CONCAT(skill_id SEPARATOR ',') as skill_ids",false)->get_where('carepro_skill', array('user_id' => $user_id))->where_in('skill_id',$visit_skill_ids);
            
            $qry = $this->db->select("GROUP_CONCAT(skill_id SEPARATOR ',') as skill_ids",false)
                    ->from('carepro_skill')
                    ->where('user_id',$user_id)
                    ->where_in('skill_id',$visit_skill_ids)
                    ->get();
            if($qry->num_rows()==1)
                return $qry->row_array();
            
            return false;
        }
        
        public function check_bid($carepro_id,$visit_id){
            $qry = $this->db->query("select * from visit_carepro where visit_id=$visit_id and (carepro_id=$carepro_id OR status='Assigned')");

            if($qry->num_rows()==0)
                return true;
            
            return false;
        }
        
        public function get_skills(){
            $this->db->select("skill AS text, id")
			->from('skill');

            $query  = $this->db->get();		
		
            return $query->result();
        }
        
        public function search_skills($term, $offset=0, $limit=25){
            $this->db->select("skill AS text, id")
			->from('skill')
			->like('skill', $term)
			->limit($limit, $offset);

		$query  = $this->db->get();
		
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return array(''=>'No matches found');
		}
        }
        

}
