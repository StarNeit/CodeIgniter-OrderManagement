<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Geocode
{
	public function __construct()
	{
		$this->ci = & get_instance();
	}


	public function zip_reverse($zip)
	{
		
		if(!$zip) {
			return NULL;
		}
		
		$json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$zip.'&key=AIzaSyBEbe2MBNr1fOxfKB7k95vtMcCmxsBok9Q');
		$obj = json_decode($json);
		$reverseData =  $obj->results['0'];
		//var_dump($reverseData);

		//Fetching Formatted Address
		$data['address'] = $reverseData->formatted_address;
		$data['street']  = $reverseData->formatted_address;
		
		//Fetching Country Name from JSON
		$data['country'] = $this->get_country($reverseData);


		// Find Lattitude and Longitue of the Zip
		$geometry = $this->get_geometry($reverseData->geometry);
		$data['lat']  = $geometry['lat'];
		$data['lng']  = $geometry['lng'];


		$data['location_type']  = $geometry['location_type'];

		return $data;
	}

	public function get_geometry($data)
	{
		$location = $data->location;
		$loc['lat'] = $location->lat;
		$loc['lng'] = $location->lng;
		$loc['location_type'] = $data->location_type;
		return $loc;
	}

	public function get_country($data)
	{

	}


}