<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Roles_m extends MY_Model
{
	protected $table = "admin_roles";
	protected $primary_key = "code";
	protected $columns = array(
		'code'	=>	array('Pet Code', 'trim|required'),
		'name'=>	array('Name', 'trim|required|ucfirst'),
		'description'=>	array('Description', 'trim')
	);


	function set_filter($filter)
	{
        return;
	}

	function get_items ($filter, $offset, $limit, $export=false)
	{
		$this->set_filter($filter);
        $this->db->from($this->table);

		if($limit){
			$this->db->limit($limit, $offset);
		}

		if(isset($filter->sort_col) && $filter->sort_col){
			$this->db->order_by($filter->sort_col, $filter->sort_dir);
		}
		$query = $this->db->get();
		if($export) {return $query;};

		return $query->result();
	}

	function get_count($filter)
	{
		$this->set_filter($filter);
		$this->db->select('count(*) as num');
		$query = $this->db->get($this->table);
		$row =  $query->row();
		return $row->num;
	}

	function get_export_query()
	{
		return $this->get_items(null, null, null, TRUE);
	}

}


