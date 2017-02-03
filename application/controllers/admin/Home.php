<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		$this->_set_filter(array('status', 'name'));	
		
	}

	public function index($offset = 0)
	{	
		$data = array(
			'title' => 'Dashboard',
		);
	
		$this->render('admin/home_view', $data);				
	}

	

	
}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */