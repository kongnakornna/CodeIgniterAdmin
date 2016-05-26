<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| URL Style
|--------------------------------------------------------------------------
|
| This option allows you to choose your URL stle.
| 
| "SEO":
| http://domain.com/tranlated-uri
| Defaults back to Path if no translation provided
| SEO links only works using REQUEST_URI
|
| "Path":
| http://domain.com/en/path
|
| "Query":
| http://domain.com/path?lang=en
| 
*/
$config['url_style'] = "SEO";

/*
|--------------------------------------------------------------------------
| Languages
|--------------------------------------------------------------------------
|
| A list of supported languages with names.
| 
*/
$config['languages'] = array('english'=>'English', 'thai'=>'Thai');

/*
|--------------------------------------------------------------------------
| Browser Language Detection
|--------------------------------------------------------------------------
|
| If no language is determined by the url we use HTTP_ACCEPT_LANGUAGE to detect users preferred language
| 
*/
$config['browser_language_detection'] = TRUE;

/*
|--------------------------------------------------------------------------
| Language Codes
|--------------------------------------------------------------------------
|
| A list of language codes: http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes.
| Used for all but seo url styles and for browser language detection.
| 
*/
$config['language_codes'] = array(
	'en' => 'english',
	'th' => 'thai'
);

/*
|--------------------------------------------------------------------------
| Segment Translations
|--------------------------------------------------------------------------
|
| For SEO urls
| Translations of URI segments for each language, translation of controller must be used
| to detect language, and controller translations must differ to original.
| 
*/
$config['segment_translations'] = array(
	'thai' => array(
		'index' => 'หน้าแรก',
		'about' => 'เกี่ยวกับเรา',
		'downloads' => 'ดาวส์โหลด',
		'contact' => 'ติดต่อเรา'
	)
);