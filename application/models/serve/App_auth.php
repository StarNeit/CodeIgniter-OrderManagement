<?php

class App_auth extends CI_Model
{	
	public function __construct() {
		parent::__construct();
		$this->_flushExpiredTokens();
	}
        
        private function db_table() {return 'user_token';}

	public function generateToken($user_id) {
		$this->_removeExisting($user_id);
                $data                   = array();
		$data['token']          = $this->_generate($user_id);
		$data['user_id']	= $user_id;
		$data['expires']= date('Y-m-d H:i:s', (time() + (60*60*24*1)));
		
		$this->_insertNewToken($data);
		
		return $data['token'];
	}
	
	public function validateToken($token) {
		$this->db->select('id, user_id');
		$this->db->where('expires >=', 'NOW()', false);
		$this->db->where('token', $token);
		$query = $this->db->get($this->db_table());
		
		if (!$query->num_rows())
			return false;
		
		$user               = $query->row_array();
		$return             = array();
		$return['id']       = $user['user_id'];
                $return['token']    = $token;
		
		$this->db->update($this->db_table(), array('expires' => date('Y-m-d H:i:s', (time() + (60*60*24*1)))), array('id' => $user['id']));
		
                return $return;
	}
	
	private function _generate($user_id) {
		$query	= $this->db->get_where('user', ['id' => $user_id]);
		$user	= $query->row_array();
		
		$key 	= hash_hmac('sha512', $user_id, $this->secret_key);
		$token	= substr(hash_hmac('sha512', $user['password'], $key), 0, 64);
		
		return $token;
	}
	
	private function _insertNewToken($data) {
		return $this->db->insert($this->db_table(), $data);
	}
	
	private function _flushExpiredTokens() {
		$this->db->where('expires <', 'NOW()', false);
		return $this->db->delete($this->db_table());
	}
	
	private function _removeExisting($user_id) {	
		return $this->db->delete($this->db_table(), ['user_id' => $user_id]);
	}
}