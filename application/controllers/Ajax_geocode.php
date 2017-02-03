<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_geocode extends Site_Controller {

	public function index()
	{
		
		$this->load->library('geocode'); 
        $zipData = $this->geocode->zip_reverse($_REQUEST['postal_code']);
                
        die(json_encode($zipData));
	}

}