<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carepro_application_m extends MY_Model{
	
	protected $table = 'carepro_application';
	protected $primary_key = 'id';
	protected $columns = array(
		'user_id' => array('User Id', 'trim|required'),
		'experience_summary' => array('Experience Summary', 'trim|required'),
		'experience_years' => array('Experience Years', 'trim|required'),
		'criminal_record' => array('Criminal Record', 'trim|required'),
		'criminal_detail' => array('Criminal Detail', 'trim'),
		
		'confirmation' => array('Confirmation', 'required', FALSE),
		
		'full_name' => array('Full Name', 'trim|required'),
		'ref_name' => array('Contact Reference Name', 'trim|required'),
		'ref_relationship' => array('Contact Reference Relationship', 'trim|required'),
		'ref_contact' => array('Contact Reference Contact', 'trim|required'),
		'ref_email' => array('Contact Reference Email', 'trim|valid_email'),
		'sec_ref_name' => array('Second Contact Reference Name', 'trim|required'),
		'sec_ref_relationship' => array('Second Contact Reference Relationship', 'trim|required'),
		'sec_ref_contact' => array('Second Contact Reference Contact', 'trim|required'),
		'sec_ref_email' => array('Second Contact Reference Email', 'trim|valid_email'),

		//fields form another tables
		'training[]' => array('Training', 'required', FALSE),
		'experience[]' => array('Experience', 'required', FALSE),

	);	

	public function save_trainings($items, $user_id)
	{
		//remove old values
		$this->db->where('user_id', $user_id)->delete('carepro_training');
		
		$insert = array();
		foreach($items as $item)
		{
			$insert[] = array('training' => $item, 'user_id' => $user_id);
		}
		if($insert)
		{
			$this->db->insert_batch('carepro_training', $insert);
		}
	}

	public function save_eperience($items, $user_id)
	{
		//remove old values
		$this->db->where('user_id', $user_id)->delete('carepro_experience');
		
		$insert = array();
		foreach($items as $item)
		{
			$insert[] = array('experience' => $item, 'user_id' => $user_id);
		}
		if($insert)
		{
			$this->db->insert_batch('carepro_experience', $insert);
		}
	}

	public function save_certifications($certificates, $cert_from, $cert_till, $user_id)
	{
		//remove old values
		$this->db->where('user_id', $user_id)->delete('carepro_certification');
		
		$insert = array();
		foreach($certificates as $index => $certificate)
		{
			$certified_on = element($index, $cert_from);
			$expiry = element($index, $cert_till);

			if($certificate)
			{
				$insert[] = array(
					'certificate' => $certificate, 
					'certified_on' => $certified_on ,
					'expiry' => $expiry,
					'user_id' => $user_id
				);
			}
		}
		if($insert)
		{
			$this->db->insert_batch('carepro_certification', $insert);
		}
	}

	public function save_documents($records, $user_id)
	{
		//remove old values
		$this->db->where('user_id', $user_id)->delete('carepro_document');
		$this->db->insert_batch('carepro_document', $records);
	}
	
	public function update_documents($records, $user_id)
	{
		foreach ($records  as $record) {
			if(trim($record['type'], '123') == 'Others'){
				$record['type'] = 'Others';
				$this->db->insert('carepro_document', $record);
			}elseif (is_int($record['type'])) {
				$this->db->where(array('id'=>$record['type']));
				$record['type'] = 'Others';
				$this->db->update('carepro_document', $record);
			}else{
				$result = $this->db->get_where('carepro_document', array('user_id' => $user_id,'type'=>$record['type']))->result();
				if ($result) {
					 $this->db->where(array('user_id' => $user_id,'type'=>$record['type']));
					 $this->db->update('carepro_document', $record);
				} else {
					$this->db->insert('carepro_document', $record);
				}
			}
		}

	}
}
