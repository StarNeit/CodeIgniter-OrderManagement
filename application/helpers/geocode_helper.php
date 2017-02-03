<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 *  Return an associative array with 2 keys: lat, lng 
	 *	or false in case of no results
	 */
	function get_coordinates($address)
	{
		$params['address'] = trim($address);
		$params['sensor'] = 'false';
		$query_string =  http_build_query($params);

		$url = "http://maps.googleapis.com/maps/api/geocode/json?$query_string";

		$json_result = file_get_contents($url);


		$data = json_decode($json_result, TRUE);
		
		if($data['status'] =='OK'){

			$result = $data['results'][0]['geometry']['location'];			
			return $result;
		}
		return false;
	}

