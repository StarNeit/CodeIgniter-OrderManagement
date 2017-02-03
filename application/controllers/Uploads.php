<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploads extends CI_Controller {

	public function upload_avatar()
	{
		$user_id = $this->input->post('user_id');

		$this->load->helper('upload');
		$options = array(
			'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
			'upload_dir' => AVATARS,
			'upload_url' =>  base_url() . AVATARS,			
			'image_versions' => array(
				'big' => array(
					'crop' => true,
					'max_width' => 450,	
					'max_height' =>323,				
					'jpeg_quality' => 80
				),				
				'' => array(
					'crop' => true,
					'max_width' => 140,	
					'max_height' =>140,				
					'jpeg_quality' => 80
				),	
			),
		);
		$result = file_upload($options);
		
		$file = $result['files'][0];
		
		
		if(!isset($file->error))
		{							
			//update database 
			$this->load->model('users_m');
			$this->users_m->update_record(array('photo' => $file->name), $user_id);
			$this->load->library('s3');
			$file->url = $this->s3->uploadData(AVATARS.$file->name,'carepro/'.$user_id.'/avatar/'.$file->name);
			$file->big_url = $this->s3->uploadData(AVATARS. 'big/'. $file->name,'carepro/'.$user_id.'/avatar/big/'. $file->name);
						
		}		
		send_json($file);
	}

	public function upload_recipient_photo()
	{
		
		$recipient_id = $this->input->post('recipient_id');
		$user_id = $this->input->post('user_id');
		$this->load->helper('upload');
		$options = array(
			'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
			'upload_dir' => PHOTOS,
			'upload_url' =>  base_url() . PHOTOS,			
			'image_versions' => array(
				'big' => array(
					'crop' => true,
					'max_width' => 450,	
					'max_height' =>323,				
					'jpeg_quality' => 80
				),
				'' => array(
					'crop' => true,
					'max_width' => 140,	
					'max_height' =>140,				
					'jpeg_quality' => 80
				),
									
			),
		);
		$result = file_upload($options);
		
		$file = $result['files'][0];
		
		
		if(!isset($file->error))
		{	
			if ($recipient_id != 0) {
			//update database 
			$this->load->model('recipients_m');
			$this->recipients_m->update_record(array('photo' => $file->name), $recipient_id);	
			}						
			$this->load->library('s3');
			$file->url = $this->s3->uploadData(PHOTOS.$file->name,'recipient/'.$recipient_id.'/avatar/'.$file->name);
			$file->big_url = $this->s3->uploadData(PHOTOS. 'big/'.$file->name, 'recipient/'.$recipient_id.'/avatar/big/'. $file->name);
                        $file->filename = $file->name;
						
		}		
		send_json($file);

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
				
			$result['html'] = $this->load->view('carepro/doc_list', $data, true);			
		}	
		else{
			$result['error'] = $file->error;
		}		
			
		send_json($result);
	}

	public function visit_photo()
	{
		$case_id= $this->input->post('case_id');
		$this->load->helper('upload');
		$options = array(
			'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
			'upload_dir' => PHOTOS,
			'upload_url' =>  base_url() . PHOTOS,			
			'image_versions' => array(
				'big' => array(
					'crop' => true,
					'max_width' => 450,	
					'max_height' =>323,				
					'jpeg_quality' => 80
				),
				'' => array(
					'crop' => true,
					'max_width' => 140,	
					'max_height' =>140,				
					'jpeg_quality' => 80
				),
									
			),
		);
		$result = file_upload($options);
		
		$file = $result['files'][0];
		
		
		if(!isset($file->error))
		{				
			//upload thumb and photo to s3
			$this->load->library('s3');
			$file->url = $this->s3->uploadData(PHOTOS.$file->name, "visits/$case_id/$file->name");
			$file->big_url = $this->s3->uploadData(PHOTOS. 'big/'. $file->name, "visits/$case_id/big/$file->name");			
						
		}		
		send_json($file);
	}
        
        public function recipient_photo(){
            
            $case_id= $this->input->post('case_id');
            $this->load->model('cases_m');
            $case = $this->cases_m->get_record($case_id);
            $recipient_id = $case->recipient_id;
            
		$this->load->helper('upload');
		$options = array(
			'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
			'upload_dir' => PHOTOS,
			'upload_url' =>  base_url() . PHOTOS,			
			'image_versions' => array(
				'big' => array(
					'crop' => true,
					'max_width' => 450,	
					'max_height' =>323,				
					'jpeg_quality' => 80
				),
				'' => array(
					'crop' => true,
					'max_width' => 140,	
					'max_height' =>140,				
					'jpeg_quality' => 80
				),
									
			),
		);
		$result = file_upload($options);
		
		$file = $result['files'][0];
		
		
		if(!isset($file->error))
		{	
			if ($recipient_id != 0) {
			//update database 
			$this->load->model('recipients_m');
			$this->recipients_m->update_record(array('photo' => $file->name), $recipient_id);	
			}						
			$this->load->library('s3');
			$file->url = $this->s3->uploadData(PHOTOS.$file->name,PHOTOS.$file->name);
			$file->big_url = $this->s3->uploadData(PHOTOS. 'big/'. $file->name, PHOTOS. 'big/'. $file->name);
						
		}		
		send_json($file);
        }

}

/* End of file Uploads.php */
/* Location: ./application/controllers/Uploads.php */