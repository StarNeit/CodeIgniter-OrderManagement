<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Care_recipients extends Client_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->protect_user();

		$this->load->model('clients_m');
		$this->load->model('recipients_m');

		
		
	}


	public function index()
	{
		
		//get user recipients
		$filter = array(
			'user_id' => $this->user_id, 
			'languages' => true,
			'services'	=> true,
		);
		$items = $this->recipients_m->get_items($filter);
		
		$data = array(
			'title' => 'Care Recipients',
			'items' => $items,
		);
		
	
		$this->render('client/care_recipient_view', $data);	
	}

}

/* End of file Care_recipients.php */
/* Location: ./application/controllers/client/Care_recipients.php */