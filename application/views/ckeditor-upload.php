<html>
<head>
	<title>ckeditor-upload</title>
	<meta charset="utf-8">
</head>
<body>
	<script src="<?php echo base_url('theme/assets/ckeditor-upload/ckeditor.js'); ?>"></script>


		<!-- Sample 1 -->
		<textarea cols="80" id="txtDescription1" name="txtDescription1" rows="10">
				ckeditor-upload
		</textarea>

		<script>

			CKEDITOR.replace( 'txtDescription1');

		</script>
		<br>

		<!-- Sample 2 -->
		<textarea cols="80" id="txtDescription2" name="txtDescription2" rows="10">
				ckeditor-upload
		</textarea>
		<script>

			CKEDITOR.replace( 'txtDescription2', {
				toolbar: [
					{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
					[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', 'Image' ],			// Defines toolbar group without name.
					'/',																					// Line break - next group will be placed in new line.
					{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
				]
			});

		</script>

</body>
</html>
