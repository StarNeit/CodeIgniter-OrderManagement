<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Launch extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }
    
    public function carepro_post() 
    {
        $return                     = array();
        $return['privacy_url']      = 'http://www.homage.sg';
        $return['terms_url']        = 'http://www.homage.sg';
        $return['agreement_url']    = 'http://www.homage.sg';
        $return['nda_url']          = 'http://www.homage.sg';
        $return['contact']          = 'telprompt://61000055';
        
        $this->response($return, 200);
    }

    public function client_post()
    {
        $return                     = array();
        $return['privacy_url']      = 'http://www.homage.sg';
        $return['terms_url']        = 'http://www.homage.sg';
        $return['contact']          = 'telprompt://61000055';
        
        $this->response($return, 200);
    }
}