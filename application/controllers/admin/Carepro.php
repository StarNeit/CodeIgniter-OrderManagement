<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carepro extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('carepro_m');
		$this->load->model('users_m');
	}

	
	/**
	 * Approved carepro
	 */
	public function index($status = 'placed')
	{	

		$q = $this->input->get('q')!='' ? $this->input->get('q'): $this->uri->segment(7);
		$s = $this->input->get('status');
		$orderby = $this->uri->segment(5);
		$order = $this->uri->segment(6);
		if($orderby==''){
			$orderby ='first_name';
			$order ='asc';
		}
		$s = $s ? $s : $status;
		$url = admin_url("carepro/index/".$status."/");

		if($q=='')                        
            $q = 'Nil';

		$filter  = array('status' => $s, 'q' => $q,'orderby'=>$orderby,'order'=>$order);
		$limit = LIMIT;

		$count_approved = $this->carepro_m->get_count(array('status' => 'placed', 'q' => $q,'orderby'=>$orderby,'order'=>$order));
                
                $extrawhere = array('status' => 'applicant');
                if($this->uri->segment(4)=='applicant')
                 {
                    $extrawhere = array('status' => $s, 'q' => $q,'orderby'=>$orderby,'order'=>$order);
                    
                }
                $count_applicants = $this->carepro_m->get_count($extrawhere);

        //$count_applicants = $this->carepro_m->get_count( array('status' => 'applicant', 'q' => $q,'orderby'=>$orderby,'order'=>$order));
                
		$count_rejected = $this->carepro_m->get_count(array('status' => 'rejected', 'q' => $q,'orderby'=>$orderby,'order'=>$order));

                
                $this->load->library('pagination');

                if($status=='placed')
                {
                    $config['base_url'] = admin_url("carepro/index/".$status."/".$orderby."/".$order."/".$q."/");
                    $config['total_rows'] = $count_approved;
                }
                else if($status=='applicant')
                {
                    $config['base_url'] = admin_url("carepro/index/applicant/".$status."/".$orderby."/".$order."/".$q."/");
                    $config['total_rows'] = $count_applicants;
                }
                else if($status=='rejected')
                {
                    $config['base_url'] = admin_url("carepro/index/".$status."/".$orderby."/".$order."/".$q."/");
                    $config['total_rows'] = $count_rejected;
                }
                
//                echo $config['total_rows'];
                // pagination
        
		$config['uri_segment'] = 8;
		$config['per_page'] = $limit;
		$this->load->library('pagination');
		$this->pagination->initialize($config);
                 
        $offset = $this->uri->segment(8)!='' ? $this->uri->segment(8): 0;
        $items = $this->carepro_m->get_items($filter,$offset,$limit);

		$data = array(
			'items' => $items,
			'tab' => $status,
			'count_approved' => $count_approved,
			'count_applicants' => $count_applicants,
			'count_rejected' => $count_rejected,
			'url' =>$url,
			'orderby' => $orderby,
			'order'	=> $order,
			'keyword' => $q,
			
		);
		$this->render('admin/carepro/carepro_list', $data);
	}

	function activate(){
		$id = $this->input->post('id');		
		echo $this->users_m->activate($id, 'is_active');
	}
	
	

	function add()
	{
		return $this->details(0);
	}

	function details($user_id = '')
	{
		if(!$user_id){
			$user = $this->carepro_m->get_empty_record();
			$user->photo = '';
			$user->salutation = '';
			$user->languages = array();
			$user->user_id = '';

			$title = "Add Carepro User";
		}
		else{
			$user = $this->carepro_m->get_user($user_id);
			$title = $user->first_name . ' ' . $user->last_name;
		}

		$data = array(
		 	'user' =>$user,
		 	'title' => $title,
		);

		$this->render('admin/carepro/carepro_details', $data);
	}

	function save_details()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('specify', 'Specify Detail', 'trim');
			
		//prepopulate missing fields
		if ($this->input->post('medical_conditions') == 'Yes') {
			$this->form_validation->set_rules('specify', 'Specify Detail', 'trim|required');
		}
		$_POST['medical_conditions'] = element('medical_conditions', $_POST) . $_POST['specify'];
		
		if($this->form_validation->run() == true) 
		{
		//fields to validate 
		$validate = array(
			//'user_id',
			'nationality',
			'national_id',
			'dob',			
			'gender',
			'weight',
			'height',
			'religion',
			'race',
			'medical_conditions',
			'smart_phone',	
			'email',			
			'first_name',
			'last_name',
			'contact_home',
			'contact_mobile',		
			'language[]',			
			'street',
			'block',
			'unit',
			'postal_code',
		);
                if($_POST['dob']!='')
                            $_POST['dob'] = dbdate($_POST['dob']);

		$fields = $this->carepro_m->get_from_post($validate);		
		$data = $this->carepro_m->get_results();

		if($fields)
		{

			$user_id = $this->input->post('user_id');

			//save user data
			$fields_to_update = array(
				'email',			
				'first_name',
				'last_name',
				'contact_home',
				'contact_mobile',
				'user_type',	
			);
			
			$id = $this->users_m->save($user_id, $fields_to_update);

			if($user_id)
			{
				//update carepro fields
				$this->carepro_m->update_record($fields, array('user_id' => $user_id));

				//save address
				$this->load->model('user_location_m');
				$this->user_location_m->save(array('user_id' => $user_id));

				//save languages
				$this->users_m->save_languages($this->input->post('language'), $user_id);
			}
			else
			{
				//insert carepro fields
				$fields['user_id'] = $id;
				$fields['registered_at'] = date(DATE);
				$this->carepro_m->insert_record($fields);
				

				//save address
				$_POST['user_id'] = $id;
				$this->load->model('user_location_m');
				$this->user_location_m->save();

				//save languages
				$user_id = $id;
				$this->users_m->save_languages($this->input->post('language'), $user_id);
			}				

			$data['redirect'] = admin_url("carepro/details/$user_id");		
			set_success('Changes saved!');	
			
			}
		}
		$data['error'] = validation_errors();
		$data['errors'] = $this->form_validation->get_errors();
		send_json($data);
	}

	public function skills($user_id='')
	{
		$user = $this->carepro_m->get_user($user_id);

		$data = array(
		 	'user' =>$user,
		);

		$this->render('admin/carepro/carepro_skills', $data);
	}

	public function save_skills()
	{
		$this->load->model('carepro_application_m');
		$user_id = $this->input->post('user_id');

		//fields to validate
		$validate = array(
			'user_id',
			'experience_summary',
			'experience_years',
			'training[]',			
			'experience[]',
		);
		$app_id = $this->carepro_application_m->save(array('user_id' => $user_id), $validate);
		
		$data = $this->carepro_application_m->get_results();

		if($app_id)
		{
			if($this->db->affected_rows()==0){
				$this->carepro_application_m->save(NULL, $validate);
			}

			//save trainig
			$this->carepro_application_m->save_trainings($this->input->post('training'), $user_id);		

			//save experience
			$this->carepro_application_m->save_eperience($this->input->post('experience'), $user_id);

			//save carepro skills
			$this->carepro_m->save_skills($this->input->post('skill'), $user_id);	

			set_success("Changes saved!");
			$data['redirect'] = admin_url("carepro/skills/$user_id");
		}				
		send_json($data);
	}

	public function background($user_id = '')
	{

		$user = $this->carepro_m->get_user($user_id);

		$data = array(
		 	'user' =>$user,
		);

		$this->render('admin/carepro/carepro_background', $data);
	}

	public function save_background()
	{
		
		$this->load->model('carepro_application_m');
		$user_id = $this->input->post('user_id');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('criminal_detail', 'Criminal Detail', 'trim');
		if ($this->input->post('criminal_record')== 1) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('criminal_detail', 'Criminal Detail', 'trim|required');
		}
		if($this->form_validation->run() == true) 
		{
			
			$validate = array(
			'user_id',
			'criminal_record',
			'criminal_detail',			
			'ref_name',
			'ref_relationship',
			'ref_contact',
			'ref_email',
			'sec_ref_name',
			'sec_ref_relationship',
			'sec_ref_contact',
			'sec_ref_email',			
		);
		$app_id = $this->carepro_application_m->save(array('user_id' => $user_id), $validate);
		$data = $this->carepro_application_m->get_results();
			if($app_id)
			{
				set_success("Changes saved!");
				$data['redirect'] = admin_url("carepro/background/$user_id");
			}
		}

		//fields to validate/save
				
		$data['error'] = validation_errors();
		$data['errors'] = $this->form_validation->get_errors();
		send_json($data);
	}

	public function documents($user_id = '')
	{
		$user = $this->carepro_m->get_user($user_id);                
               
		$data = array(
		 	'user' =>$user,
		);
                

		$this->render('admin/carepro/carepro_docs', $data);
	}

	public function upload_doc($type)
	{
		$user_id = $this->input->post('user_id');
		
		$folder =  "uploads/$user_id/";

		$this->load->helper('upload');
		$options = array(
			'accept_file_types' => '/\.(gif|jpe?g|png|doc|docx|jpg|pdf)$/i',
			'upload_dir' => $folder,
			'upload_url' =>  base_url(). $folder,			
		);
		$result = file_upload($options);
	//	preg($result);die();

		
		$file = $result['files'][0];
		if(!isset($file->error))
		{			
			$url = $file->url;

			//upload to s3 storage
			$this->load->library('s3');
			$url = $this->s3->uploadData($folder.$file->name,'carepro/'.$user_id.'/documents/'.$file->name);

			$doc = new StdClass;
			$doc->name = $file->name;
			$doc->document_url = $url;
			$doc->valid_till = '';
			$doc->completion_on = '';

			$data = array(
				'type' => $type,
				'documents' => array($doc)
			);
				
			$result['html'] = $this->load->view('admin/carepro/documents_list', $data, true);			
		}	
		else{
			$result['error'] = $file->error;
		}	
		
		
			
		send_json($result);
	}

	public function save_documents()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('CRP[]', 'CPR/BCLS Certification/Card', 'required');
		$this->form_validation->set_rules('TB[]', 'TB Screening Report', 'required');
		$this->form_validation->set_rules('Certificate[]', 'Caregiver Certificate', 'required');
		$this->form_validation->set_rules('IC[]', 'Identification Card', 'required');
		$this->form_validation->set_rules('user_id', 'UserID', 'required');

		if($this->form_validation->run() == TRUE) 
		{
			$user_id = $this->input->post('user_id');
			//prepare records for inseration
			$records = array();
			foreach(documents_array() as $type)
			{
				$docs = $this->input->post($type);
				if(!$docs){
					continue;
				}
				$urls = element('document_url', $docs, array());
				$names = element('name', $docs, array());
				$valid_till = element('valid_till', $docs, array());
				$completion_on = element('completion_on', $docs, array());

				foreach($urls as $index => $document_url)
				{
					$records[] = array(
						'user_id' => $user_id,
						'type' => $type,
						'document_url' => $document_url,
						'name' => element($index, $names), 
						'valid_till' => dbdate(element($index, $valid_till)),
						'completion_on' => dbdate(element($index, $completion_on)),
					);
				}
			}

			$this->load->model('carepro_application_m');
			$this->carepro_application_m->save_documents($records, $user_id);

			$data['success'] = 'Changes saved';
		} 
		else {
			$data['error'] = validation_errors();
		};

		send_json($data);
	}

	public function payment($user_id = '')
	{
		$user = $this->carepro_m->get_user($user_id);

		$data = array(
		 	'user' =>$user,
		);

		$this->render('admin/carepro/carepro_payment', $data);
	}

	public function save_payment()
	{
		$data['error'] = "TODO";
		send_json($data);
	}


	
 
    public function account($user_id='')
	{   
        $user = $this->carepro_m->get_user($user_id);

        $data = array(
			'user' =>$user,
        );

        $this->render('admin/carepro/carepro_applications', $data);
	}

	public function save_application()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_id', 'UserID', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');
		$this->form_validation->set_rules('application_status', 'Application Status', 'trim|required');

		if($this->form_validation->run() == TRUE) 
		{
			$user_id = $this->input->post('user_id');
			
			//change password if exists
			if($password = $this->input->post('password'))
			{
				$this->users_m->set_password($password, $user_id);
			}

			//update email 
			$email = $this->input->post('email');
                        
			$this->users_m->update_record(array('email' => $email), $user_id);

			//update application status
			$application_status = $this->input->post('application_status');
			$this->carepro_m->update_record(array('application_status' => $application_status,'summary'=>trim($_POST['summary'])), array('user_id' => $user_id));

			set_success("Changes saved");
			$data['redirect'] = admin_url("carepro/account/$user_id");
		}
		else {
			$data['error'] = validation_errors();
		}
		send_json($data);

	}

	public function schedule($user_id = '')
	{

		$user = $this->carepro_m->get_user($user_id);

		$data = array(
		 	'user' =>$user,
		);

		$this->render('admin/carepro/carepro_schedule', $data);
	}

	public function schedulesjon($user_id='')
	{
		$this->load->model('availability_m');
		$start =  $this->input->get('start');
		$end =  $this->input->get('end');
		$events = $this->availability_m->get_schedule($start, $end, $user_id);
		echo json_encode($events, JSON_NUMERIC_CHECK);
		exit;
	}


	public function save_schedule()
	{
		$this->load->model('availability_m');

		$id = $this->input->post('id');		
		$_POST['all_day'] = $this->input->post('allDay')=='true' ? 1 :0;
	
		$id = $this->availability_m->save($id);

		$data['id'] = $id;
		echo json_encode($data, JSON_NUMERIC_CHECK);
	}

	public function delete_schedule()
	{
		$this->load->model('availability_m');

		$id = $this->input->post('id');
		$this->availability_m->delete_record($id);
	}


	
}