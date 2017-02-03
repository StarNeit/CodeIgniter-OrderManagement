<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients_m extends MY_Model{
	
	protected $table = 'client';
	protected $primary_key = 'id';
	protected $columns = array(


		//columns from user table
		'salutation' => array('Salutation', 'trim|required', FALSE),
		'first_name' => array('First Name', 'trim|required', FALSE),
		'last_name' => array('Last Name', 'trim|required', FALSE),
		'email' => array('Email', 'trim|required', FALSE),
		'contact_home' => array('Contact Home', 'trim|required', FALSE),
		'contact_mobile' => array('Contact Mobile', 'trim|required', FALSE),
		'password' => array('Password', 'trim|required', FALSE),
		'password2' => array('Re-type Password', 'trim|matches[password]|required', FALSE),
		'salt' => array('Salt', 'trim|required', FALSE),
		'forgot_code' => array('Forgot Code', 'trim|required', FALSE),
		'verify_code' => array('Verify Code', 'trim|required', FALSE),
		'is_verified' => array('Is Verified', 'trim|required', FALSE),
		'user_type' => array('User Type', 'trim|required', FALSE),
		'verified_at' => array('Verified At', 'trim|required', FALSE),
		'registered_at' => array('Registered At', 'trim|required', FALSE),
		'is_active' => array('Is Active', 'trim|required', FALSE),

		//columns for language
		'language[]' => array('Language', 'required', FALSE),

		//columns user location		
		'postal_code' => array('Postal Code', 'trim|required', FALSE),
		'unit' => array('Unit', 'trim|required', FALSE),
		'block' => array('Block', 'trim|required', FALSE),
		'street' => array('Street', 'trim|required', FALSE),
		
		'user_id' => array('UserId', 'trim|required'),
		'know_how' => array('How did you know about Homage?', 'trim|required'),
		'agreement' => array('Agreement', 'trim|required', FALSE),

	);	


	function clientListing(){
            $query = $this->db->select('u.first_name,u.last_name,u.registered_at')->from($this->table.' c')->join('user u','c.user_id=u.id')->where('u.user_type','Client')->get();
            
            if($query->num_rows()>0)
                return $query->result();
            
            return false; 
        }


    function set_filter($filter)
	{	if($q = element('q', $filter)){
			if($q != 'Nil'){
				$this->db->like('CONCAT(u.first_name, " ", u.last_name, u.email,u.contact_mobile)', $q);
			}
			
		}
			$this->db->where('u.user_type', 'Client');	
		if($orderby = element('orderby', $filter)){
				$orderby == 'u.'.$orderby;
			$this->db->order_by($orderby, element('order', $filter));
		}		
		
	}

	function get_items($filter, $offset=0, $limit= LIMIT)
	{
		$this->set_filter($filter);
		$this->db->select("u.*")
				->from("user u")
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
		$query = $this->db->get("user u");
		$row =  $query->row();
		return $row->num;
	}

	function get_client($user_id, $show_error = FALSE)
	{
		$query = $this->db->select('l.*, u.*')
						->from('user u')
						->join('user_location l', 'l.user_id = u.id', 'left')
						->where('u.id', $user_id)
						->get();

		if($query->num_rows() == 0)
		{
			if($show_error)
			{
				return show_404();
			}
			else{
				$client = $this->clients_m->get_empty_record();
			}
		}
		else
		{
			$client = $query->row();				
		}
	
		$client->full_name = $client->first_name . ' ' . $client->last_name;
		$client->languages = $this->user_languages($user_id);

		return $client;
	}

	function user_languages($user_id)
	{
		if(!$user_id){
			return array();
		}
		$query = $this->db->get_where('user_language', array('user_id' => $user_id));
		return $this->result_assoc_array($query, 'language');
	}
	function clientLists(){
            $query = $this->db->select('u.id,u.first_name,u.last_name')->from($this->table.' c')->join('user u','c.user_id=u.id')->where('u.user_type','Client')->get();
            
            if($query->num_rows()>0)
                return $query->result();
            
            return false; 
        }


}
