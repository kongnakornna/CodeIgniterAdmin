<html>
    <head>
        <title>Updater</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex, nofollow" />
	<link href="sample.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
	<style>

		/* Style the CKEditor element to look like a textfield */
		.cke_textarea_inline
		{
			padding: 10px;
			height: 200px;
			overflow: auto;

			border: 1px solid gray;
			-webkit-appearance: textfield;
		}

	</style>
    </head>
<body>
	<table border="1" cellspacing="0" id="outputSample">
		<colgroup><col width="120"></colgroup>
		<thead>
			<tr>
				<th>Field&nbsp;Name</th>
				<th>Value</th>
			</tr>
		</thead>
<?php

if (!empty($_POST))
{
	foreach ( $_POST as $key => $value )
	{
		if ( ( !is_string($value) && !is_numeric($value) ) || !is_string($key) )
			continue;

		if ( get_magic_quotes_gpc() )
			$value = htmlspecialchars( stripslashes((string)$value) );
		else
			$value = htmlspecialchars( (string)$value );
?>
		<tr>
		    <?php $field_post = htmlspecialchars( (string)$key );
			$value_post = $value ; 
			if ($field_post =="textbody"){
             file_put_contents("tester.txt",$value);
			}
			?>
			<th style="vertical-align: top"><?php echo $field_post ; ?></th>
			<td><pre class="samples"><?php echo $value; ?></pre></td>
		</tr>
	<?php
	}
}
?>


<?php
$textcontent = file_get_contents("tester.txt");
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
<textarea class="ckeditor" cols="80" id="editor1" name="textbody" rows="10"  >
<?php
  echo $textcontent;
?>
</textarea>
<script>
CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?Type=Images',
    filebrowserFlashBrowseUrl: '/ckfinder/ckfinder.html?Type=Flash',
    filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});

</script>

<p>
<input name="submit" type="submit" value="Submit">
</p>
</form>

</body>
</html>