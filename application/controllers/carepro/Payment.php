<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Care_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->protect_user();
	}

	public function index()
	{
		$data = array(
			'title' => 'Payment',
		);
	
		$this->render('carepro/payment_view', $data);	
	}

}

/* End of file Payment.php */
/* Location: ./application/controllers/carepro/Payment.php */