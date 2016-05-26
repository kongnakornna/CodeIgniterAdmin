<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('SaveJSON')){

		function SaveJSON($data, $filename, $encode = false, $pathfile = '', $test = 0){

				//if($pathfile == 'Ymd') $pathfile = date('y-m-d').'/';
				if($pathfile == '') $pathfile = 'users_access/';

				if (!is_dir("json")) mkdir("json", 0777,true);

				if($test == 0){
					if (!is_dir("json/".$pathfile)) mkdir("json/".$pathfile, 0777,true);
					$json_files = "json/".$pathfile.$filename.".json";
				}else{
					if (!is_dir("../json/".$pathfile)) mkdir("../json/".$pathfile, 0777,true);
					$json_files = "../json/".$pathfile.$filename.".json";
				}
				//$json_files = "json/".date('y-m-d').".json";

				if($encode == true)
					$data_json = json_encode($data);
				else
					$data_json = $data;

				//Debug($data_json);
				//die();

				$objFopen=fopen($json_files,'w');
				fwrite($objFopen, $data_json);
				fclose($objFopen);		
		}
}

if ( ! function_exists('Saveapijson')){
		function Saveapijson($data, $filename, $encode = false, $pathfile = '', $test = 0){

				//if($pathfile == 'Ymd') $pathfile = date('y-m-d').'/';
				if($pathfile == '') $pathfile = 'jsonfile/';

				if (!is_dir("api/")) mkdir("api/", 0777,true);

				if($test == 0){
					if (!is_dir("api/".$pathfile)) mkdir("api/".$pathfile, 0777,true);
					$json_files = "api/".$pathfile.$filename.".json";
				}else{
					if (!is_dir("../api/".$pathfile)) mkdir("../api/".$pathfile, 0777,true);
					$json_files = "../api/".$pathfile.$filename.".json";
				}
                   /*	
				if($encode == true)
					$data_json = json_encode($data);
				else
					$data_json = $data;
                    */
                    header('Access-Control-Allow-Origin: *');
			     header('content-type: application/json; charset=utf-8');
                    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
                    //Debug($data);Die();
			     //$data=utf8_encode($data);
				$data_json=json_encode($data, true);
                    //$data_json=json_encode($data); 
                    //Debug($data_json);Die();   
			     ///////////////////////////////
                     $data_json = str_replace('\"','"', $data_json);
     	           $data_json = str_replace("\'","'", $data_json);
                     $data_json = str_replace('"[','[', $data_json);
     	           $data_json = str_replace(']"',']', $data_json);
                   // Debug($data_json); die();
				$objFopen=fopen($json_files,'w');
				fwrite($objFopen, $data_json);
				fclose($objFopen);
                    echo $data_json;Die();	
		}
}


if ( ! function_exists('LoadJSON')){

		function LoadJSON($file = "default.json", $pathfile = ''){
				$list = array();
				//if($pathfile == 'Ymd') $pathfile = date('y-m-d').'/';
				if($pathfile == '') $pathfile = 'users_access/';

				//$fullpath = "../json/".$pathfile.$file;
				$fullpath = "./json/".$pathfile.$file;
				if(!file_exists($fullpath)) $fullpath = "./json/".$pathfile.$file;

				//echo ''.$fullpath.'<br>';
				$jsonData = file_get_contents($fullpath);
				//$jsonData=fopen($fullpath,'r');

				$phpArray = json_decode($jsonData, true);

				if(isset($phpArray))
				foreach ($phpArray as $key => $value) {

					//echo "<br>$key => $value";

					//if(is_array($value))
						foreach ($value as $k => $v) {
							$list[$key][$k] = $v;
							//echo "<br>$k => $v";
						}
				}
				return $list;
		}
}
if ( ! function_exists('Loadjsonapi')){

		function Loadjsonapi($file = "default.json", $pathfile = ''){
				$list = array();
				//if($pathfile == 'Ymd') $pathfile = date('y-m-d').'/';
				if($pathfile == '') $pathfile = 'jsonfile/';

				//$fullpath = "../json/".$pathfile.$file;
				$fullpath = "./api/".$pathfile.$file;
				if(!file_exists($fullpath)) $fullpath = "./api/".$pathfile.$file;

				//echo ''.$fullpath.'<br>';
				$jsonData = file_get_contents($fullpath);
				//$jsonData=fopen($fullpath,'r');

				$phpArray = json_decode($jsonData, true);

				if(isset($phpArray))
				foreach ($phpArray as $key => $value) {

					//echo "<br>$key => $value";

					//if(is_array($value))
						foreach ($value as $k => $v) {
							$list[$key][$k] = $v;
							//echo "<br>$k => $v";
						}
				}
				return $list;
		}
}
if ( ! function_exists('GetConfig')){
		function GetConfig($file = "configuration.json"){

				$list = array();
				$pathfile = 'www/';
				//$fullpath = "../json/".$pathfile.$file;
				$fullpath = "./json/".$pathfile.$file;
				if(!file_exists($fullpath)) $fullpath = "./json/".$pathfile.$file;
				//echo ''.$fullpath.'<br>';
				$jsonData = file_get_contents($fullpath);
				//$jsonData=fopen($fullpath,'r');
				$phpArray = json_decode($jsonData, true);

				if(isset($phpArray))
				foreach ($phpArray as $key => $value) {
						//echo "<br>$key => $value";
						$list[$key] = $value;
						if(is_array($value))
						foreach ($value as $k) {
								$list[$key][$k] = $v;
								echo "<br>$k => $v";
						}
				}
				return $list;
		}
}

if ( ! function_exists('GetConfig1')){
		function GetConfig1($file = "configuration.json"){

				$list = array();
				$pathfile = 'setting/';
				//$fullpath = "../json/".$pathfile.$file;
				$fullpath = "./json/".$pathfile.$file;
				if(!file_exists($fullpath)) $fullpath = "./json/".$pathfile.$file;

				//echo ''.$fullpath.'<br>';
				$jsonData = file_get_contents($fullpath);
				//$jsonData=fopen($fullpath,'r');
				$phpArray = json_decode($jsonData, true);

				if(isset($phpArray))
				foreach ($phpArray as $key => $value) {
						//echo "<br>$key => $value";
						$list[$key] = $value;
						if(is_array($value))
						foreach ($value as $k) {
								$list[$key][$k] = $v;
								echo "<br>$k => $v";
						}
				}
				return $list;
		}
}
          if ( ! function_exists('encode_array')){
                    function encode_array($array = array())
                    	{
                    		// RETURN NULL IF PASSED VAR IS NOT AN ARRAY
                    		if ( ! is_array($array) )
                    		{
                    			return NULL;
                    		}
                    		
                    		// DECLARE ARRAY TO IMPLODE AND RETURN
                    		$return_array = array();
                    		
                    		foreach($array as $key => $value)
                    		{
                    			$return_array[] = $this->_encode_scalar($key) . ':' . $this->_encode_scalar($value);
                    		}
                    		
                    		// IMPLODE ARRAY AND RETURN JSON
                    		return '{' . implode(',', $return_array) . '}';
                    	}    
          }

          if ( ! function_exists('_encode_scalar')){
                    function _encode_scalar($scalar = '')
                    	{
                    		if ( ! is_scalar($scalar) )	// NOT A SCALAR, NO DICE
                    		{
                    			return NULL;
                    		}
                    		elseif ( is_float($scalar) )
                    		{
                    			return floatval(str_replace(',', '.', strval($scalar))); // ALWAYS USE '.' FOR FLOATS
                    		}
                    		elseif ( is_string($scalar) )
                    		{
                    			static $json_replace_array = array(array('\\', '/', "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
                    			return '"' . str_replace($json_replace_array[0], $json_replace_array[1], $scalar) . '"';
                    		}
                    		else return $scalar;		
                    	}
          }


if ( ! function_exists('json_clean_decode')){

		function json_clean_decode($json, $assoc = false, $depth = 512, $options = 0) {
			// search and remove comments like /* */ and //
			$json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $json);
			if(version_compare(phpversion(), '5.4.0', '>=')) {
				$json = json_decode($json, $assoc, $depth, $options);
			}
			elseif(version_compare(phpversion(), '5.3.0', '>=')) {
				$json = json_decode($json, $assoc, $depth);
			}
			else {
				$json = json_decode($json, $assoc);
			}
			return $json;
		}
          
          
}