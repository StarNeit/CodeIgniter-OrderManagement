<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends Admin_Controller {

	public function index()
	{
		$this->render('admin/staff/billing');
	}

}