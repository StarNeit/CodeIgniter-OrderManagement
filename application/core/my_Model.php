<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Model extends CI_Model
{
	protected $table='';
	protected $primary_key = 'id';
	protected $columns = array(
			
		);
	protected $errors = array();
	protected $success = array();


	protected function _after_insert($record_id='')
	{
		$this->util->log_action("INSERTED: $record_id", get_class($this));
	}

	protected function _after_update($record_id='')
	{
		$this->util->log_action("UPDATED:" . print_r($record_id, TRUE), get_class($this));
	}

	protected function _after_delete($record_id='')
	{
		$this->util->log_action("DELETED: $record_id", get_class($this));
	
	}
	protected function _after_toggle($action, $where)
	{	
		$this->util->log_action($action, get_class($this));
	}



	/**
	 * Validate post variables and return an array with fields and values for insert/update
	 */
	public function get_from_post($cols=NULL, $id='')
	{

		$fields = array();

		$this->load->library('form_validation');
		$this->form_validation->reset_fields();
		//let's set rules for each variables set in $columns member
		foreach($this->columns as $column => $options)
		{
			if($column == 'updated_at'){
				$_POST['updated_at'] = date('Y-m-d H:i:s');
			}
			if(!$cols || in_array($column, $cols))
			{
				$this->form_validation->set_rules($column, $options[0], $options[1]);
			}
		}
		// run fields validation
		if($this->form_validation->run())
		{	
			//post variables are clean 
			//prepare fields to be inserted/updated
			foreach($this->columns as $column => $options)
			{
				//check third parameter, if set false, 
				//then colum are from another table or should not be saved
				$not_this_table = isset($options[2]) && $options[2]===FALSE;
				if($not_this_table)
					continue;

				//check if current post variable name are from current table
				if(!$cols || in_array($column, $cols))
				{					
					$fields[$column] = $this->input->post($column, isset($options[4]) ? $options[4]: TRUE ); //xss_clean
				}
			}
			return $fields;
		}
		else{
			//validation fail
			$error = validation_errors() ? validation_errors() : "There are no fields to save";
			$this->errors[] = $error;
			return FALSE;
		}
	}

	public function add_columns($columns)
	{
		$this->columns + $columns;
	}	

	public function get_errors(){

		if(count($this->errors)==0)
			return FALSE;

		$result = "";
		foreach($this->errors as $error){
			$result .= $error;
		}
		return $result;
	}

	public function get_success(){

		if(count($this->success)==0)
			return FALSE;

		$result = "";
		foreach($this->success as $msg){
			$result .= $msg;
		}
		return $result;
	}

	public function get_results(){
		$errors = $this->get_errors();
		$result = array();
		if($errors){
		   	$result['error'] = $errors;
			$result['errors'] = $this->form_validation->get_errors();
		}
		else{
			$result['success'] = $this->get_success();
		}
		return $result;
	}

	public function insert_record($fields)
	{		
		if($this->db->insert($this->table, $fields))
		{
			$this->success[] = "Added successfully";
			$id = $this->db->insert_id();
			if(!$id) $id = true;
						
			$this->_after_insert($id);

			return $id;
			
		}
		else{
			$this->errors[] = $this->handle_error();
			return FALSE;
		}
	}

	public function update_record($fields, $condition){


		$this->db->set($fields);
		if(is_array($condition)){
			$this->db->where($condition);
		}
		else{
			$this->db->where($this->primary_key, $condition);
		}

		if($this->db->update($this->table)){
			$this->success[] = "Info Updated successfully";

			if($this->db->affected_rows()){
				$this->_after_update($condition);
			}
			
			return $condition;
		}
		else{
			$this->errors[] = $this->handle_error();
			return FALSE;
		}
	}

	public function get_record($cond=0, $error_on_null = TRUE)
	{
		if($cond){
			$where = is_array($cond) ? $cond : array($this->primary_key => $cond);
			$query = $this->db->get_where($this->table, $where);
			if($query->num_rows()>0){
				return $query->row();
			}
			if($error_on_null){
				return show_404();
			}			
			return FALSE;			
		}
		return $this->get_empty_record();
	}

	public function get_empty_record(){
		$result = new stdClass();
		foreach($this->columns as $column => $options)
		{
			$result->{$column} = isset($options[3]) ? $options[3] : "";
		}
		$result->{$this->primary_key} = "";
		return $result;
	}

	public function save($cond = 0, $cols = NULL){

		$fields = $this->get_from_post($cols, $cond);
		if($fields == FALSE){
			return FALSE;
		}
		if($cond){
			return $this->update_record($fields, $cond);
		}
		else{
			return $this->insert_record($fields);
		}

	}

	public function delete_record($where)
	{
		
		if(is_numeric($where) || is_string($where)){
			$where = array($this->primary_key => $where);
		}

		$this->db->limit(1); //only one record limit
		if( $this->db->delete($this->table, $where) )
		{
			$this->_after_delete(current($where));
			$this->success[] = "Removed successfully";
			return TRUE;
		}
		else
		{
			$this->errors[] = $this->handle_error();
			return FALSE;
		}

	}


	public function handle_error(){
       if(mysql_errno()== 1062){
       	  return  mysql_error(); //dublicate entry message
       }
	   else{
	       if(ENVIRONMENT == 'production'){
	       	  log_message('error', "Database error occured:\n" . mysql_error() . "\n" . $this->db->last_query());

			  return "Generic database error occured";

	       }
		   else{
		   	  return "Database error occured:<br/>" . mysql_error() . "<br>" . $this->db->last_query();
		   }
	   }
	}

	public function field_increment($where, $field)
	{
		if(is_numeric($where) || is_string($where)){
			$key = $this->primary_key;
			$value = $where;
		}
		else{
			$key = key($where);
			$value = $where[$key];
		}

		$sql="UPDATE $this->table SET $field=$field+1 WHERE $key=?";
		if(! $this->db->query($sql, array($value))){
			$this->errors[] = $this->handle_error();
			return FALSE;
	    }
	    return TRUE;

	}


	public function activate($where, $field="active")
	{
		if(is_numeric($where) || is_string($where)){
			$key = $this->primary_key;
			$value = $where;
		}
		else{
			$key = key($where);
			$value = $where[$key];
		}

		/*
		$sql="UPDATE $this->table SET $field=1-$field WHERE $key=?";
		if(! $this->db->query($sql, array($value))){
			$this->errors[] = $this->handle_error();
			return FALSE;
	    }*/

		//get current status of field
		$this->db->select($field)
			->where($key, $value);
		$row = $this->db->get($this->table)->row();
		$result = $row->$field;
		$result = 1 - $result; //change to opposite value

		//update record with opposite value
		$this->db->update($this->table, array($field=>$result), array($key=>$value));
	    
		$this->_after_toggle("$key = $value: SET $field = $result", $value);
	    
	    return 1;
	}

	public function get_options($table, $value, $text, $default_value="", $default_text="", $options="", $order_by="")
	{
		$this->db->select("$value, $text");
		$this->db->from($table);
		if($options)
	   		$this->db->where($options);
		if($order_by)
           $this->db->order_by($order_by);
		else
			$this->db->order_by($text);
		$query = $this->db->get();

		$result = array();
	    if($default_text)
			$result= array($default_value=>  " -- " . $default_text . " -- ");
		$rows = $query->result();
		foreach($rows as $row)
		{
			$result[$row->$value] = $row->$text;
		}
		return $result;
	}

	public function result_assoc($query, $key)
	{
		$result = array();
		while($row = $query->_fetch_object())
		{
			$result[$row->$key] = $row;
		}
		return $result;
	}

	public function result_assoc_array($query, $key, $value='', $empty_value='')
	{
		$result = array();
		if($empty_value){
			$result = array(''=>$empty_value);
		}

		while($row = $query->_fetch_object())
		{
			if($value){
				$result[$row->$key] = $row->$value;
			}
			else{
				$result[] = $row->$key;
			}			

		}
		
		return $result;
	}

	public function group_results($query, $key)
	{
		$result =array();
		while($row = $query->_fetch_object())
		{
			$result[$row->$key][] = $row;
		}
		return $result;		
	}

	public function last_query()
	{
		return "<pre>".$this->db->last_query()."</pre>";
	}

	/**
	 * This function return a two dimensional array for dropdowns with optgroups  
	 */
	public function optgroup_options($query, $group, $key, $value)
	{
		$result = array();
		$optgroup = ''; 

		while($row = $query->_fetch_object())
		{
			if($optgroup!=$row->$group)
			{
				$optgroup = $row->$group;
				$result[$optgroup] = array();				
			}
			$result[$optgroup][$row->$key] = $row->$value;
		}

		return $result;
	}


}