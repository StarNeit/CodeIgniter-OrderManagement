<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Care_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->protect_user();
	}

	public function index()
	{
		$data = array(
			'title' => 'Account Settings',
		);
	
		$this->render('carepro/account_view', $data);		
	}

}

/* End of file Account.php */
/* Location: ./application/controllers/carepro/Account.php */