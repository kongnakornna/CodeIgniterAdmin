<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Code Igniter
*
* An open source application development framework for PHP 4.3.2 or newer
*
* @package		CodeIgniter
* @author		Rick Ellis
* @copyright	Copyright (c) 2006, pMachine, Inc.
* @license		http://www.codeignitor.com/user_guide/license.html
* @link			http://www.codeigniter.com
* @since        Version 1.0
* @filesource
*/

// ------------------------------------------------------------------------

/**
* Code Igniter clipone Helpers
*
* @package		CodeIgniter
* @subpackage	Helpers
* @category		Helpers
* @author       Philip Sturgeon < phil.sturgeon@styledna.net >
*/

// ------------------------------------------------------------------------


/**
  * General clipone Helper
  *
  * Helps generate links to asset files of any sort. Asset type should be the
  * name of the folder they are stored in.
  *
  * @access		public
  * @param		string    the name of the file or asset
  * @param		string    the asset type (name of folder)
  * @param		string    optional, module name
  * @return		string    full url to asset
  */

function other_clipone_url($asset_name, $module_name = NULL, $asset_type = NULL)
{
	$obj =& get_instance();
	$base_url = $obj->config->item('base_url');

	$clipone_location = $base_url.'theme/clipone/assets/';

	if(!empty($module_name)):
		$clipone_location .= 'modules/'.$module_name.'/';
	endif;

	$clipone_location .= $clipone_type.'/'.$clipone_name;

	return $clipone_location;

}


// ------------------------------------------------------------------------

/**
  * Parse HTML Attributes
  *
  * Turns an array of attributes into a string
  *
  * @access		public
  * @param		array		attributes to be parsed
  * @return		string 		string of html attributes
  */

function _parse_clipone_html($attributes = NULL)
{

	if(is_array($attributes)):
		$attribute_str = '';

		foreach($attributes as $key => $value):
			$attribute_str .= ' '.$key.'="'.$value.'"';
		endforeach;

		return $attribute_str;
	endif;

	return '';
}

// ------------------------------------------------------------------------

/**
  * CSS Asset Helper
  *
  * Helps generate CSS asset locations.
  *
  * @access		public
  * @param		string    the name of the file or asset
  * @param		string    optional, module name
  * @return		string    full url to css asset
  */

function css_clipone_url($clipone_name, $module_name = NULL)
{
	return other_clipone_url($clipone_name, $module_name, 'css');
}


// ------------------------------------------------------------------------

/**
  * CSS Asset HTML Helper
  *
  * Helps generate JavaScript asset locations.
  *
  * @access		public
  * @param		string    the name of the file or asset
  * @param		string    optional, module name
  * @param		string    optional, extra attributes
  * @return		string    HTML code for JavaScript asset
  */

function css_clipone($clipone_name, $module_name = NULL, $attributes = array())
{
	$attribute_str = _parse_clipone_html($attributes);

	return '<link href="'.css_clipone_url($clipone_name, $module_name).'" rel="stylesheet" type="text/css"'.$attribute_str.' />';
}

// ------------------------------------------------------------------------

/**
  * Image Asset Helper
  *
  * Helps generate CSS asset locations.
  *
  * @access		public
  * @param		string    the name of the file or asset
  * @param		string    optional, module name
  * @return		string    full url to image asset
  */

function image_clipone_url($clipone_name, $module_name = NULL)
{
	return other_clipone_url($clipone_name, $module_name, 'images');
}


// ------------------------------------------------------------------------

/**
  * Image clipone HTML Helper
  *
  * Helps generate image HTML.
  *
  * @access		public
  * @param		string    the name of the file or asset
  * @param		string    optional, module name
  * @param		string    optional, extra attributes
  * @return		string    HTML code for image asset
  */

function image_clipone($clipone_name, $module_name = '', $attributes = array())
{
	$attribute_str = _parse_clipone_html($attributes);

	return '<img src="'.image_clipone_url($clipone_name, $module_name).'"'.$attribute_str.' />';
}


// ------------------------------------------------------------------------

/**
  * JavaScript Asset URL Helper
  *
  * Helps generate JavaScript asset locations.
  *
  * @access		public
  * @param		string    the name of the file or asset
  * @param		string    optional, module name
  * @return		string    full url to JavaScript asset
  */

function js_clipone_url($clipone_name, $module_name = NULL, $user = NULL)
{
	if($user == NULL)
		return other_clipone_url($clipone_name, $module_name, 'js');
	else
		return other_clipone_url($clipone_name, $module_name, $user);
}


// ------------------------------------------------------------------------

/**
  * JavaScript Asset HTML Helper
  *
  * Helps generate JavaScript asset locations.
  *
  * @access		public
  * @param		string    the name of the file or asset
  * @param		string    optional, module name
  * @return		string    HTML code for JavaScript asset
  */

function js_clipone($clipone_name, $module_name = NULL, $user = NULL)
{
	if($user == NULL)
		return '<script type="text/javascript" src="'.js_clipone_url($clipone_name, $module_name).'"></script>';
	else
		return '<script type="text/javascript" src="'.js_clipone_url($clipone_name, $module_name, $user).'"></script>';
}

?>