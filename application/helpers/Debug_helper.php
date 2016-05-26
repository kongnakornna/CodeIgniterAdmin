<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('Debug')){

	function Debug($object, $title = null, $default = FALSE){

		if ( ! isset($object) ){
			return $default;
		}

		if($title) echo "<code>$title</code>";
		echo '<pre>';
		print_r($object);
		echo '</pre>';

		//return $array[$item];
	}
}
