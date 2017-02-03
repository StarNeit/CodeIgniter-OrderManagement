<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operations extends Admin_Controller {

	public function index()
	{
		$this->render('admin/staff/daily_view');
	}

}