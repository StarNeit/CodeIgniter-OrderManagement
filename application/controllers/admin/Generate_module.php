<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_module extends Admin_Controller {

	
	public function index($table_name='')
	{

		$fields = array();

		//get database tables
		$sql = "SHOW TABLES";
		$query = $this->db->query($sql);
		$result = $query->result();
		foreach($result as $row){
			foreach($row as $key => $tbl){
				$tables[] = $tbl;
			}
		}		


		if($table_name)
		{
			//check module name
			if(in_array($table_name, $tables)){
				$sql = "SHOW COLUMNS FROM `$table_name`";
				$query = $this->db->query($sql);
				$fields = $query->result();	
			}
			else{
				$error =  "Invalid table: $table_name";		
				$table_name ='';			
			}
		}

		$data = array(
				'title' => "Generate Module",
				'error' => isset($error) ? $error : FALSE,
				'table_name' => $table_name,
				'fields' => $fields,
				'tables' => json_encode($tables),

			);
		$this->render("admin/generate_module/generate_module_view", $data);
	}

	
	function create_module()
	{
		$only_model = $this->input->post('only_model');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('table_name', 'Table Name',  'trim|required');
		if($only_model){
			$this->form_validation->set_rules('model_name', 'Model Name', 'trim|required|alpha_dash');
		}
		else{
			$this->form_validation->set_rules('alias', 'Controller Name', 'trim|required|alpha_dash|callback_not_dublicate');
			$this->form_validation->set_rules('model_name', 'Model Name', 'trim|required|alpha_dash|callback_not_dublicate_model');
		}
		$this->form_validation->set_rules('fields[]', 'Editable Fields', 'required');
		$this->form_validation->set_rules('list[]', 'List Fields', 'required');


		if($this->form_validation->run())
		{			
			$table_name = $this->input->post('table_name');
			$controller_name = $this->input->post('alias');
			$u_controller_name = ucfirst($controller_name);
			$model_name = $this->input->post('model_name');
			$u_model_name = ucfirst($model_name);			
			$fields = $this->input->post('fields');
			$list = $this->input->post('list');
			$field_types = $this->input->post('types');
			$validations = $this->input->post('validations');
			$primary_key = $this->input->post('key');	

			$template_path = APPPATH.'views/admin/generate_module/templates/';

			
			
			/********************* GENERATE MODEL ************************/
			$model_content = file_get_contents($template_path . '_model.php');

			//generate model fields
			$editable_fields = '';
			foreach($fields as $field){
				$validation = element($field, $validations); 
				$field_label = ucwords(str_replace('_', ' ', $field));
				$editable_fields .= "\r\n\t\t'$field' => array('$field_label', '$validation'),";
			}
			$search_field = $fields[0];

			//replace variables
			$search = array('{{table_name}}', '{{primary_key}}', '{{u_model_name}}', '{{editable_fields}}', '{{search_field}}');
			$replace = array( $table_name, 	    $primary_key, 	$u_model_name, 	$editable_fields, $search_field);
			$model_content = str_replace($search, $replace, $model_content);
			
			
			if($only_model){
				$p['content'] = $model_content;
				$p['model_name'] = $model_name.".php";
				$data['popup'] = $this->load->view('admin/generate_module/model_popup', $p, TRUE);
				send_json($data); 
				die(); //exit from script
			}
			//save model to file
			file_put_contents(APPPATH.'models/'.ucfirst($model_name) .'.php', $model_content);


			/******************* GENERATE CONTROLLER ******************/			
			$controller_content = file_get_contents($template_path . '_controller.php');
			
			//replace variables
			$search = array('{{u_controller_name}}','{{controller_name}}','{{model_name}}');
			$replace = array( $u_controller_name,	$controller_name,		$model_name);
			$controller_content = str_replace($search, $replace, $controller_content);

			//save controller file
			file_put_contents(APPPATH.'controllers/'.conf('admin_path').ucfirst($controller_name).'.php', $controller_content);


			

			//create folder for views files
			$folder_path = APPPATH.'views/admin/'.$controller_name.'/';
			if(!file_exists($folder_path)){
				mkdir($folder_path);
			}

			/********************** GENERATE MAIN VIEWS *******************/
			$view_content = file_get_contents($template_path . '_view_general.php');
			$search = array('{{controller_name}}');
			$replace = array($controller_name);
			$view_content = str_replace($search, $replace, $view_content);

			//save view to file
			file_put_contents(APPPATH.'views/admin/' . $controller_name . '/' . $controller_name."_view.php", $view_content);
			
			/******************** GENERATE LIST VIEW ***********************/
			$vars = array('key'=>$primary_key, 'fields'=>$list, 'controller_name'=>$controller_name);
			$list_content = $this->load->view('admin/generate_module/templates/_view_list', $vars, TRUE);
			
			//save list view to file
			file_put_contents(APPPATH.'views/admin/' . $controller_name . '/' . $controller_name."_list.php", $list_content);

			/******************** GENERATE EDIT VIEW ***********************/
			$vars['fields'] = $fields;
			$vars['field_types'] = $field_types; 
			$edit_content = $this->load->view('admin/generate_module/templates/_view_edit', $vars, TRUE);

			//save model to file
			file_put_contents(APPPATH.'views/admin/' . $controller_name . '/' . $controller_name."_edit.php", $edit_content);
	

			$data['success'] = 'success created';

		}
		else{
			$data['error'] = validation_errors();
		}
		send_json($data);
	}



	function not_dublicate($value)
	{
		//get list of existing modules
		$this->load->helper('file');
		$files = get_filenames(APPPATH.'controllers/'.conf('admin_path'));
		
		foreach($files as $file){

			$file = str_replace(".php", "", $file);
			if($file==$value){
				$this->form_validation->set_message('not_dublicate', 'Dublicate controller name');
				return FALSE;
			}
		}

		//check there if is not exist folder with same name in views folder
		$folder_path = APPPATH.'views/admin/'.$value.'/';
		if(file_exists($folder_path)){
			$this->form_validation->set_message('not_dublicate', 'There is present folder with same name in views folder');
			return FALSE;
		}


		return TRUE;
	}

	function not_dublicate_model($value)
	{
		//get list of existing models
		$this->load->helper('file');
		$files = get_filenames(APPPATH.'models');

		foreach($files as $file){

			$file = str_replace(".php", "", $file);
			if($file==$value){
				$this->form_validation->set_message('not_dublicate_model', 'Dublicate model name');
				return FALSE;
			}
		}
		return TRUE;
	}


	function query()
	{				
		$tables = $this->_get_db_tables();
		$data['title'] = '['.$this->db->database . '] database';
		$data['tables'] = $tables;		
		$this->render("admin/generate_module/query_view", $data);
	}

	private function _get_db_tables(){
		$rows = $this->db->query('SHOW TABLES')->result();
		foreach($rows as $row){
			$name = current($row);
			$tables[$name] = $name; 
		}
		return $tables;
	}

	function execute_query()
	{
		$sql = trim($this->input->post('sql'));
		$data['sql'] = $sql;
		if($sql){

			try{				
				$queries = explode(";", $sql);	

				if(count($queries)>1)
				{
					$sqls = '';
					foreach($queries as $sql)
					{
						if(empty($sql)){
							continue;
						}
						$query = $this->db->query($sql);
						$affected_rows = $this->db->affected_rows();
						$sqls .= $this->db->last_query()." - <b>$affected_rows affected rows</b><br/>";
					}
					$data['sql'] = $sqls;
				}
				else{
					$query = $this->db->query($sql);
					$data['sql'] = $this->db->last_query();		
				}

				if(is_object($query)){
					$data['results'] = $query->result();			
				}
				$data['affected_rows'] = $this->db->affected_rows();
				$data['insert_id'] = $this->db->insert_id();
				
			}
			catch(Exception $e){
				$data['error'] = $e->getMessage();
			}			
		}
		
		$this->render("admin/generate_module/query_results_view", $data);

	}

	public function export_options($value='')
	{
		$tables = $this->_get_db_tables();	
		$data = array(
			'title' => 'Export database options',
			'tables' => $tables,
			'format' => array('txt' => 'No compression', 'zip' => 'Zip', 'gzip' => 'Gzip'),
			'add_insert' => array(FALSE => 'Only structure', TRUE => 'Structure & Data'),
		);
		$this->render("admin/generate_module/query_export_options", $data);
	}

	public function export()
	{
		$pref['tables'] = $this->input->post('tables');
		$pref['format'] = $this->input->post('format');
		$pref['add_insert'] = $this->input->post('add_insert');
		$pref['add_drop'] = $this->input->post('add_drop');

		return $this->export_database($pref);
	}

	public function export_database($params=array())
	{
		//export is available only for mysql driver
		if($this->db->dbdriver =='mysqli'){ 

			$conn = array(
				'hostname' => $this->db->hostname,
				'username' => $this->db->username,
				'password' => $this->db->password,
				'database' => $this->db->database,
				'dbdriver' => 'mysql',
			);
			$this->db = $this->load->database($conn, TRUE); 
		}
		if($this->db->dbdriver != 'mysql'){
			die('Sorry, the database export is available only for <b>mysql</b> Driver');
		}
	
		
		// Load the DB utility class
		$this->load->dbutil();


		$sqlname = $this->db->database;
		$extention = isset($params['format']) ? ($params['format']=='txt' ? 'sql' : $params['format']) : 'zip';
		$filename = $sqlname.date('d-m-Y H-i').".".$extention;

		$prefs = array(
				'tables'      => array(),  			// Array of tables to backup.
				'ignore'      => array(),           // List of tables to omit from the backup
				'format'      => 'zip',             // gzip, zip, txt
				'filename' 	  => $sqlname,
				'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
				'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
				'newline'     => "\n"               // Newline character used in backup file
			  );
		if($params){
			$prefs = array_merge($prefs, $params);
		}

		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup($prefs); 
		
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download($filename, $backup);
	}

}