<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recipients_m extends MY_Model{
	
	protected $table = 'recipient';
	protected $primary_key = 'id';
	protected $columns = array(
		'user_id' => array('User Id', 'trim|required'),
		'relationship' => array('Relationship', 'trim|required'),
		'salutation' => array('Salutation', 'trim|required'),
		'first_name' => array('First Name', 'trim|required'),
		'last_name' => array('Last Name', 'trim|required'),
		'nationality' => array('Nationality', 'trim|required'),
		'nric' => array('Nric', 'trim|required'),
		'dob' => array('Dob', 'trim|required|database_date'),
		'gender' => array('Gender', 'trim|required'),
		'weight' => array('Weight', 'trim|required'),
		'height' => array('Height', 'trim|required'),
		'religion' => array('Religion', 'trim|required'),
		'race' => array('Race', 'trim|required'),
		'marital_status' => array('Marital Status', 'trim|required'),
		'current_residence' => array('Current Residence', 'trim|required'),
		'residence_note' => array('Residence Note', 'trim|required'),
		'pets' => array('Pets', 'trim|required'),
		'pets_note' => array('Pets Note', 'trim|required'),
		'diagnosis' => array('Diagnosis', 'trim|required'),
		'medical_condition' => array('Medical Condition', 'trim|required'),
		'created_by' => array('Created By', 'trim|required'),
		'created_at' => array('Created At', 'trim|required'),
		'admin_id' => array('Admin Id', 'trim|required'),
		'staff_updated' => array('Staff Updated', 'trim|required'),
		'deleted_at' => array('Deleted At', 'trim|required'),

		'language[]' => array('Language', 'required', FALSE),
	);	
	

	
	function set_filter($filter)
	{
		if($user_id = element('user_id', $filter))
		{
			$this->db->where('user_id', $user_id);
		}
	}

	function get_items($filter, $offset=0, $limit= 100)
	{
                $items = array();
		$this->set_filter($filter);
		$this->db->select("c.*, CONCAT(c.first_name, ' ' , c.last_name) as full_name,ca.staff_updated",FALSE)
				->from("$this->table c")
                                ->join('case ca','ca.recipient_id=c.id')
				->limit($limit, $offset);		
		
		if($sort_col = element('sort_col', $filter, 'id')){
			$this->db->order_by($sort_col, element('sort_dir', $filter, 'desc'));
		}
		
		$query = $this->db->get();
                if($query->num_rows()>0)
                {
                    $items = $this->result_assoc($query, 'id');
		$recipient_ids = array_keys($items);

		if(element('languages', $filter))
		{
			//get languages preference for each recipient
			$languages = $this->get_languages($recipient_ids);

			foreach($items as $item)
			{
				$item->languages = element($item->id, $languages, array());
			}
		}
		if(element('services', $filter))
		{
			$cases = $this->get_cases($recipient_ids);

			foreach($items as $item)
			{
				$item->case = element($item->id, $cases, array());
//                                var_dump($item->case);exit();
			}
			//get service preference for each recipient

			
			// var_dump($items);
			// die();

			foreach($items as $item)
			{
				if (empty($item->case)) {
				$item->services = null;
			} else {
				$services = $this->get_services($item->case[0]->id);
				$item->services = $services;
			}
				
			}
		}
                }
		
		
		return $items;
	}

	function get_count($filter)
	{
		$this->set_filter($filter);
		$this->db->select('count(*) as num');
		$query = $this->db->get("$this->table c");
		$row =  $query->row();
		return $row->num;
	}

	function get_languages($recipient_ids)
	{
		$query  = $this->db->where_in('recipient_id', $recipient_ids)
						->get('recipient_language');

		return $this->group_results($query, 'recipient_id');
	}

	



	public function save_languages($languages, $recipient_id)
	{
		//remove old values
		$this->db->where('recipient_id', $recipient_id)->delete('recipient_language');
		$insert = array();
		foreach($languages as $language)
		{
			$insert[] = array('language' => $language, 'recipient_id' => $recipient_id);
		}
		if($insert){
			$this->db->insert_batch('recipient_language', $insert);
		}
	}

	public function get_recipient($recipient_id=NULL)
	{
		$item = $this->get_record($recipient_id);
		$item->full_name = $item->first_name . ' ' . $item->last_name;
		$item->languages = $this->recipient_languages($recipient_id);

		return $item;
	}

	public function recipient_languages($recipient_id)
	{
		if(!$recipient_id){
			return array();
		}
		$query = $this->db->get_where('recipient_language', array('recipient_id' => $recipient_id));
		return $this->result_assoc_array($query, 'language');
	}
        
        public function get_recipient_by_client_id($user_id=NULL)
	{
            $query = $this->db->get_where('recipient', array('user_id' => $user_id));
            
            if($query->num_rows()>0)
            {
                foreach($query->result() as $key=>$value)
                {
                    $qry = $this->db->get_where('case', array('recipient_id' => $value->id));
                    $recipients[] = $this->get_recipient($value->id);
                    $recipients[$key]->case_id = $qry->num_rows()==1?$qry->row()->id:'';
                }
                return $recipients;
            }
            return false;
	}

	public function get_recipient_me($user_id=NULL)
	{
		$id=NULL;
		$query = $this->db->get_where('recipient', array('user_id' => $user_id, 'relationship' => 'me' ));
		if($query->num_rows()>0)
        {
		$item = $query->result()[0];
		$id = $item->id;
		}

		$item = $this->get_record($id);
		$item->languages = $this->recipient_languages($item->id);
	   	return $item;
	}

	public function get_cases($recipient_ids)
	{
		$query  = $this->db->where_in('recipient_id', $recipient_ids)
						->get('case');

		return $this->group_results($query, 'recipient_id');
	}

	public function get_services($case_id)
	{
            $skill_ids = array();
		$query = $this->db->get_where('case_skill', array('case_id' => $case_id));
		$skills_ids = $this->result_assoc_array($query, 'skill_id');

                if(count($skills_ids)>0)
                {
                    $query = $this->db->where_in('id', $skills_ids)
                                                    ->get('skill');

                    $skills = $this->group_results($query, 'service_id');
                    
                    //get services based on skills
                    $query = $this->db->where_in('id', array_keys($skills))
                                                            ->get('service');
                    
                    $services = $this->result_assoc($query, 'id');
                    return $services;
                }
		return array();
	}
        
        public function get_recipient_location($recipient_id)
        {
            $query = $this->db->get_where('recipient_location', array('recipient_id' => $recipient_id));
            
            if($query->num_rows()==1)
                return $query->row();
            
            return false;
        }
        
        public function save_location($location, $id)
	{
		if($id){
			$this->db->update('recipient_location', $location, array('id' => $id));
		}
		else{
			$this->db->insert('recipient_location', $location);
		}
	}
        
        public function get_count_recipient_history($recipient_id){
                    $query = $this->db->select("count(v.id)",false)
                    ->from('visit v')
                    ->join('visit_carepro vc','v.id=vc.visit_id')
                    ->join('visit_skill vs','vs.visit_id=v.id')
                    ->join('carepro c','c.id=vc.carepro_id')
                    ->join('user u','u.id=c.user_id')
                    ->where('v.status','Completed')
                    ->where('vc.status','Confirmed')
                    ->group_by('v.id')
                    ->get();
            
            if($query->num_rows()>0)
                return $query->result();
            
            
            return false;
        }
        
        public function recipient_history($recipient_id){
            
            $data = array();
                    $query = $this->db->select("v.id,v.clock_in,v.clock_out,vs.skill_id,u.first_name,u.last_name,group_concat(vs.skill_id SEPARATOR ',') as skill_ids",False)
                    ->from('visit v')
                    ->join('visit_carepro vc','v.id=vc.visit_id')
                    ->join('visit_skill vs','vs.visit_id=v.id')
                    ->join('carepro c','c.id=vc.carepro_id')
                    ->join('user u','u.id=c.user_id')
                    ->where('v.status','Completed')
                    ->where('vc.status','Confirmed')
                    ->group_by('v.id')
                    ->get();
            
            if($query->num_rows()>0)
            {
                foreach($query->result() as $key=>$value)
                {
                    $data[] = $value;
//                    $service = $this->common->services_from_skills($value->skill_ids);	
////                    echo "<pre>";
////                    var_dump($data);
////                    var_dump($service);
//                    $data[$key]->service= $service->service;
////                    echo $value->skill_ids;
////                    echo "<pre>";
////                    var_dump($service);exit();
                }
                
                return $data;
            }
            
            
            return false;
        }


}
