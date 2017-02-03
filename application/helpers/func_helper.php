<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$ci = & get_instance();
$ci->load->library('session');

function f($name, $default="")
{
	$CI = & get_instance();
	if(isset($CI->filter[$name])){
		return $CI->filter[$name];
	}
	else return $default;
}

function conf($name)
{
	$CI = & get_instance();
	return $CI->config->item($name);
}



function set_error($message)
{
	$ci = & get_instance();
	$ci->session->set_flashdata("error", $message);
}

function get_error()
{
	$ci = & get_instance();
	return $ci->session->flashdata("error");
}

function set_success($message)
{
	$ci = & get_instance();
	$ci->session->set_flashdata("success", $message);
}

function get_success()
{
	$ci = & get_instance();
	return $ci->session->flashdata("success");
}

function show_message()
{
	$error = get_error();
	if($error){
		echo '<div class="alert alert-danger"><button type="button" class="close">×</button><h4><i class="glyphicon glyphicon-remove-circle"></i> Error</h4>'.$error.'</div>';
	}
	$success = get_success();
	if($success){
		echo '<div class="alert alert-success"><button type="button" class="close">×</button><h4><i class="glyphicon glyphicon-ok-sign"></i> Success</h4>'.$success.'</div>';
	}
}

function show_info_page($message, $type='error', $title='')
{	
	$ci = & get_instance();
	if($ci->input->is_ajax_request()){
		$data[$type] = $message;
		send_json($data);
	}
	
	if(!$title && $type=='error'){
		$title = 'Error occured';
	}
	$data['type'] = $type;
	$data['message'] = $message;
	$data['title'] = $title;
	$data['view_file'] = 'message_view';

	
	die($ci->load->view('layout', $data, TRUE));
}

function time_ago($time)
{
	if(!is_numeric($time)){ //not timestamp
		$time = strtotime($time);
	}

    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        if($numberOfUnits){
        	return $numberOfUnits.' '.lang($text.(($numberOfUnits>1)?'s':''));
        }  
    }
    return 'just now';
}


function get_image($filename)
{
	if(file_exists( $filename ) && !is_dir( $filename )){
		return base_url( $filename );
	}
	else{
		return base_url("assets/images/signup_carepro.png");
	}
}



function get_per_page_options()
{
	$page_limits = conf('per_page_options');
	$pages =  explode(',', $page_limits);
	return array_combine($pages, $pages);
}

function pass_hash($password, $salt)
{
	return md5(sha1($password).sha1($salt));
}



function send_json($data)
{
	die(json_encode($data));
}

function get_file_extension($filename)
{
	return pathinfo($filename, PATHINFO_EXTENSION);
}

//human date
function hdate($date, $show_time=FALSE)
{

	if($date=='0000-00-00 00:00:00'){
		return '';
	}
        
        if(strpos($date,'/')!==false){
            $date = str_replace('/','-',$date);
        }
	
	$time = strtotime($date); 
	if(! $time){
		return FALSE;
	}

	if($show_time){
		return date('d/m/Y H:i', $time);
	}
	else{
		return date('d/m/Y', $time);
	}
}

function db_date($date)
{
	$date = str_replace('/', '-', $date);
	$time = strtotime($date);

	if($time){
		return date('Y-m-d H:i:s', strtotime($date));
	}
	return '';
}



function preg($var){
	echo '<pre>'.print_r($var, TRUE).'</pre>';
}




function alias($string, $id=NULL)
{
	$string = transliterate($string);


	if($id){
		$string = "$string-$id";
	}
	$normalizeChars = array(
	    'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
	    'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
	    'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
	    'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
	    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
	    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
	    'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f', 'ş'=>'s', 'Ş'=>'S', 'ţ' => 't',
	    'Ţ' => 'T', 'ă'=>'a', 'Ă'=>'A',
	);
	$string = strtr($string, $normalizeChars);
	return url_title(strtolower($string));
}

function transliterate($string) {
    $roman = array("Sch","sch",'Yo','Zh','Kh','Ts','Ch','Sh','Yu','ya','yo','zh','kh','ts','ch','sh','yu','ya','A','B','V','G','D','E','Z','I','Y','K','L','M','N','O','P','R','S','T','U','F','','Y','','E','a','b','v','g','d','e','z','i','y','k','l','m','n','o','p','r','s','t','u','f','','y','','e');
    $cyrillic = array("Щ","щ",'Ё','Ж','Х','Ц','Ч','Ш','Ю','я','ё','ж','х','ц','ч','ш','ю','я','А','Б','В','Г','Д','Е','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Ь','Ы','Ъ','Э','а','б','в','г','д','е','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','ь','ы','ъ','э');
    return str_replace($cyrillic, $roman, $string);
}



function gravatar($email, $size=140)
{
	$hash = md5($email);
	return "http://www.gravatar.com/avatar/$hash?s=$size&d=wavatar";
}

function user_avatar($avatar_url, $email, $size=140)
{
	if(!$avatar_url){
		return gravatar($email, $size);
	}
	return $avatar_url;
}

function get_substr($string, $maxlength=100)
{
	$string = strip_tags($string);
	return mb_substr($string, 0,$maxlength,"utf-8") . (mb_strlen($string)>$maxlength ? '...':'');
}

function country($code)
{
	$countries = conf('countries');
	return @$countries[$code];
}



function get_options($type=NULL, $options=array())
{
	if($type!=NULL){
		if(isset($options[$type])){
			return $options[$type];
		}
		return FALSE;
	}
	return $options;
}

function dbdate($date)
{
	
	if(strpos($date,'/')!==false){
	    $date = str_replace('/','-',$date);
	}
        
	$time = strtotime($date);
	
	if($time){
		return date('Y-m-d H:i:s', strtotime($date));
	}
	return false;
}

function dbtime($date)
{

	if(strpos($date,'/')!==false){
		$date = str_replace('/','-',$date);
	}
	return strtotime($date);
}


function price($value, $decimals = 2)
{
	return number_format($value, $decimals);	
}

function number($value)
{
	return number_format($value, 0);	
}


function e($str)
{
	echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}

function is_image($file)
{
	$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
	$detectedType = @exif_imagetype($file);
	return in_array($detectedType, $allowedTypes);
}

function GetAge($dob="1970-01-01") 
{ 
        $dob=explode("-",$dob); 
        $curMonth = date("m");
        $curDay = date("j");
        $curYear = date("Y");
        $age = $curYear - $dob[0]; 
        if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[2])) 
                $age--; 
        return $age; 
}

function random_hash($char = 8) {
    return substr(md5(rand()), 0, $char);
}
function get_s3_file($folder,$filename=null,$user_id,$cat,$size = null,$sample_image='assets/images/signup_carepro.png')
{
    $ci = & get_instance();
    $ci->load->config('s3');
    $pre_url = 'https://'.conf('endpoint').'/'.conf('bucket').'/';
    
	if($filename != null){
		if ($size != null) {
			$url = $folder.'/'.$user_id.'/'.$cat.'/'.$size.'/'.$filename;
		}else{
			$url = $folder.'/'.$user_id.'/'.$cat.'/'.$filename;
		}

		if(check_s3_file_exist($url))
                    return $pre_url.$url;
                else
                    return base_url($sample_image);
	}
	else{
		return base_url($sample_image);
	}
}

function check_s3_file_exist($filename){
    $ci = & get_instance();
    $ci->load->library('s3');
    $ci->load->config('s3');
    
    ini_set('display_errors', 0);
    $info = $ci->s3->getObjectInfo(conf('bucket'), $filename,false);
    
    if($info)
        return true;
    
    return false;
}