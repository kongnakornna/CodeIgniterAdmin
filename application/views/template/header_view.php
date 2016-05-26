<?php 
# แปลภาษา
# File THAI --> application\language\thai\app_lang.php
# File English --> application\language\english\app_lang.php	
$language = $this->lang->language;
$lang=$this->lang->line('lang');
$langs=$this->lang->line('langs');
######################
if($lang=='th'){
	$langs_th='ภาษาไทย';
	$langs_en='ภาษาอังกถษ';
}else if($lang=='en'){
	$langs_th='Thai';
	$langs_en='English';
}
if(!isset($breadcrumb)) $breadcrumb = '';
if(!isset($ListSelect)) $ListSelect = null;
#######################
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title><?=$this->lang->line('titleweb');?></title> 

	<?php
	echo css_asset('css/reset.css');
	echo css_asset('css/960.css');
	echo css_asset('css/blitzer/jquery-ui-1.8.10.custom.css');
	echo css_asset('css/text.css');
	echo css_asset('css/site.css');	
	?>
	<script src="<?=base_url()?>js/jquery-1.4.4.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>js/jquery-ui-1.8.10.custom.min.js" type="text/javascript"></script>
</head>  
<body>
<div id="conteiner" class="container_16">
	<div id="header" class="grid_16">
		<p>Header :<?=$this->lang->line('titleweb');?></p>
	</div>
	 
	
		
