<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends MY_Model{
	
	protected $table = 'user';
	protected $primary_key = 'id';
	protected $columns = array(
		'email' => array('Email', 'trim|required'),
		'salutation' => array('Salutation', 'trim|required'),
		'first_name' => array('First Name', 'trim|required'),
		'last_name' => array('Last Name', 'trim|required'),
		'contact_home' => array('Contact Home', 'trim|required'),
		'contact_mobile' => array('Contact Mobile', 'trim|required'),
		'password' => array('Password', 'trim|required'),
		'salt' => array('Salt', 'trim|required'),
		'forgot_code' => array('Forgot Code', 'trim|required'),
		'verify_code' => array('Verify Code', 'trim|required'),
		'is_verified' => array('Is Verified', 'trim|required'),
		'user_type' => array('User Type', 'trim|required'),
		'verified_at' => array('Verified At', 'trim|required'),
		'registered_at' => array('Registered At', 'trim|required'),
		'is_active' => array('Is Active', 'trim|required'),
		
	);	


	function create_account_from_post()
	{
//		$this->columns['email'][1] .="|is_unique[user.email]"; 	// add unique email validation rule
		
		$password = element('password', $_POST);
		$_POST['salt'] = $salt = substr(md5(rand()), 0, 12);
		$_POST['password'] = pass_hash($password,$salt); //change password with hashed version
		$_POST['registered_at'] = date(DATE);

		$fields = array(
			'email', 
			'first_name', 
			'last_name',
			'contact_home',
			'contact_mobile',
			'password',
			'salt',
			'user_type',
			'registered_at'
		);
		return $this->save(NULL, $fields);	
	}

	public function set_password($password, $user_id)
	{
		$salt = substr(md5(rand()), 0, 12);
		$password = pass_hash($password,$salt);
		$this->update_record(array('salt' => $salt, 'password' => $password), $user_id);
	}

	public function save_languages($languages, $user_id)
	{
		//remove old values
		$this->db->where('user_id', $user_id)->delete('user_language');
		$insert = array();
		foreach($languages as $language)
		{
			$insert[] = array('language' => $language, 'user_id' => $user_id);
		}
		if($insert){
			$this->db->insert_batch('user_language', $insert);
		}
	}

	public function save_address_from_post($user_id)
	{
		$this->load->model('user_location_m');
		
		//check if address exists
		$address = $this->user_location_m->get_record(array('user_id' => $user_id), FALSE);
		$address_id = $address ? $address->id : 0;

		$_POST['user_id'] = $user_id;
		$id = $this->user_location_m->save($address_id);
		if(!$id){
			$data = $this->user_location_m->get_results();
			trigger_error($data['error']);
		}
		return $id;
	}


	

	
	function set_filter($filter)
	{
		$status = element('status', $filter, 2);
		if($status !=2 ){
			$this->db->where('c.is_active', $status);
		}
		if($name = element('name', $filter)){
			$this->db->like('c.email', $name);
		}

	}

	function get_items($filter, $offset, $limit)
	{
		$this->set_filter($filter);
		$this->db->select("c.*")
				->from("$this->table c")
				->limit($limit, $offset);		
		
		if($sort_col = element('sort_col', $filter, 'id')){
			$this->db->order_by($sort_col, element('sort_dir', $filter, 'desc'));
		}
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_count($filter)
	{
		$this->set_filter($filter);
		$this->db->select('count(*) as num');
		$query = $this->db->get("$this->table c");
		$row =  $query->row();
		return $row->num;
	}

	function login($email, $password)
	{
		$query = $this->db->get_where($this->table, array('email'=>$email));
			
		if($query->num_rows()==1)
		{
			$user = $query->row();			

			//check password
			if($user->password == pass_hash($password,$user->salt)){
				return $user;
			}
			return FALSE;
		}
		return FALSE;
	}

	function update_password($user_id, $password, $new_password){

		$query = $this->db->get_where($this->table, array('id'=>$user_id));
			
		if($query->num_rows()==1)
		{
			$user = $query->row();			

			//check password
			if($user->password == pass_hash($password,$user->salt)){
				$this->set_password($new_password,$user_id);
				return true;
			}
			return FALSE;
		}
		return False;

	}

	public function get_user_by_email($email)
	{
		$query = $this->db->get_where($this->table, array('email'=>$email));
		if ($query->num_rows()==1) {
			return $query->row();
		}
		return false;
	}


	

}
