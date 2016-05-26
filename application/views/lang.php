<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>

<body>
<?php 
	echo $this->lang->line('hi');
    echo $this->lang->line('lang');
    
    
?>

<p><a href="<?=base_url()?>lang/language/?lang=english&uri=<?php print(uri_string()); ?>" > English</a></p>
<p><a href="<?=base_url()?>lang/language/?lang=thai&uri=<?php print(uri_string()); ?>" > Thai</a></p>
 
</body>
</html>
