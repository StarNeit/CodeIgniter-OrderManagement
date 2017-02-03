<?php if (!defined('BASEPATH'))   exit('No direct script access allowed');
/**
 * Description of MY_url_helper
 *
 * @author Petru Anton <petea2008@gmail.com>
 * @date Nov, 2012 
 * @filesource my_url_helper.php
 */


    function admin_url($uri = '')
    {
		$CI = &get_instance();
		$admin_path = $CI->config->item('admin_path');
		$admin_path = trim($admin_path,'/');

		return site_url($admin_path.'/'.$uri);
    }

    function asset_url($filepath)
    {
		$CI = &get_instance();
		$assets_path = $CI->config->item('assets_path');
		$assets_path = trim($assets_path, '/');

		return base_url($assets_path .'/'.$filepath);
    }

    function admin_redirect($uri = '')
    {
		$CI = &get_instance();
		$admin_path = $CI->config->item('admin_path');
		$admin_path = trim($admin_path,'/');

		return redirect($admin_path.'/'.$uri);
    }

    /**
     * Detect type of url, absolute or relative and return absolute url
     */
    function media_url($uri){

    	$url = ( ! preg_match('!^\w+://! i', $uri)) ? base_url($uri) : $uri;
    	return $url;
    }

    function is_url($uri)
    {
        return preg_match('!^\w+://! i', $uri);
    }

   







/* End of file my_url_helper.php */
/* Location: ./application/helpers/my_url_helper.php */