<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Site_Controller extends CI_Controller
{
	
	function __construct()
  	{
		parent::__construct();

		$this->user_id = $this->user_type = '';

		$user = $this->session->userdata('user');
		if($user){
			$this->user_id = $user->id;
			$this->user_type = $this->session->userdata('logged');
		}

		$this->data = array('title'=>'');
	}

	public function render($view, $data=array(), $layout = 'layout')
	{		
		$data   = array_merge($this->data, $data);

		if($this->input->is_ajax_request())
		{
			$this->load->view($view, $data);
		}
		else
		{			
			$data['view_file'] = $view;
			$this->load->view($layout, $data);
		}
	}
	
}

class Client_Controller extends Site_Controller
{
	

	protected function protect_user()
	{		
		if($this->user_type <> 'Client')
		{
			show_info_page("You have to login to acces this page");
		}
	}

}


class Care_Controller extends Site_Controller
{

	/**
	 * allow to manage carepro pages only for CarePro type of users
	 */
	protected function protect_user()
	{		

		if($this->user_type <> 'CarePro')
		{
			show_info_page("You have to login to acces this page");
		}
	}

	
}



class Admin_Controller extends CI_Controller
{
	public $user = NULL; //intialized in constructor

   function __construct()
   {
		parent::__construct();

	
		$this->data = array('title'=>'');
		$this->filter = NULL;
		$this->permissions = null;

		$this->load->helper('form');

		$admin_path = $this->config->item('admin_path');	
		$s1 = $this->uri->segment(1);
		$s2 = $this->uri->segment(2);
		$s3 = $this->uri->segment(3);	

		$this->user = $user = $this->session->userdata('user');

		if($this->session->userdata('logged')!='admin'){//user is  not logged as admin
			
			if($s2!='auth'){				
				//check if it's ajax request
				if($this->input->is_ajax_request()){
					//return redirect url to login page
					$data['error'] = "Your session has expired";
					$data['redirect'] = admin_url('auth/login');
					send_json($data);
				}
				else
				{
					//remember last url, so when user will login will be redirected here
					$this->session->set_userdata(array('return_url'=>current_url()));
				}
				admin_redirect('auth/login');
			}
		}

		if(!isset($user->role_code)){
			return;
		}
		
		//permissions block
		$role = $user->role_code;
		
		//die($role);
		if($role != 'super'){ //if admin is not superuser
			
			//get user permissions
			$this->load->model('permissions_model');
			$permissions = $this->permissions_model->get_items($role);
			$this->permissions = $permissions;

			if($s2=='auth'){return;}
			if(!$s2){$s2 = 'home';}
			if(!$s3){$s3 = 'index';}
			
			$code = trim($s2.'/'.$s3, '/');
			
			//check user permissions
			if(!isset($permissions[$code]))
			{
				//user don't have permission to this section
				if($this->input->is_ajax_request())
				{
					$data['error'] = "You don't have permission for this operation";
					send_json($data);
				}
				else
				{
					$data['error'] = "You don't have permission to view this page";
					echo $this->render('admin/message_view', $data, TRUE);
					die();					
				}
			}
		}
	}
	

	public function render($view, $data=array(), $return = FALSE)
	{
        $data   = array_merge($this->data, $data);
            
		if($this->input->is_ajax_request()){
			$this->load->view ($view, $data);
		}
		else
		{
			
			//$data['breadcrumb'] = $this->_generate_breadcrumb();
			$data['view_file'] = $view;
			$data['is_popup'] = $this->input->get('t')=='popup';
			return $this->load->view('admin/staff/dashboard_layout', $data, $return);
		}
	}


	function _set_filter($fields = array())
	{
		$controller = get_class($this);

		if(isset($_POST['filter']))
		{
			$filter['controller']=$controller;
			$filter['sort_col']=$this->input->post('sort_col');
			$filter['sort_dir']=$this->input->post('sort_dir');
			$filter['per_page'] = $this->input->post('filter_per_page');
			foreach($fields as $field){
				$filter[$field] = $this->input->post('filter_'.$field, true);
			}
		}
		else
		{
			$filter=$this->session->userdata('filter');
			if(isset($filter['controller']))
			{
			    if($filter['controller']!=$controller)
					$filter= null;
			}
		}

		$this->session->set_userdata('filter', $filter);
		$this->filter = is_array($filter) ? $filter : array();
	}

	/**
	 * Return associative array, where key is link uri and value is link text
	 */
	function _generate_breadcrumb()
	{
		$s1 = $this->uri->segment(2);
		$s2 = $this->uri->segment(3);
		$s3 = $this->uri->segment(4);

		$breadcrumb['home'] = 'Dashboard';
		if($s1 && $s1!='home'){
			$breadcrumb[$s1] = ucfirst(str_replace('_', ' ', $s1)); 
		}
		if($s2)
		{				
			$breadcrumb[''] = ucfirst(str_replace('_', ' ', "$s2 $s3")); //no link
		} 
		return $breadcrumb;
	}

}

class Staff_Controller extends CI_Controller
{
	var $data;

	function __construct()
	{
		parent::__construct();
	}

	protected function render($view, $layout = 'admin/staff/dashboard_layout') {

		//Set view name...
		$this->data['view_file'] = $view;
		$this->load->view($layout, $this->data);
	}

//	public function render($view, $data=array(), $layout = 'admin/staff/dashboard_layout')
//	{
//		if($this->input->is_ajax_request())
//		{
//			$this->load->view($view, $data);
//		}
//		else
//		{
//			$data['view_file'] = $view;
//			$this->load->view($layout, $data);
//		}
//	}

}