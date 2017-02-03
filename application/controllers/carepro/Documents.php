<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documents extends Care_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->protect_user();
		$this->load->model('carepro_m');
	}

	public function index()
	{
		$this->load->model('carepro_m');
		$user = $this->carepro_m->get_user($this->user_id);
		
		$data = array(
			'title' => 'My Documents',
			'user' => $user,
		);
		$this->render('carepro/documents_view', $data);	
	}
	public function update()
	{
		$user_id = $this->user_id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('CRP[]', 'CPR/BCLS Certification/Card', 'required');
		$this->form_validation->set_rules('TB[]', 'TB Screening Report', 'required');
		$this->form_validation->set_rules('Certificate[]', 'Caregiver Certificate', 'required');
		$this->form_validation->set_rules('IC[]', 'Identification Card', 'required');
		
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
			$data['redirect'] = care_url("documents");
		} 
		else {
			$data['error'] = validation_errors();
		}
		send_json($data);    	
	}

}

/* End of file Documents.php */
/* Location: ./application/controllers/carepro/Documents.php */