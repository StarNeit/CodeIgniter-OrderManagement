<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard extends Care_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('carepro_m');
		$this->load->model('users_m');
	}
	
	/**
	 * Step1
	 */
	public function index()
	{
		return $this->step1();
	}

	public function step1()
	{
		$data = array(
			'title' => 'Personal Particulars',
		);
	
		$this->render('carepro/step1_view', $data);		
	}

	public function save_step1()
	{
		//prepopulate missing fields
		$_POST['user_type'] = 'CarePro';
		$_POST['medical_conditions'] = element('medical_conditions', $_POST) . $_POST['specify'];
		$_POST['registered_at'] = date(DATE);

		//validate form and get carepro fields data
                if($_POST['dob']!='')
                    $_POST['dob'] = dbdate($_POST['dob']);
                
                $_POST['skill'][0] = "-";
                $_POST['summary'] = "";
		$fields = $this->carepro_m->get_from_post();

                $this->session->set_userdata('tmp_pass', $_POST['password']);
		$data = $this->carepro_m->get_results();
		if($fields)
		{
                        if($_POST['email']!='')
                        {
                            $usr = $this->users_m->get_record(array('email'=>$_POST['email']),false);
                            if($usr!==false){
                                $data['error'] = 'Email already existed.';
                                send_json($data);
                            }
                        }
			//create user Care Pro account
			$user_id = $this->users_m->create_account_from_post();
                        
//                        $data['error'] = validation_errors();
			if($user_id) //user created sucessfully
			{
				$_POST['user_id'] = $fields['user_id'] =  $user_id;

				//save carepro fields
				$id = $this->carepro_m->insert_record($fields);
			

				if(!$id){
					$this->carepro_m->get_results();
					send_json($data);
				}

				//save address
				$this->load->model('user_location_m');
				$this->user_location_m->save();

				//save languages
				$this->users_m->save_languages($this->input->post('language'), $user_id);

				$data['redirect'] = care_url('wizard/step2');

				$this->session->set_userdata('user_id', $user_id);

				
			}
			else //error with user account
			{
				$data = $this->users_m->get_results();
			}
		}
		send_json($data);
	}

	public function step2()
	{	
		$user_id = $this->session->userdata('user_id');
		if(!$user_id){
			redirect(care_url('wizard/step1'));
		}
		
		$this->load->model('carepro_m');
		$user = $this->carepro_m->get_user($user_id);
		
		$skills = $this->common->services_and_skills();

		$data = array(
			'title' => 'Skills & Qualifications',
			'user' => $user,
			'skills' => $skills, 

		);
	
		$this->render('carepro/step2_view', $data);		
	}

	public function save_step2()
	{
		$this->load->model('carepro_application_m');
		
		$user_id = $this->session->userdata('user_id');
		$_POST['user_id'] = $user_id;
		
		//fields to validate
		$validate = array(
			'user_id',
			'experience_summary',
			'experience_years',
			'training[]',
			'certification[]',
			'experience[]',
			'skill[]',
		);

		$app = $this->carepro_application_m->get_record(array('user_id' => $user_id), FALSE);
		$app_id = $app ? $app->id : NULL;

		$app_id = $this->carepro_application_m->save($app_id, $validate);
		$data = $this->carepro_application_m->get_results();
		if($app_id)
		{
			//save trainig
			$this->carepro_application_m->save_trainings($this->input->post('training'), $user_id);

			//save cerifications
			$certificates = $this->input->post('certification');
			$cert_from = $this->input->post('cert_from');
			$cert_till = $this->input->post('cert_till');
			$this->carepro_application_m->save_certifications($certificates, $cert_from, $cert_till, $user_id);

			//save experience
			$this->carepro_application_m->save_eperience($this->input->post('experience'), $user_id);

			//save carepro skills
			$this->carepro_m->save_skills($this->input->post('skill'), $user_id);	

			$data['redirect'] = care_url("wizard/step3");
		}		
		
		send_json($data);
	}
	
	public function step3()
	{
		$user_id = $this->session->userdata('user_id');
		if(!$user_id){
			redirect(care_url('wizard/step1'));
		}
		
		$this->load->model('carepro_m');
		$user = $this->carepro_m->get_user($user_id);

		$data = array(
			'title' => 'Background Check',
			'user' => $user,
		);
	
		$this->render('carepro/step3_view', $data);		
	}

	public function save_step3()
	{
		$this->load->model('carepro_application_m');
		
		$user_id = $this->session->userdata('user_id');
		$_POST['user_id'] = $user_id;

		$app = $this->carepro_application_m->get_record(array('user_id' => $user_id), FALSE);

		
		//fields to validate
		$validate = array(
			'user_id',
			'criminal_record',
			'criminal_detail',
			'full_name',
			'ref_name',
			'ref_relationship',
			'ref_contact',
			'ref_email',
			'sec_ref_name',
			'sec_ref_relationship',
			'sec_ref_contact',
			'sec_ref_email',
			'confirmation',			
		);
		$app_id = $this->carepro_application_m->save($app->id, $validate);
		$data = $this->carepro_application_m->get_results();
		if($app_id)
		{

			$data['redirect'] = care_url("wizard/step4");
		}		
		
		send_json($data);
	}

	public function step4()
	{
		$user_id = $this->session->userdata('user_id');
		if(!$user_id){
			redirect(care_url('wizard/step1'));
		}
		
		$this->load->model('carepro_m');
		$user = $this->carepro_m->get_user($user_id);

		$data = array(
			'title' => 'Submit Documents',
			'user' => $user,
		);
	
		$this->render('carepro/step4_view', $data);		
	}

	public function save_step4()
	{		
		$user_id = $this->session->userdata('user_id');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('CRP[]', 'CPR/BCLS Certification/Card', '');
		$this->form_validation->set_rules('TB[]', 'TB Screening Report', '');
		$this->form_validation->set_rules('Certificate[]', 'Caregiver Certificate', '');
		$this->form_validation->set_rules('IC[]', 'Identification Card', '');
		
		if($this->form_validation->run() == TRUE) 
		{	
			
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
			$data['redirect'] = care_url("wizard/step5");
		} 
		else {
                        $data['redirect'] = care_url("wizard/step5");
//			$data['error'] = validation_errors();
		}
		send_json($data);    		
    	
	}

	public function step5()
	{
		$data = array(
			'title' => 'Information Declaration',
		);
	
		$this->render('carepro/step5_view', $data);		
	}

	public function save_step5()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sign', 'Sign Checkbox', 'trim|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
                
                
		if ($this->form_validation->run() == TRUE) 
		{
                    $user_id = $this->session->userdata('user_id');
                    $password = $this->session->userdata('tmp_pass');
                    $this->load->model('users_m');
                    $user = $this->users_m->get_record($user_id);

                    $emailData = array(
                        'name'=>$user->first_name.' '.$user->last_name,
                        'email'=>$user->email,
                        'password'=>$password,
                    );

                    //send email
                    $e = array(
                            'subject' => 'Homage : CarePro Signup',
                            'email'=>$emailData['email'],
                            'user'=>$emailData
                    );

                    $this->util->send_tpl_email('email/carepro_signup_email', $e);
                
			$data['callback'] = "$('#myModal').modal('show')";
		} else 
		{
			$data['error'] = validation_errors();
		}
		send_json($data);
	}

}

/* End of file wizard.php */
/* Location: ./application/controllers/carepro/wizard.php */