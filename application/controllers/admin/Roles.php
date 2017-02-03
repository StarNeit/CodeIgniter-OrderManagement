<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends Admin_Controller {

	public $filter = null;
	public $count = null;
	function __construct()
	{
		parent::__construct();
		$this->load->model('roles_m', 'model');
		$this->_set_filter(array('status'));
	}

	public function index($offset = 0)
	{
		$data['title'] = "Manage Roles";
		$data['items'] = $this->_get_list($offset);
		$data['count'] = $this->count;
		$this->render('admin/roles/roles_view', $data);
	}

	private function _get_list($offset){

		$limit = 15;
		$this->count = $this->model->get_count($this->filter);
		$this->_pagination($this->count, $limit);
		return $this->model->get_items($this->filter, $offset,$limit);
	}


	public function _pagination($count, $limit){
		$config['base_url'] = admin_url("roles/index/");
		$config['total_rows'] = $count;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] =10;
		$this->load->library('pagination');
		$this->pagination->initialize($config);
	}

	function get_ajax_list(){
		
		$d['items'] = $this->_get_list(0);

		$data['list'] = $this->load->view('admin/roles/roles_list', $d, TRUE);
		send_json($data);
	}

	function add(){
		$this->edit(0);
	}

	function edit($id){
		$data['title'] = $id ? "Edit role" : "Add role";
		$data['item'] = $this->model->get_record($id);
		$this->render('admin/roles/roles_edit', $data);
	}

	function save(){
		$id = $this->input->post('id');
		$this->model->save($id);
		$data = $this->model->get_results();
		if(isset($data['success'])){
			set_success($data['success']);
			$data['redirect'] = admin_url('roles');
		}
		send_json($data);
	}

	function activate(){
		$id = $this->input->post('id');
		echo $this->model->activate($id);
	}

	function delete(){
		$id = $this->input->post('id');
		$this->model->delete_record($id);
		$data = $this->model->get_results();	
		send_json($data);
	}

}


