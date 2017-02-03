<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends Site_Controller {

	public function index()
	{
		$this->util->error_404();
	}

}

/* End of file error.php */
/* Location: ./application/controllers/error.php */