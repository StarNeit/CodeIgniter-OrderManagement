<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);

require('fileuploader/UploadHandler.php');

/**
* Upload file and send back to browser file info 
*/
function simple_upload($options = array())
{
	$upload_handler = new UploadHandler($options);
}

/**
 * Upload file and return result;
 */
function file_upload($options = array())
{
	$upload_handler = new UploadHandler($options, FALSE);
	$result = $upload_handler->post();
	return $result;

}

