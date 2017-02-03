<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends 	Site_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{		
	
		$data = array(
			'title' => conf('site_name'),
			'meta_d' => '',
			'is_home' => true,
		);
		
		$this->render('login-view', $data);
	}

	

	



}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */