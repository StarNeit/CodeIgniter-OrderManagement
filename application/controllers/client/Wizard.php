<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->protect_user();

		$this->load->model('clients_m');
		$this->load->model('recipients_m');

		//$this->user = $this->clients_m->get_client($this->user_id);
		
	}

	/**
	 * step1 About Recipient
	 */
	public function index($recipient_id='')
	{
		if($recipient_id)
		{
			$item = $this->recipients_m->get_recipient($recipient_id);
			if($item->user_id != $this->user_id){
				return show_info_page('You do not have permission to access this page');
			}
			
			//store recipient id in session
			$this->session->set_userdata('recipient_id', $recipient_id);

			if($item->relationship == 'me'){
				return $this->step1b();
			}
		}
		else{
			$this->session->set_userdata('recipient_id', '');
		}
		return $this->step1a();
	}

	/**
	 * Step1 recipient Loved One
	 */
	function step1a()
	{
		$recipient_id = $this->session->userdata('recipient_id');
		$item = $this->recipients_m->get_recipient($recipient_id);

		$data = array(
			'title' => 'About Recipient',
			'item' =>$item,
			'who' => 'parent',
		);

		$this->render('client/step1b_view', $data);	
	}

	/**
	 * Step1 recipeint Current User
	 */
	function step1b()
	{

		$item = $this->recipients_m->get_recipient_me($this->user_id);
		$data = array(
			'title' => 'About Recipient',		
			'item' => $item,
			'who' => 'me',		
		);

		$this->render('client/step1b_view', $data);	
	}

	function save_step1()
	{
		$validate = array(
			'user_id',
			'relationship',
			'first_name',
			'last_name',
			'dob',
			'gender',
			'nric',
			'race',
			'weight',
			'height',
			'medical_condition',
//			'created_by',
			'created_at',
			'language[]',
		);

		//prepopulate some fields
		$_POST['user_id'] = $this->user_id;
		$_POST['created_by'] = 'Client';
		$_POST['created_at'] = date(DATE);
                
                if($_POST['dob']!='')
                    $_POST['dob'] = dbdate($_POST['dob']);

		if($this->input->post('who') == 'me')
		{
			$user = $this->clients_m->get_client($this->user_id);
			$_POST['relationship'] = 'me';
			$_POST['salutation'] = $user->salutation;
			$_POST['first_name'] = $user->first_name;
			$_POST['last_name'] = $user->last_name;
		}
		else{
			$validate[] = 'diagnosis';
		}

		$id = $this->input->post('id');
                
                if($_POST['dob']!='')
                    $_POST['dob'] = dbdate($_POST['dob']);
                
		$recipient_id = $this->recipients_m->save($id, $validate);

		$data = $this->recipients_m->get_results();
		if($recipient_id)
		{
			//save language
			$this->recipients_m->save_languages($this->input->post('language'), $recipient_id);

			//store recipient id in session
			$this->session->set_userdata('recipient_id', $recipient_id);

			set_success('Changes saved');
			$data['redirect'] = client_url("wizard/step2");
		}
		send_json($data);
	}

	function step2()
	{
            $this->session->set_userdata('case_id','');
		$recipient_id = $this->session->userdata('recipient_id');
		if(!$recipient_id){
			redirect(client_url("wizard/step1a"));
		}

		$this->load->model('cases_m');
                
                if($recipient_id!=''){
                    $record = $this->cases_m->get_record(array('recipient_id'=>$recipient_id),false);
                    
                    if($record!==false)
                        $this->session->set_userdata('case_id',$record->id);
                }
                
		$case_id = $this->session->userdata('case_id');
		$case = $this->cases_m->get_case($case_id);

		if(!$case->id){
			$case->recipient_id = $recipient_id;
		}

		$data = array(
			'title' => 'Care Needs',
			'case' =>$case,		
		);

		$this->render('client/step2_view', $data);	
	}

	public function save_step2()
	{
		$this->load->model('cases_m');		

		$validate = array(
			'recipient_id',
			'postal_code',
		    'unit',
		    'block',
		    'street',
		    'gender_pref',
		    'full_care',
		    'skill[]',	      
		    'special_instructions',	
		    'language[]',
		    'created_by', 
		    'created_at',	    
		);

		//prepopulate some fields		
		$_POST['created_by'] = 'Client';
		$_POST['created_at'] = date(DATE);

		$id = $this->input->post('id');

                if($id)
                    unset($validate[7]);
                
		$case_id = $this->cases_m->save($id, $validate);
		$data = $this->cases_m->get_results();
		if($case_id)
		{
			//save location			
			$location = array(
				'block' => $this->input->post('block'),
				'unit' => $this->input->post('unit'),
				'street' => $this->input->post('street'),
				'postal_code' => $this->input->post('postal_code'),
				'case_id' => $case_id,
			);
			$this->cases_m->save_location($location, $this->input->post('location_id'));

                        $case = $this->cases_m->get_record($case_id);

                        //save location at recipient location
                        unset($location['case_id']);
                        $location['recipient_id'] = $case->recipient_id;
       
                        $loc = $this->recipients_m->get_recipient_location($case->recipient_id);
                        
                        if($loc!==false)
                            $this->recipients_m->save_location($location, $loc->id);
                        else
                            $this->recipients_m->save_location($location,'');
                        
			//save language
			$this->cases_m->save_languages($this->input->post('language'), $case_id);

                        //save language at recipient_language
			$this->recipients_m->save_languages($this->input->post('language'), $case->recipient_id);
                        
                        //update only when create new recipient
                        if(!$id)
                        {
                            //save skills 
                            $this->cases_m->save_skills($this->input->post('skill'), $case_id);
                        }

			//store case id in session
			$this->session->set_userdata('case_id', $case_id);

			set_success('Changes saved');
			$data['redirect'] = client_url("wizard/step3");
		}
		send_json($data);
	}

	function step3()
	{
		$case_id = $this->session->userdata('case_id');
		if(!$case_id){
			redirect(client_url("wizard/step2"));
		}

		$this->load->model('cases_m');
		$case = $this->cases_m->get_case($case_id);

		$data = array(
			'title' => 'First Care',
			'case' => $case,
			);

		$this->render('client/step3_view', $data);	
	}

	public function save_step3()
	{
		$this->load->model('cases_m');		

		$validate = array(
			'service_from'
		);		

		$id = $this->input->post('id');

		$case_id = $this->cases_m->save($id, $validate);
		$data = $this->cases_m->get_results();
		if($case_id)
		{
						
			$data['callback'] = '$("#success-modal").modal()';
		}
		send_json($data);
	}

	function schedule_visit($recipient_id)
	{
		$this->load->model('cases_m');
		//$recipient = $this->recipients_m->get_recipient($recipient_id);
		$case_id = $this->cases_m->recipient_case_id($recipient_id);
		$case = $this->cases_m->get_case($case_id, true);
		
		$data = array(
			'title' => 'Schedule Visit',
			'case' => $case,
			'show_datepicker_script'=>true
		);


		$this->render('client/schedule_visit_view', $data);	
	}

	public function save_visit()
	{
//            echo "<pre>";
//            var_dump($_POST);
//            exit();
		$this->load->model('cases_m');
		$this->load->model('visits_m');
		
		$validate = array(
			'case_id',
			'postal_code',
			'unit',
			'block',
			'street',					
			'language[]',
			'skill[]',
			'instructions',
			'repeat',
			'full_day', 
		);		

		
		if($this->input->post('full_day'))
		{
			//24hrs care
			$validate = array_merge($validate, array(
				'fullday_from[]',
				'fullday_to[]',				
			));
		}
		else
		{	//user selected to repeat schedule	
			if($this->input->post('repeat')){
				$validate = array_merge($validate, array(
					'repeat_start[]',
					'repeat_end[]',
					'repeat_days[]',
					'repeat_from',
					'repeat_to',			
				));
			}
			else
			{
				//one day visit
				$validate = array_merge($validate, array(
					'one_day_date',
					'one_day_start',
					'one_day_end',		
				));
			}
		}


		$fields = $this->visits_m->get_from_post($validate);	
		$data = $this->visits_m->get_results();
		if($fields)
		{	
			$count_visits = 1;
			$visit_ids = array();
			if($this->input->post('full_day'))
			{
				//24hrs care intervals, save each visit 
				$fullday_from = $this->input->post('fullday_from');
				$fullday_to = $this->input->post('fullday_to');

				foreach($fullday_from as $index =>$visit_from)
				{					
					$visit_to = $fullday_to[$index];

					$fields['visit_from'] = dbdate($visit_from);
					$fields['visit_to'] = dbdate($visit_to);

					$visit_id = $this->visits_m->insert_record($fields);
					$visit_ids[] = $visit_id;
				}
				
				$data['success'] = "Your 24hrs Live-in Care, has been scheduled with success";
			}
			else
			{
				if($this->input->post('repeat'))
				{										
					//insert multiple visits based on selected schedule	
					$days = $this->input->post('repeat_days'); //array of elements for each group
					$start = $this->input->post('repeat_start'); //array
					$end = $this->input->post('repeat_end'); //array			

					$from = $this->input->post('repeat_from'); //date
					$to = $this->input->post('repeat_to');	//date

					$count_visits = 0;

					//loop every day from interval $from -> $to
					for($time = strtotime($from); $time <= strtotime($to); $time+=24*3600)
					{
						$loop_day = date('N', $time);

						//loop every group of schedule
						$i = 0;
						foreach($days as $weekdays)
						{
							//loop every selected week day from group
							foreach($weekdays as $weekday)
							{								
								if($weekday == $loop_day)
								{									
									$fields['visit_from'] = date('Y-m-d', $time) . ' ' . $start[$i];
									$fields['visit_to'] = date('Y-m-d', $time) . ' ' . $end[$i];	

									//insert visit for matched day
									$visit_id = $this->visits_m->insert_record($fields);
									$visit_ids[] = $visit_id;
									$count_visits++;
								}
							}
							$i++;
						}						
					}
					
					if($count_visits)
					{
						$data['success'] = "$count_visits visits have been scheduled in selected period";			
					}
					else{
						$data['error'] = "No one visit can be scheduled in this period, please review schedule options";
					}
				}
				else
				{
					//save one visit
					$visit_id = $this->visits_m->insert_record($fields);
					$visit_ids[] = $visit_id;
					$data['success'] = "Your visit has been scheduled with sucess";
				}
			}

			if($count_visits)
			{
				//save service skills
				$skills = $this->input->post('skill');
				$case_id = $this->input->post('case_id');
				$this->cases_m->save_skills($skills, $case_id);

				//get case_skill join with case_checklist to get checklist item
				$case_skill = $this->cases_m->get_case_skill($case_id);
				
				//insert visit_checklist
				$this->cases_m->insert_visit_checklist($visit_ids, $case_skill);
                                
                                //insert visit_skill
				$this->cases_m->insert_visit_skill($visit_ids, $skills);


				$data['redirect'] = client_url("wizard/payment/$case_id");
				
			}


		}
		
		send_json($data);
	}

	function payment($case_id='')
	{
		$data = array(
			'title' => 'Payment Matters',
			'case_id' => $case_id,
		);

		$this->render('client/wizard_payment_view', $data);	
	}

	function upload_picture($case_id)
	{
            $this->load->model('cases_m');
                $case = $this->cases_m->get_record($case_id);
                
		$recipient = $this->recipients_m->get_recipient($case->recipient_id);
		$data = array(
			'title' => 'Upload Picture',
			'case_id' => $case_id,
			'recipient' => $recipient,
		);

		$this->render('client/upload_picture_view', $data);	
	}

	public function save_upload()
	{
//            var_dump($_FILES);
//            var_dump($_POST);
//            exit();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('photo', 'Photo', 'trim');
		$this->form_validation->set_rules('allow', 'Allow carepro to take picture of care recipient', 'trim');
		$this->form_validation->set_rules('case_id', 'Case Id', 'trim|required');
		if ($this->form_validation->run() == TRUE) 
		{
			$photo = $this->input->post('photo');
			$photo_thumb = $this->input->post('photo_thumb');
			if($photo)
			{
				$case_id = $this->input->post('case_id');

				//add visit_photos 
				$this->load->model('visits_m');
				$visit_ids = $this->visits_m->case_visit_ids($case_id);			

				$records = array();
				foreach($visit_ids as $visit_id)
				{
					$records[] = array(
						'visit_id' => $visit_id,
						'photo_thumb' => $photo_thumb,
						'photo' => $photo,
					);
				}
				if($records)
				{
					$this->visits_m->update_visits_photo($records, $visit_ids);
				}
			}
			

			$data['redirect'] = client_url("visits");
			$data['success'] = "Changes saved";
		} 
		else 
		{
			$data['error'] = validation_errors();
		}
		send_json($data);
	}


}

/* End of file wizard.php */
/* Location: ./application/controllers/client/wizard.php */