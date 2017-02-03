<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cases_m extends MY_Model{
	
	protected $table = 'case';
	protected $primary_key = 'id';
	protected $columns = array(
		'recipient_id' => array('Recipient Id', 'trim|required'),
		'gender_pref' => array('Gender Pref', 'trim|required'),
		'full_care' => array('Full Care', 'trim|required'),
		'hours' => array('Hours', 'trim|required'),
		'special_instructions' => array('Special Instructions', 'trim'),
		'service_from' => array('Service From', 'trim|required|database_date'),
		'created_by' => array('Created By', 'trim|required'),
		'created_at' => array('Created At', 'trim|required'),
		'admin_id' => array('Admin Id', 'trim|required'),
		'staff_updated' => array('Staff Updated', 'trim|required'),
		'is_active' => array('Is Active', 'trim'),

		//columns for language
		'language[]' => array('Language', 'required', FALSE),

		//skills
		'skill[]' => array('Type of Care', 'required', FALSE),


		//columns user location		
		'street' => array('Street', 'trim', FALSE),
		'block' => array('Block', 'trim', FALSE),
		'unit' => array('Unit', 'trim', FALSE),
		'postal_code' => array('Postal Code', 'trim', FALSE),
		'location_id' => array('LocationId', 'trim', FALSE),

	);	

	public function get_case($case_id = '',$active_skill=false)
	{
		$case = $this->get_record($case_id);
		

		$case->languages = $this->case_languages($case_id);
		$case->skills = $this->case_skills($case_id,$active_skill);
		$locations = $this->case_locations($case_id);
		$case->checklist = $this->case_checklist($case_id,true);
		if($locations)
		{
			$location  = current($locations);
			$case->street = $location->street;
			$case->block = $location->block;
			$case->unit = $location->unit;
			$case->postal_code = $location->postal_code;
			$case->location_id = $location->id;
		}else{
                    $case->street = '';
                    $case->block = '';
                    $case->unit = '';
                    $case->postal_code = '';
                    $case->location_id = '';
                }
		
		$case->locations = $locations;

		return $case;
	}

	public function case_locations($case_id)
	{
		if(!$case_id){
			return array();
		}
		$query = $this->db->get_where('case_location', array('case_id' => $case_id));
		return $query->result();
	}

	public function save_location($location, $id)
	{
		if($id){
			$this->db->update('case_location', $location, array('id' => $id));
		}
		else{
			$this->db->insert('case_location', $location);
		}
	}

	public function case_languages($case_id)
	{
		if(!$case_id){
			return array();
		}
		$query = $this->db->get_where('case_language', array('case_id' => $case_id));
		return $this->result_assoc_array($query, 'language');
	}

	public function save_languages($languages, $case_id)
	{
		//remove old values
		$this->db->where('case_id', $case_id)->delete('case_language');
		$insert = array();
		foreach($languages as $language)
		{
			$insert[] = array('language' => $language, 'case_id' => $case_id);
		}
		if($insert){
			$this->db->insert_batch('case_language', $insert);
		}
	}

	public function case_skills($case_id,$active_skill=false)
	{
		if(!$case_id){
			return array();
		}
        if($active_skill){
        	$this->db->where('is_active', 1);
        }              
        $query = $this->db->get_where('case_skill', array('case_id' => $case_id));
                      
		return $this->result_assoc_array($query, 'skill_id');
	}

	public function case_skills_records($case_id)
	{
		$query = $this->db->get_where('case_skill', array('case_id' => $case_id));
		return $this->result_assoc($query, 'skill_id');
	}

	public function save_skills($skills, $case_id)
	{
		//remove old values
		//$this->db->where('case_id', $case_id)->delete('case_skill');

		//get case_skills
		$case_skills = $this->case_skills_records($case_id);

		//loop every existing records and check if need to deactive any records
		foreach($case_skills as $skill_id => $case_skill)
		{
			if(!in_array($skill_id, $skills))
			{
				//deactivate record
				$this->db->set('is_active', 0)->where('id', $case_skill->id)->update('case_skill');
			}
		}


		//loop every skill, and check if is required to update or create new records
		foreach($skills as $skill_id)
		{
			
			$case_skill = element($skill_id, $case_skills);
			
			if($case_skill)
			{
				//update record
				$this->db->set('is_active', 1)->where('id', $case_skill->id)->update('case_skill');
			}
			else
			{
				//insert record
				$record = array('skill_id' => $skill_id, 'case_id' => $case_id, 'is_active' => 1);
				$this->db->insert('case_skill', $record);
			}			
		}		
		/*if($insert){
			$this->db->insert_batch('case_skill', $insert);
		}*/
	}

	public function save_case_skill($case_id, $skill_id, $is_active)
	{
		//check if record exists 
		$query = $this->db->where('case_id', $case_id)->where('skill_id', $skill_id)->get('case_skill');

		$rec = array(
			'case_id' => $case_id, 
			'skill_id' => $skill_id, 
			'is_active' => $is_active
		);
		preg($rec);

		if($query->num_rows())
		{
			//update record
			$this->db->set($rec)->where('id', $query->row()->id)->update('case_skill');

		}
		else{
			//insert record
			$this->db->insert('case_skill', $rec);
		}
	}



	
	function set_filter($filter)
	{

		if($name = element('name', $filter)){
			$this->db->like('c.recipient_id', $name);
		}
		if($q = element('q', $filter)){
			$this->db->like('CONCAT(r.first_name, " ", r.last_name)', $q);
		}
                
                if($status = element('status', $filter)){
                    
                    if($status=='new')
			$this->db->where('c.staff_updated', '0000-00-00 00:00:00');
                    else
                        $this->db->where('c.staff_updated<>', '0000-00-00 00:00:00');
		}

	}

	function get_items($filter, $offset=0, $limit = LIMIT)
	{
		$this->set_filter($filter);
		$this->db->select("c.*, c.id as case_id")
				->select("CONCAT(r.first_name, ' ' , r.last_name) AS recipient", FALSE)
				->select("CONCAT(u.first_name, ' ' , u.last_name) AS client", FALSE)
				->join('recipient r' , 'r.id = c.recipient_id', 'left')
				->join('user u', 'u.id = r.user_id', 'left')
				->from("$this->table c")
				->limit($limit, $offset);		
		
		if($sort_col = element('sort_col', $filter, 'id')){
			$this->db->order_by($sort_col, element('sort_dir', $filter, 'desc'));
		}
		
		$query = $this->db->get();

		$rows = $this->result_assoc($query, 'case_id');
		$case_ids = array_keys($rows);
			
		if(element('services', $filter) && $case_ids)
		{
			$rows = $this->common->attach_services($rows, $case_ids);			
		}
		if(element('upcoming', $filter) && $case_ids)
		{
			$rows = $this->attach_upcoming_visits($rows, $case_ids);			
		}
		return $rows;
	}

	function get_count($filter)
	{
		$this->set_filter($filter);
		$this->db->select('count(*) as num');
		$query = $this->db->get("$this->table c");
		$row =  $query->row();
		return $row->num;
	}



	

	public function attach_upcoming_visits($rows, $case_ids)
	{
		//get list of visits for case_ids
		$query = $this->db->select('case_id, count(id) as total')
						->select('SUM(IF(visit_from > NOW(), 1, 0)) as upcoming', FALSE)
						->select('SUM(IF(status = "pending", 1, 0)) as pending', FALSE)
						->from('visit')
						->where_in('case_id', $case_ids)
						->group_by('case_id')
						->get();

		$visits = $this->result_assoc($query, 'case_id');
		//preg($visits);die();
		foreach($rows as $row)
		{
			$row->upcoming = $row->pending = $row->pending_requested =  0;
			$visit = element($row->case_id, $visits);
			if($visit){
				$row->upcoming = $visit->upcoming;
				$row->pending = $visit->pending;
                                
				$row->pending_requested = $visit->pending==0 ? 0:$visit->pending / ($visit->upcoming + $visit->pending);
			}
		}


		return $rows;
	}
        
        public function case_services($skills_ids)
	{
		if( ! $skills_ids )
		{
			return array();
		}
		//get skills
		$query = $this->db->where_in('id', $skills_ids)
						->get('skill');
		
		$skills = $query->result();

		$services = array();

		//get services based on skills
		foreach ($skills as $skill) {
			$this->db->select('service');
			$query = $this->db->where(array('id' => $skill->service_id))
							->get('service');
			$services[$skill->service_id] = $query->result()[0]->service;				
		}

		return $services;
	}
	public function case_services_skills($skills_ids)
	{
		if( ! $skills_ids )
		{
			return array();
		}
		//get skills
		$query = $this->db->where_in('id', $skills_ids)
						->get('skill');
		
		$skills = $this->group_results($query, 'service_id');

		//get services based on skills
		$query = $this->db->where_in('id', array_keys($skills))
							->get('service');
		$services = $this->result_assoc($query, 'id');

	
		//attach user skills to every service
		foreach($services as $service)
		{
			$service->skills = $skills[$service->id];
		}

		return $services;
	}

	public function recipient_case_id($recipient_id)
	{
		$query = $this->db->select('id')->get_where($this->table, array('recipient_id' => $recipient_id));
		
		return $query->num_rows() ? $query->row()->id : NULL;
	}

	public function save_checklist($items, $skill_ids, $case_id)
	{	

        //set case_checklist to is_active=0
        $this->db->where('case_id', $case_id);
        $this->db->update('case_checklist', array('is_active'=>0));

        //get existing case_checklist
		$query = $this->db->where('case_id', $case_id)->get('case_checklist');	
		$case_checklist = $this->result_assoc($query, 'skill_id');
		
		//loop every skill_id and update or insert records on case_checklist table
		foreach($skill_ids as $i => $skill_id)
		{
			$record = array(
				'case_id' => $case_id,
				'item' => $items[$i],
				'skill_id' => $skill_id,				
				'is_active' => 1,
			);

			if($cheklist_record = element($skill_id, $case_checklist))
			{
				//update record
				$this->db->set($record)->where('id', $cheklist_record->id)->update('case_checklist');				
			}
			else{
				//insert record				
				$this->db->insert('case_checklist', $record);				
			}			
		}       
     
	}

	public function case_checklist($case_id,$active_checklist=false)
	{
		if(!$case_id){
			return array();
		}
		if($active_checklist===true){
			$this->db->where('c.is_active',1);
		}

		$query = $this->db->select('c.*')
					->from('skill s')
					->join('case_checklist c','c.skill_id=s.id')
					->where('c.case_id',$case_id)
					->order_by('order','asc')
					->get();

		return $query->result();
	}

	/**
	 * retrieve an array with all client case_ids
	 */
	public function user_case_ids($user_id)
	{
		$this->db->select('c.id')
				->from("$this->table c")
				->join('recipient r', 'c.recipient_id = r.id')
				->where('r.user_id', $user_id);
		$query  = $this->db->get();

		return $this->result_assoc_array($query, 'id');
	}

	public function get_case_checklist_ids($case_id)
	{
		$query = $this->db->where('case_id', $case_id)
						->where('is_active', 1)
						->get('case_checklist');	
		return $this->result_assoc_array($query, 'id');
	}

	public function case_skill_ids($case_id)
	{
		$query  = $this->db->where('case_id', $case_id)->get('case_skill');
		return $this->result_assoc_array($query, 'id');
	}


	public function insert_visit_checklist($visit_ids, $case_checklist)
	{
		$records = array();
                
		foreach($visit_ids as $visit_id)
		{
                    foreach($case_checklist as $key=>$value)
                    {
                            $records[] = array(
                                    'visit_id' =>$visit_id,
                                    'checklist' => $value->item!=null && $value->item!='' ? $value->item:'',
                            );
                    }
		}
		
		if($records){
			return $this->db->insert_batch('visit_checklist', $records);
		}
	} 
        
        //left join case_checklist is to get checklist item and store into visit_checklist.
        public function get_case_skill($case_id)
	{		
            $query = $this->db->select('cc.*')
                    ->from('case_skill cs')
                    ->join('case_checklist cc','cs.skill_id=cc.skill_id','left')
                    ->where('cs.case_id',$case_id)
                    ->where('cs.is_active',1)->get();
            
            if($query->num_rows()>0)
                return $query->result();
            
            return false;
	}
        
        public function insert_visit_skill($visit_ids, $skills)
	{
		$records = array();
                
		foreach($visit_ids as $visit_id)
		{
                    foreach($skills as $skill)
                    {
                            $records[] = array(
                                    'visit_id' =>$visit_id,
                                    'skill_id' => $skill,
                            );
                    }
		}
		
		if($records){
			return $this->db->insert_batch('visit_skill', $records);
		}
	}
}
