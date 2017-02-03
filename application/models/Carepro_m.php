<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carepro_m extends MY_Model{
	
	protected $table = 'carepro';
	
	protected $primary_key = 'id';
	
	protected $columns = array(
		'user_id' => array('User Id', 'trim'),
		'nationality' => array('Nationality', 'trim|required'),
		'national_id' => array('National Id', 'trim|required'),
		'dob' => array('Date of Birth', 'trim|required|database_date'),
		//'dob_date' => array('Date', 'trim|required', FALSE),
		//'dob_month' => array('Month', 'trim|required', FALSE),
		//'dob_year' => array('Year', 'trim|required', FALSE),

		'gender' => array('Gender', 'trim|required'),
		'weight' => array('Weight', 'trim|required'),
		'height' => array('Height', 'trim|required'),
		'religion' => array('Religion', 'trim|required'),
		'race' => array('Race', 'trim|required'),
                'summary' => array('Summary', 'trim'),
		'medical_conditions' => array('Medical Conditions', 'trim|required'),
		'smart_phone' => array('Smart Phone', 'trim|required'),
		'registered_at' => array('Registered At', 'trim|required'),

		//columns to validate from users table
		'email' => array('Email', 'trim|required|valid_email', FALSE),
		//'salutation' => array('Salutation', 'trim|required', FALSE),
		'first_name' => array('First Name', 'trim|required', FALSE),
		'last_name' => array('Last Name', 'trim|required', FALSE),
		'contact_home' => array('Contact Home', 'trim|required', FALSE),
		'contact_mobile' => array('Contact Mobile', 'trim|required', FALSE),
		'password' => array('Password', 'trim|required', FALSE),
		'password2' => array('Confirm password', 'trim|matches[password]|required', FALSE),
		
		'user_type' => array('User Type', 'trim|required', FALSE),
		
	
		//columns for language
		'language[]' => array('Language', 'required', FALSE),

		'skill[]' => array('Type of Care', 'required', FALSE),

		//columns user location		
		'street' => array('Street', 'trim|required', FALSE),
		'block' => array('Block', 'trim|required', FALSE),
		'unit' => array('Unit', 'trim|required', FALSE),
		'postal_code' => array('Postal Code', 'trim|required', FALSE),
	);

	
	function set_filter($filter)
	{
		if($status = element('status', $filter))
		{
			if($status == 'applicant'){
				$this->db->where_in('c.application_status', array('Received','In-Review','Shortlisted'));
			}
			else
			{
				$this->db->where('c.application_status', $status);
			}
		}
		if(element('is_verified', $filter)){
			$this->db->where('u.is_verified', 1);
		}
		if($q = element('q', $filter)){
			if($q != 'Nil'){
				$this->db->like('CONCAT(u.first_name, " ", u.last_name, u.email,c.nationality)', $q);
			}
		}
		if($orderby = element('orderby', $filter)){

			if ($orderby == 'first_name') {
				$orderby == 'u.first_name';
			}else{
				$orderby == 'c.'.$orderby;
			}
			$this->db->order_by($orderby, element('order', $filter));
		};	
	}

	function get_items($filter, $offset=0, $limit=LIMIT)
	{
		$this->set_filter($filter);
		$this->db->select("c.*, u.*")
				->from("$this->table c")
				->join("user u", "u.id=c.user_id", 'lef')
				->limit($limit, $offset);		
		
		if($sort_col = element('sort_col', $filter, 'u.id')){
			$this->db->order_by($sort_col, element('sort_dir', $filter, 'asc'));
		}
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_count($filter)
	{
		$this->set_filter($filter);
		$this->db->select('count(*) as num')
			->join("user u", "u.id=c.user_id", 'lef');

		$query = $this->db->get("$this->table c");
		$row =  $query->row();
		return $row->num;
	}

	public function get_user($user_id, $api = false)
	{
		$query = $this->db->select('u.*,c.*,l.*,c.id as carepro_id,a.experience_years,a.experience_summary,a.criminal_record,a.criminal_detail,a.full_name,a.ref_name,a.ref_relationship,a.ref_contact,a.ref_email,a.sec_ref_name,a.sec_ref_relationship,a.sec_ref_contact,a.sec_ref_email')
						->from('user u')
						->join('carepro c', 'c.user_id = u.id', 'left')
						->join('carepro_application a', 'a.user_id = u.id', 'left')
						->join('user_location l', 'l.user_id = u.id', 'left')
						->where('u.id', $user_id)
						->get();

		if($query->num_rows() == 0){
                    if ($api)
			return $this->lang->line('resp_invalid_carepro');
                    else show_404();
		}

		$user = $query->row();	
		$user->full_name = $user->first_name . ' ' . $user->last_name;	
		$user->languages = $this->user_languages($user_id);
		$user->certificates = $this->user_certificates($user_id);
		$user->documents = $this->user_documents($user_id);
		$user->experiences = $this->user_experiences($user_id);
		$user->trainings = $this->user_trainings($user_id);
		$user->skills = $this->user_skills($user_id);
		$user->user_id = $user_id;

                if ($api) { // Do any other update of array to fit for API purpose
                    $user->photo = "https://s3-ap-southeast-1.amazonaws.com/ac-homage/carepro/$user->id/avatar/big/$user->photo";
                }
		return $user;
	}

	function user_languages($user_id)
	{
		$query = $this->db->get_where('user_language', array('user_id' => $user_id));
		return $this->result_assoc_array($query, 'language');
	}

	function user_certificates($user_id)
	{
		$query = $this->db->get_where('carepro_certification', array('user_id' => $user_id));
		return $query->result();
	}
	function user_documents($user_id)
	{
		$query = $this->db->get_where('carepro_document', array('user_id' => $user_id));
		return $this->group_results($query, 'type');
	}
	function user_experiences($user_id)
	{
		$query = $this->db->get_where('carepro_experience', array('user_id' => $user_id));
		return $this->result_assoc_array($query, 'experience');
	}
	function user_trainings($user_id)
	{
		$query = $this->db->get_where('carepro_training', array('user_id' => $user_id));
		return $this->result_assoc_array($query, 'training');
	}

	public function user_skills($user_id)
	{
		if(!$user_id){
			return array();
		}
		$query = $this->db->get_where('carepro_skill', array('user_id' => $user_id));
		return $this->result_assoc_array($query, 'skill_id');
	}

	public function save_skills($skills, $user_id)
	{
		//remove old values
		$this->db->where('user_id', $user_id)->delete('carepro_skill');
		
		$insert = array();

		foreach($skills as $skill_id)
		{
			$insert[] = array('skill_id' => $skill_id, 'user_id' => $user_id);
		}
		if($insert){
			$this->db->insert_batch('carepro_skill', $insert);
		}
	}

	public function user_services($skills_ids)
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


	

	public function getTableName() {
		return 'carepro';
	}

	public function getApprovedCarePro() {

		//Get table names to use
		$tableCarepro = $this->getTableName();
		$tableUsers   = 'user';

		//Get result from DB
		$result = $this->db
			->join($tableUsers, "$tableUsers.id = $tableCarepro.user_id", 'left')
			->from($tableCarepro)
			->get()
			->result();

		$carePro = [];

		foreach ($result AS $key => $value) {

			$carePro[$key] = $value;

		}

		return $carePro;

	}

	public function getApprovedCareProById($id) {
		//Get table names to use
		$tableCarepro = $this->getTableName();
		$tableUsers   = 'user';
		$tableLanguages = 'user_language';
		//Get result from DB
		$result = $this->db
			->join($tableUsers, "$tableUsers.id = $tableCarepro.user_id", 'left')
			->join($tableLanguages, "$tableLanguages.user_id = $tableCarepro.user_id", 'left')
			->from($tableCarepro)
			->where("$tableUsers.id", $id)
			->get()
			->result();

		$careProDetails = [];

		foreach ($result AS $key => $value) {

			$careProDetails[$key] = $value;

		}

		return $careProDetails;

	}

	public function saveEdited($id, $data) {

		//Get table names to use
//		$data = $this->input->post('firstName');

		//Get result from DB
		$this->db
			->where('id', $id)
			->set('first_name', $data['firstName'])
			->set('last_name', $data['lastName'])
			->set('email', $data['email'])
			->set('contact_home', $data['contact-home'])
			->set('contact_mobile', $data['contact-mobile'])
			->set('salutation', $data['salutation'])
			->update('user');
		$this->db
			->where('user_id', $id)
			->set('nationality', $data['nationality'])
			->set('religion', $data['religion'])
			->set('race', $data['race'])
			->set('gender', $data['gender'])
			->update('carepro');
		$this->db
			->where('user_id', $id)
			->set('language', $data['languages'])
			->update('user_language');
		return 'Success';

	}

	public function get_rating($user_id)
	{
		$query = $this->db->get_where('visit_carepro', array('carepro_id' => $user_id));
		$visit = $this->result_assoc_array($query, 'visit_id');

                if(count($visit)>0)
                {
                    $this->db->select('AVG(rating) as rating');
                    $visit_query = $this->db->where_in('id', $visit)->get('visit');
                    return $visit_query->result()[0]->rating;
                }
		return 0;
	}

	public function get_tasks($user_id)
	{
		$query = $this->db->get_where('visit_carepro', array('carepro_id' => $user_id));
		$visit = $this->result_assoc_array($query, 'visit_id');
                if(count($visit)>0)
                {
                    $this->db->select('id,visit_from,summary,rating');
                    $tasks = $this->db->where_in('id', $visit)->get('visit');
                    return $tasks->result();
                }
		return array();
	}


	

}
