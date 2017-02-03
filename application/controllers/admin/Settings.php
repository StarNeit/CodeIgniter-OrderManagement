<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends Admin_Controller {

	function __construct()
	{

		parent::__construct();
		$this->load->helper('application');
		$this->load->helper('settings');
		
		$this->filename = 'settings.php';

	}

	public function index()
	{
		
		$settings = load_setting_file($this->filename);			

		$data['settings'] = $settings;		
		$data['title'] = 'Site settings';		
		$this->render("admin/settings/settings_view", $data);
	}
	

	public function save(){
			
		$settings = $this->input->post('settings');

		$res = save_setting_file($this->filename, $settings, $return=FALSE);

		if($res){
			set_success('Saved successflly');
			$data['refresh'] = TRUE;
		}
		else{
			set_error('An error occured');
		}
		admin_redirect("settings");

	}


}
