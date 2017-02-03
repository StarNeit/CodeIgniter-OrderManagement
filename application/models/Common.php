<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Model
{

	function services_and_skills()
	{
		//get active services
		$services = $this->db->where('is_active', 1)
							->order_by('order')
							->get('service')
							->result();
		
		//get active skills
		$query = $this->db->where('is_active', 1)->order_by('order')->get('skill');
		$skills = $this->group_results($query, 'service_id');

		foreach($services as $service)
		{
			$service->skills = element($service->id, $skills);
		}
		return $services;
	}


	public function skills_and_services()
	{
		$query = $this->db->select('s.service,s.is_active as service_active,sk.is_active as skill_active, sk.service_id, sk.skill, sk.id as skill_id')
						->from('skill sk')
						->join('service s', 'sk.service_id = s.id', 'left')
						->get();
		return $this->result_assoc($query, 'skill_id');
	}

	public function skill_optgroup()
	{
		$query = $this->db->select('s.service, sk.service_id, sk.skill, sk.id as skill_id')
						->from('skill sk')
						->join('service s', 'sk.service_id = s.id', 'left')
						->get();
		return $this->optgroup_options($query, 'service', 'skill_id', 'skill');
		
	}

	public function attach_services($rows, $case_ids)
	{		
		//retrieve skills_ids
		$query = $this->db->select('case_id, GROUP_CONCAT(skill_id) as skill_ids', FALSE)
						->from('case_skill cs')                                                                             ->where('cs.is_active',1)
						->where_in('case_id', $case_ids)
						->group_by('case_id')
						->get();
		$skills = $this->result_assoc($query, 'case_id');

		//get all skills and services names
		$list = $this->common->skills_and_services();
		// var_dump($list);
		// die();
		//attach skill and services

		foreach($rows as $row)
		{	
			$row->services = array();
			$row->skills = array();

			$case_skills = element($row->case_id, $skills);
			if($case_skills)
			{
				$skill_ids = explode(',', $case_skills->skill_ids);

				$sk = $se = array();
				foreach($skill_ids as $skill_id)
				{
					$skill_service = element($skill_id, $list);
					if ($skill_service->skill_active) {
						$sk[] = $skill_service->skill;
					}
					if ($skill_service->service_active) {
						$se[] = $skill_service->service;
					}
					
				}

				$se = array_unique($se);

				$row->services =  $se;
				$row->skills = $sk;
			}

			
		}
	
		return $rows;
	}
        
        public function services_from_skills($skill_ids = array())
	{
		if(!$skill_ids){
			return array();
		}
		$query = $this->db->select('DISTINCT s.*', FALSE)
					->from('skill sk')
					->join('service s', 'sk.service_id = s.id', 'left')
					->where_in('sk.id', $skill_ids)
					->get();
		return $query->result();
	}
        
        public function visit_skill($rows, $case_ids)
	{		
		//retrieve skills_ids
		$query = $this->db->select('case_id, GROUP_CONCAT(skill_id) as skill_ids', FALSE)
						->from('case_skill cs')                                                                             ->where('cs.is_active',1)
						->where_in('case_id', $case_ids)
						->group_by('case_id')
						->get();
		$skills = $this->result_assoc($query, 'case_id');

		//get all skills and services names
		$list = $this->common->skills_and_services();
		// var_dump($list);
		// die();
		//attach skill and services

		foreach($rows as $row)
		{	
			$row->services = array();
			$row->skills = array();

			$case_skills = element($row->case_id, $skills);
			if($case_skills)
			{
				$skill_ids = explode(',', $case_skills->skill_ids);

				$sk = $se = array();
				foreach($skill_ids as $skill_id)
				{
					$skill_service = element($skill_id, $list);
					if ($skill_service->skill_active) {
						$sk[] = $skill_service->skill;
					}
					if ($skill_service->service_active) {
						$se[] = $skill_service->service;
					}
					
				}

				$se = array_unique($se);

				$row->services =  $se;
				$row->skills = $sk;
			}

			
		}
	
		return $rows;
	}
        
        public function past_visit_summary($case_id, $type='carepro',$carepro_id=''){
            
            if($type=='carepro')
                $this->db->where('carepro_id',$carepro_id);
                    
            $query = $this->db->select('v.clock_in,v.clock_out,v.summary')
                    ->from('visit v')
                    ->join('visit_carepro vc','vc.visit_id=v.id','left')
                    ->where('v.case_id',$case_id)
                    ->where('v.status','Completed')
                    ->order_by('v.id','desc')->get();

            if($query->num_rows()>0)
                return $query->result();
            
            return false;
        }

	

	
}
