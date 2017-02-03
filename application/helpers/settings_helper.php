<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('load_setting_file'))
{
	/**
	 * Loads a single language file into an array.
	 *
	 * @param string $filename The name of the file to locate. The file will be found by looking in all modules.
	 *
	 * @return mixed An array on loading the language file, FALSE on error
	 */
	function load_setting_file($filename=NULL)
	{
		if (empty($filename))
		{
			return NULL;
		}

		$array = FALSE;
		
		$path = APPPATH .'config/'. $filename;

	
		// Load the actual array
		if (is_file($path))
		{
			include($path);
		}

		if (isset($config) && is_array($config))
		{
			$array = $config;
			unset($config);
		}

		return $array;

	}//end load_setting_file()
}
	//--------------------------------------------------------------------

if (!function_exists('save_setting_file'))
{
	/**
	 * Save a language file
	 *
	 * @param string $filename The name of the file to locate. The file will be found by looking in all modules.
	 * @param array  $settings An array of the language settings
	 * @param bool   $return   TRUE to return the contents or FALSE to write to file
	 *
	 * @return mixed A string when the $return setting is TRUE
	 */
	function save_setting_file($filename=NULL, $settings=NULL, $return=FALSE)
	{
		if (empty($filename) || !is_array($settings))
		{
			return FALSE;
		}

		
		$path = APPPATH .'config/'. $filename;
		
	
		$contents = file_get_contents($path);
		$empty = FALSE;
		
		// Save the file.
		foreach ($settings as $name => $val)
		{
			// Is the config setting in the file?
			$start = strpos($contents, '$config[\''.$name.'\']');
			$end = strpos($contents, ';', $start);

			$search = substr($contents, $start, $end-$start+1);

			//var_dump($search); die();

			if (is_array($val))
			{
				$tval  = 'array(\'';
				$tval .= implode("','", $val);
				$tval .= '\')';

				$val = $tval;
				unset($tval);
			}
			else if (is_numeric($val))
			{
				$val = $val;
			}
			else
			{
				$val ='\'' . str_replace("'", "\'", $val) .'\'';
			}

			if (!$empty)
			{
				$contents = str_replace($search, '$config[\''.$name.'\'] = '. $val .';', $contents);
			}
			else
			{
				$contents .= '$config[\''.$name.'\'] = '. $val .";\n";
			}
		}//end foreach
		
		// is the code we are producing OK?
		if (!is_null(eval(str_replace('<?php', '', $contents))))
		{
			return FALSE;
		}

		// Make sure the file still has the php opening header in it...
		if (strpos($contents, '<?php') === FALSE)
		{	//if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');
			$contents = '<?php ' . "\n\n" . $contents;
		}

		// Write the changes out...
		if (!function_exists('write_file'))
		{
			$CI = get_instance();
			$CI->load->helper('file');
		}

        if ($return == FALSE)
        {
		    $result = write_file($path, $contents);
        }
        else
        {
            return $contents;
        }

		if ($result === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}

	}//end save_setting_file()
}
	//--------------------------------------------------------------------
