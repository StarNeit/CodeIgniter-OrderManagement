<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Client_Controller {

	public function index()
	{
		$data = array(
			'title' => 'Payment',
		);
	
		$this->render('client/payment_view', $data);	
	}

}

/* End of file Payment.php */
/* Location: ./application/controllers/client/Payment.php */