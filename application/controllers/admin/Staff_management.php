<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_management extends Admin_Controller {

	public function index()
	{
		$this->render('admin/staff/management');
	}

}