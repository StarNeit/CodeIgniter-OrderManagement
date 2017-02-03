<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Availability_m extends MY_Model{
	
	protected $table = 'carepro_availability';
	protected $primary_key = 'id';
	protected $columns = array(
		'user_id' => array('User Id', 'trim|required'),
		'start' => array('Start', 'trim|required'),
		'end' => array('End', 'trim'),
		'all_day' => array('All Day', 'trim'),
	);	
	

	
	function set_filter($filter)
	{
		$status = element('status', $filter, 2);
		if($status !=2 ){
			$this->db->where('c.is_active', $status);
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

	public function get_schedule($start, $end, $user_id)
	{
		$this->db->select('id, "Available" as title, all_day AS allDay', FALSE)
				->select('if(start > NOW(), 1, 0) AS is_future', FALSE)
				->select('if(end > NOW(), "event-color-green", "event-color-gray") AS className', FALSE)
				->select('DATE_FORMAT(start,"%Y-%m-%dT%T+00:00") as start', FALSE) //return start in UTC format 
				->select('DATE_FORMAT(end,"%Y-%m-%dT%T+00:00") end', FALSE) //return end in UTC format
				->where('user_id', $user_id)
				->where('start >=', $start)
				->where('end <=', $end);
	
		$query = $this->db->get($this->table);		
		return $query->result();
	}

	/**
	 * this function is used for clone user availability
	 */
	public function week_availability($start, $end, $user_id)
	{
		$this->db->where('user_id', $user_id)
				->where('start >=', $start)
				->where('end <=', $end);
	
		$query = $this->db->get($this->table);		
		return $query->result();
	}

	/**
	 * insert cloned availability
	 */
	public function insert_multiple_records($records)
	{
		return $this->db->insert_batch($this->table, $records);
	}

	public function is_set_availability($start, $end, $user_id)
	{
		$this->db->where('user_id', $user_id)
				->where('start >=', $start)
				->where('end <=', $end);
	
		$query = $this->db->get($this->table);		
		return $query->num_rows();
	}

	public function all_users_schedule($start, $end)
	{
		$this->db->select('id, concat("Available (",count(id), ")") as title, 1 AS allDay', FALSE)
				->select('if(start > NOW(), 1, 0) AS is_future', FALSE)
				->select('if(end > NOW(), "event-color-green", "event-color-gray") AS className', FALSE)
				->select('DATE_FORMAT(start,"%Y-%m-%dT%T+00:00") as start', FALSE) //return start in UTC format 
				->select('DATE_FORMAT(end,"%Y-%m-%dT%T+00:00") end', FALSE) //return end in UTC format
				->where('start >=', $start)
				->where('end <=', $end)
				->group_by('DATE(start)');
	
		$query = $this->db->get($this->table);		
		return $query->result();
	}

	/**
	 * return carepro users schedule for a specified date 
	 */
	public function carepro_day_availablity($date)
	{
		$this->db->select('a.*, CONCAT(u.first_name," ", u.last_name) as full_name', FALSE)
					->from("$this->table a")
					->join("user u", "u.id = a.user_id", "left")
					->where('DATE(start)', $date);
		$query = $this->db->get();
		return $query->result();
	}



}
