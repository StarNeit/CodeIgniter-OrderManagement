<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Carepro extends REST_Controller {
  
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('serve/carepro_model', 'carepro');
    }
    
    public function login_post() 
    {
        $email = $this->post('email');
        $password = $this->post('password');
        
        $user = $this->carepro->login($email, $password);
        
        if (is_string($user))
            $this->sendAlert ($user);
        
        $this->load->model('carepro_m');
        $data = array();
        $data['CarePro'] = $this->carepro_m->get_user($user->id, true);
        $data['AccessToken'] = $this->app_auth->generateToken($user->id);
        
        $this->response($data, 200);
    }
}