<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
	public function get_errors(){
		return $this->_error_array;
	}

	public function reset_fields(){
		$this->_error_array = array();
		$this->_field_data = array();
	}

	public function db_exists($str, $field){
		return  !$this->is_unique($str, $field);
	}

	public function great_or_equal($str, $field)
	{
		
		if ( ! isset($_POST[$field]))
		{
			return FALSE;
		}

		$val = $_POST[$field];
		
		if($str < $val){
			$this->set_message('great_or_equal', "The $field must be greater or equal");
			return FALSE;
		}
		return TRUE;		
	}

	public function great_than_field($str, $field)
	{
		
		if ( ! isset($_POST[$field]))
		{
			return FALSE;
		}

		$val = $_POST[$field];

		if($str < $val){
			$this->set_message('great_than_field', "The $str must be greater");
			return FALSE;
		}		
		return TRUE;		
	}

	public function multiplier($str, $multi)
	{
		$multipliers = explode(',', $multi);
		foreach($multipliers as $multiplier){
			if($str % $multiplier!=0){
				$this->set_message('multiplier', "Must be multiplier of $multi");
				return FALSE;
			}
		}
		return TRUE;
	} 

	function database_date($date)
	{
		$date = str_replace('/', '-', $date);
		
		$time = strtotime($date);
		
		if($time){
			return date('Y-m-d H:i:s', strtotime($date));
		}
		$this->set_message('database_date', "Invalid date $date");
		return FALSE;
	}

	public function greater_date_than_field($date, $field)
	{
		
		if ( ! isset($_POST[$field]))
		{
			return FALSE;
		}

		$val = $this->database_date($_POST[$field]);


		if(strtotime($date) < strtotime($val))
		{
			$this->set_message('greater_date_than_field', "Invalid date, it must be greater");
			return FALSE;
		}		
		return TRUE;		
	}

	public function future_date($date)
	{
		if(strtotime($date) < time())
		{
			$this->set_message('future_date', 'Invalid date, please choose a future date');
			return FALSE;
		}
		return TRUE;
	}

	function convert_gmt($date)
	{		
		if(strlen($date) < 11) //date without time
		{
			return date('Y-m-d H:i:s',strtotime($date));
		}
		return gmdate('Y-m-d H:i:s',strtotime($date));
	}

	

}