<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_location_m extends MY_Model{
	
	protected $table = 'user_location';
	protected $primary_key = 'id';
	protected $columns = array(
		'user_id' => array('User Id', 'trim|required'),
		//'building' => array('Building', 'trim|required'),
		'street' => array('Street', 'trim|required'),
		'block' => array('Block', 'trim|required'),
		'unit' => array('Unit', 'trim|required'),
		'postal_code' => array('Postal Code', 'trim|required'),
	);	
	

	
	function set_filter($filter)
	{
		$status = element('status', $filter, 2);
		if($status !=2 ){
			$this->db->where('c.active', $status);
		}
		if($name = element('name', $filter)){
			$this->db->like('c.user_id', $name);
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

}