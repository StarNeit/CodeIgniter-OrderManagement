<?php
class Carepro_model extends CI_Model
{
    protected $table = 'user';


    public function login($email, $password) {
        $query = $this->db->get_where($this->table, array('email'=>$email));

        if($query->num_rows()==1)
        {
                $user = $query->row();			

                //check password
                if($user->password == pass_hash($password,$user->salt)){
                    if ($user->user_type !== 'CarePro')
                        return $this->lang->line('resp_invalid_carepro');
                    
                    return $user;
                }
                return $this->lang->line('resp_invalid_credentials');
        }
        return $this->lang->line('resp_system_error');
    }
    
    public function getCarePro($id, $all = false) {
        if ($all === false)
            $this->db->select('id, first_name, last_name, email, paypal_email, verified_date, is_verified');
        
        $query      = $this->db->get_where('user', ['id' => $id, 'is_active' => 1]);
        if ($query->num_rows() == 1)
            return $all?$query->row_array():$this->_filterUserData($query->row_array());
        
        return false;
    }
}