<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class {{u_controller_name}} extends Admin_Controller {

	
	function __construct()
	{
		parent::__construct();
		$this->load->model('{{model_name}}');
		$this->_set_filter(array('status', 'name'));	
		
	}

	public function index($offset = 0)
	{ 	
		$data = array(
			'title' => "{{u_controller_name}} List",
			'items' => $this->_get_list($offset),
		);
		$this->render("admin/{{controller_name}}/{{controller_name}}_view", $data);
	}

	private function _get_list($offset=0)
	{     
		$count = $this->{{model_name}}->get_count($this->filter);
		$limit = element('per_page', $this->filter, LIMIT);

		// pagination
		$config = array(
			'base_url' => admin_url("{{controller_name}}/index/"),
			'uri_segment' => 4,
			'total_rows' => $count,
			'per_page' => $limit,
		);
		$this->load->library('pagination');
		$this->pagination->initialize($config);

        return $this->{{model_name}}->get_items($this->filter, $offset, $limit);
	}
	
	function get_ajax_list()
	{		
		$d['items'] = $this->_get_list();
		$data['list'] = $this->load->view('admin/{{controller_name}}/{{controller_name}}_list', $d, TRUE);
		send_json($data);
	}

	function add()
	{
		$this->edit(0);
	}

	function edit($id)
	{		
		$item = $this->{{model_name}}->get_record($id);

    	$data = array(
    		'title' => $id ? "Edit item" : "Add item",
    		'item' => $item,
    	);
    	
    	$this->render('admin/{{controller_name}}/{{controller_name}}_edit', $data);
	}

	function save()
	{
    	$id = $this->input->post('id');
		$rec_id = $this->{{model_name}}->save($id);
		$data = $this->{{model_name}}->get_results();
		if($rec_id){
			$data['redirect'] = $this->input->post('page_redirect');
			set_success($data['success']);
		}			
		send_json($data);
	}

	
	function activate()
	{
		$id = $this->input->post('id');
		echo $this->{{model_name}}->activate($id, 'active');
	}
	


	function delete()
	{
    	$id = $this->input->post('id');
		$this->{{model_name}}->delete_record($id);
		$data = $this->{{model_name}}->get_results();	
		send_json($data);
	}

}


