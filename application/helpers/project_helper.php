<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function care_url($uri='')
{
	return site_url("carepro/$uri");
}
function client_url($uri='')
{
	return site_url("client/$uri");
}


function nationality_options($id = NULL, $default_text='')
{
	$options =array(
		'' => $default_text,
		'Singapore Citizen' => 'Singapore Citizen',
                'Singapore PR'=>'Singapore PR',
		'Other' => 'Other',
	);
	return get_options($id, $options);
}

 

function date_options()
{
	return array('' => '') + array_combine(range(1,31), range(1,31));
}

function month_options()
{
	return array('' => '') + array_combine(range(1,12), range(1,12));
}

function year_options()
{
	return array('' => '') + array_combine(range(1900,date('Y')), range(1900,date('Y')));
}

function expiry_year_options()
{
	$range = range(date('Y'), date('Y')+5);
	return array('' => '') + array_combine($range, $range);
}

function salutation_options()
{
	return array('' => '', 'Mr'=>'Mr', 'Mrs'=>'Mrs', 'Ms'=>'Ms', 'Mdm'=>'Mdm', 'Dr'=>'Dr');
}

function gender_options()
{
	return array('' => '', 'Male' => 'Male', 'Female' => 'Female');
}

function religion_options()
{
	return array('' => '', 'Buddhism' => 'Buddhism','Christian'=>'Christian','Catholicism'=>'Catholicism','Muslim'=>'Muslim','Taoism'=>'Taoism', 'Other' => 'Other');
}

function race_options()
{
	return array('' => '', 'Chinese' => 'Chinese','Malay' => 'Malay','Indian' => 'Indian','Eurasian' => 'Eurasian', 'Other' => 'Other');
}

function languages_array()
{
	return array(
		'English',
		'Mandarin',
		'Malay',
		'Tamil',
		'Hokkien',
		'Teochew',
		'Cantonese',
		'Hakka',
		'Hainanese',
		'Others',
	);
}

function trainings_array()
{
	return array(
		'Diploma in Nursing and above',
                'NITEC in Nursing',
                'SNB Practising Certificate',
		'Certification in Caregiving',
		'Formal CPR/BCLS Certification',
		'Formal First Aid Certification',
		'None',
	);
}

function experiences_array()
{
	return array(
		'ALS',
		'Palliative',
		'Incontinence',
                'Multiple sclerosis',
                'Prosthetics',
                'Parkinson’s',
                'Seizures',
                'Skin impairment/wound',
                'Stroke',
                'Alzheimer’s',
                'Tracheostomy Tube',
                'Dementia',
                'COPD',
                'Others',
	);
}

function past_experiences_array()
{
	return array(
		'Bathing',
		'Wheelchair transfer',
                'Assisting patients with ambulation',
                'Hospice care',
                'Personal Care',
                'Meal preparation',
                'Medication adherence',
		'Overnight surveillance',
                'Groceries and shopping',
                'Toileting',
                'Transferring',
                'Companionship',
                'Cleaning',
	);
}

function documents_options()
{
	return array(
               'CRP'=>'CPR/BCLS Certification/Card',
               'TB'=>'TB Screening Report',
               'Certificate'=>'Caregiver and other relavant Certificate',
               'IC'=>'Identification Card',
               'Others' => 'Resume and Other Documents',
	);
}

function documents_array()
{
	return array_keys(documents_options());
}


function status_options()
{
	return array(
		'' => '',
		'Received' => 'Received',
                'Shortlisted' => 'Shortlisted',
		'In-Review' => 'In-Review',
		'Placed' => 'Approved',
		'Rejected' => 'Blacklisted'
	);
}

function applicant_status_options()
{
	return array(
		'' => '',
		'Received' => 'Received',
		'In-Review' => 'In-Review',
		'Shortlisted' => 'Shortlisted',		
	);
}

function know_how_options()
{
	return array(
		'' => '',
		'Google' => 'Google',
		'In-Review' => 'In-Review',
		'My friend told me' => 'My friend told me',		
	);
}

function relationship_options()
{
	return array(
		'' => '',
		'Father' => 'Father',
		'Mother' => 'Mother',
		'Other' => 'Other',				
	);
	
}
function experience_years_array()
{
	return array(
                'None',
		'Less than 1 year',
		'1 - 3 years',
		'3 - 5 years',				
		'5 - 10 years',				
		'More than 10 years',
	);
	
}

function calculate_age($bithdayDate)
{
	 $date = new DateTime($bithdayDate);
	 $now = new DateTime();
	 $interval = $now->diff($date);
	 return $interval->y;
}

function time_options()
{
	$options = array('' => '');
	for($i = 0; $i<=24; $i++)
	{
		$time = str_pad($i, 2, 0, STR_PAD_LEFT);

		$options["$time:00:00"] = "$time:00";
	}
	return $options;
}

function week_days()
{
	return array('Mon', 'Tues', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
}

function visit_period($visit_from, $visit_to)
{
	$start = strtotime($visit_from);
	$end = strtotime($visit_to);
	
	if(date('Y-m-d', $start) == date('Y-m-d', $end))
	{
		//same date, show time interval
		return date('d M H:i', $start)  . ' - ' . date('H:i', $end); 
	}
	else{
		//different date, show date interval
		return date('d M',$start) . ' - ' . date('d M', $end);
	}
}