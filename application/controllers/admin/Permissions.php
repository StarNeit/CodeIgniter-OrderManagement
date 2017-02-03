<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissions extends Admin_Controller {

	public $filter = null;

	function __construct()
	{
		parent::__construct();
		$this->load->model('permissions_m');
	}

	public function index($role_code="")
	{

		$data['title'] = "Manage Permissions";
		$data['roles'] = $this->permissions_m->get_roles_links(trim(conf('admin_path'),'/'));
		$data['role_code'] = $role_code;
		if($role_code){
			//scan controllers  from admin folder
			$funcs = array();
			$this->load->helper('file');
			$files = get_filenames(APPPATH.'controllers/'.conf('admin_path'));
			foreach($files as $file){
				$except = array('Permissions.php', 'Auth.php', 'Generate_module.php');
				if(in_array($file, $except)){continue;}

				$content = file_get_contents(APPPATH.'controllers/'.conf('admin_path').'/'.$file);

				$file = str_replace(".php", "", $file);
				$funcs[$file] = array();

				//extract all controller functions
				preg_match_all('#function (.*)\(#', $content, $matches);

				foreach($matches[1] as $func){
					if($func[0]!="_"){
						$funcs[$file][] = $func;
					}
				}
			}

			$data['funcs'] = $funcs;
			$data['items'] = $this->permissions_m->get_items($role_code);

		}

		$this->render('admin/permissions/permissions_view', $data);

	}

	function save(){
		$role_code = $this->input->post('role_code');
		$permissions = $this->input->post('perm');

		$this->permissions_m->save_permissions($role_code, $permissions);

		$data['success'] = "Permissions updated successfully";
		send_json($data);
	}

}


