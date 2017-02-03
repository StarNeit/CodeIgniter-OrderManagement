<?php

class Util
{
	public function __construct()
	{
		$this->ci = & get_instance();
	}


	function send_email($to_email, $message, $subject = "Test email", $from_email ="", $from_name="", $to_name="")
	{
		if(!$from_email){$from_email = conf('no_reply_email');}
		if(!$from_name){$from_name = conf('site_name');}
		
		$CI = & get_instance();
		
		$CI->load->library('email');

		$CI->email->from($from_email,$from_name);
	   	$CI->email->to($to_email, $to_name);
		$CI->email->subject($subject);
		$CI->email->message($message);
		$CI->email->set_newline("\r\n"); //do not remove

		
		return	$CI->email->send();

	}

	function send_tpl_email($content_view, $data)
	{
		
		$to_email = element('email', $data, conf('contact_email')); //use contact_email if not indicated
		$to_name = element('to_name', $data);
		$subject = element('subject', $data, 'no subject');
		$from_email = element('from_email', $data, conf('no_reply_email')); //if not indicated, use default no_reply_email
		$from_name = element('from_name', $data, conf('site_name')); //if not indicated use site name
		
		$data['content_view'] = $content_view;

		$CI = & get_instance();
		$message = $CI->load->view('email/email_layout', $data, TRUE);

		
		return $this->send_email($to_email, $message, $subject, $from_email, $from_name);
	}

	function log_action($message, $module)
	{
		return; //disable it
		$CI = & get_instance();
		
		$user = $CI->session->userdata('user');
		if($user){
			$log['ip'] = $CI->session->userdata('ip_address');
			$log['user_id'] = $user->id;
			$log['user_type'] = $CI->session->userdata('logged') =='admin';
			$log['user_role'] = $user->role_code;
			$log['module'] = str_replace("_model", "", $module);
			$log['action'] = $message;
			
			$CI->db->insert('user_logs', $log);
		}
	}

	/** 
	*	Create user session when user is logged in front site
	*	@param object - user row from database
	*/
	function create_user_session($user)
	{		
		$CI = & get_instance();
		
		$u = new StdClass();
		$u->id = $user->id;
		$u->full_name = $user->first_name . ' ' . $user->last_name;
		$u->email = $user->email;
		$u->photo = $user->photo;
		$u->is_active = $user->is_active;
		$u->is_verified = $user->is_verified;

		$session = array(
			'user' => $u,				
			'logged' => $user->user_type,
		);	

		$CI->session->set_userdata($session);
	}

	public function error_404()
	{		
		$CI =& get_instance();
		
		$data = array(
			'title' => 'Page not Found',	
			'meta' => '',							
			'view_file' => '404_view',
			
		);	
		$CI->output->set_status_header('404');		
		$CI->render('404_view', $data);
	}

	


	public function menus_permissions($menus, $permissions=NULL)
	{
		

		if($permissions)		
		{
			$grant = array(
					"auth",
					"auth/account",
					"auth/logout",
					"home",
					"home/index",
				);

			foreach($menus as $key => $data)
			{

				//check grant permissions
				if(in_array($key, $grant)){ 
					continue;
				}
				$fkey = $key;
				if(strpos($fkey, '/')===FALSE){
					$fkey .="/index";
				}

				
				//check permissions for second level
				if(isset($data['items']))
				{

					foreach($data['items'] as $k => $d)
					{							
						$fk = $k;
						if(strpos($fk, '/')===FALSE){
							$fk .="/index";
						}

						if(!isset($permissions[$fk]))
						{
							unset($menus[$key]['items'][$k]);
						}
					}
					
					if(count($menus[$key]['items'])==0){
						unset($menus[$key]);
					}
					continue;
				}

				//check permission for first level
				if(!isset($permissions[$fkey])){
					unset($menus[$key]);
				}
			} 
			
			return $menus;			
		}
		else{
			return $menus;
		}
	}


}