<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('SaveJSON')){

		function Saveapijson($data, $filename, $encode = false, $pathfile = '', $test = 0){

				//if($pathfile == 'Ymd') $pathfile = date('y-m-d').'/';
				if($pathfile == '') $pathfile = 'users_access/';

				if (!is_dir("api/jsonfile")) mkdir("api/jsonfile", 0777,true);

				if($test == 0){
					if (!is_dir("api/jsonfile/".$pathfile)) mkdir("api/jsonfile/".$pathfile, 0777,true);
					$json_files = "api/jsonfile/".$pathfile.$filename.".json";
				}else{
					if (!is_dir("../api/jsonfile/".$pathfile)) mkdir("../api/jsonfile/".$pathfile, 0777,true);
					$json_files = "../api/jsonfile/".$pathfile.$filename.".json";
				}
				//$json_files = "api/jsonfile/".date('y-m-d').".json";

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

if ( ! function_exists('LoadJSON1')){

		function LoadJSON1($file = "default.json", $pathfile = ''){
				$list = array();
				//if($pathfile == 'Ymd') $pathfile = date('y-m-d').'/';
				if($pathfile == '') $pathfile = 'users_access/';

				//$fullpath = "../api/jsonfile/".$pathfile.$file;
				$fullpath = "./api/jsonfile/".$pathfile.$file;
				if(!file_exists($fullpath)) $fullpath = "./api/jsonfile/".$pathfile.$file;

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
		function GetConfigna1($file = "configuration.json"){

				$list = array();
				$pathfile = 'www/';
				//$fullpath = "../api/jsonfile/".$pathfile.$file;
				$fullpath = "./api/jsonfile/".$pathfile.$file;
				if(!file_exists($fullpath)) $fullpath = "./api/jsonfile/".$pathfile.$file;
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
		function GetConfigna2($file = "configuration.json"){

				$list = array();
				$pathfile = 'setting/';
				//$fullpath = "../api/jsonfile/".$pathfile.$file;
				$fullpath = "./api/jsonfile/".$pathfile.$file;
				if(!file_exists($fullpath)) $fullpath = "./api/jsonfile/".$pathfile.$file;

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

if ( ! function_exists('json_clean_decode')){

		function json_clean_decodena($json, $assoc = false, $depth = 512, $options = 0) {
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