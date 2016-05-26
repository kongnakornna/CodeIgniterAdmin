<?php 
		$language = $this->lang->language; 
		$i=0;
		//$gen_url = base_url('json/gen_nav');
		//Debug($news_th);
?>
<div class="col-xs-12">

					<div class="page-content-area">
						<div class="page-header">
							<h1> <?php echo $language['generate_catch']; ?>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<!-- (single &amp; multiple) --><?php echo $this->config->config['www']; ?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-2">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
										<span id="gen_www" class="btn btn-success tooltip-success" style="float:right" data-rel="tooltip" title="" data-original-title="Generate" data-placement="top"><?php echo $language['generate_catch']; ?></span>
								</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->

							<div class="col-xs-12">
								<div class="row" id="preview_data">
								</div>
							</div><!-- /.col -->

						</div><!-- /.row -->
					</div><!-- /.page-content-area -->

</div><!-- /.col -->

<!-- page specific plugin scripts -->
<?php 
	echo js_asset('fuelux/data/fuelux.tree-sample-demo-data.js'); 
	echo js_asset('fuelux/fuelux.tree.min.js'); 
	//echo js_asset('checkall.js'); 
?>
<link rel="stylesheet" href="../assets/css/ace.onpage-help.css" />

<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($){

		//$('[data-rel=tooltip]').tooltip();
		//$('[data-rel=popover]').popover({html:true});
		$('#gen_www').click(function(){
				WaitingAlert('<?php echo $language['waiting_for_generate']; ?>');
				Gen_API();

		});
});

function Gen_API(){
			Gen_megamenu();
}

function Gen_megamenu(){
			//Gen API Mega Menu
			$.getJSON( "<?php echo $megamenu ?>", function( data ) {
					//alert(data.header.resultcode);
					//Waiting('<?php echo $language['waiting_for_generate']; ?>');
					$('#preview_data').html('<?php echo $language['waiting_for_generate']; ?>');

					if(data.header.resultcode == 200){

							//AlertSuccess	('Generate Mega Menu success.');
							$('#preview_data').html('<div class="col-xs-12"><?php echo $language['generate_catch']; ?> <small><i class="ace-icon fa fa-angle-double-right"></i> <b>Mega Menu</b> success.</small></div>');
							Gen_ListCategories();
					}else{

							//AlertError('Can not generate API Mega Menu.');
							$('#preview_data').html('<div class="col-xs-12">Can not generate API Mega Menu</div>');

					}
			});	
}

function Gen_ListCategories(){
			//Gen API ListCategories
			$.getJSON( "<?php echo $ListCategories ?>", function( data ) {
					//alert(data);
					if(data.header.resultcode == 200){
							//AlertSuccess	('Generate Mega Menu success.');
							$('#preview_data').append('<div class="col-xs-12"><?php echo $language['generate_catch']; ?> <small><i class="ace-icon fa fa-angle-double-right"></i> <b>list categories</b> success.</small></div>');
							Gen_ChannelTV();
					}else{
							//AlertError('Can not generate API Mega Menu.');
							$('#preview_data').append('<div class="col-xs-12">Can not generate list categories</div>');
					}
			});	
}

function Gen_ChannelTV(){
			//Gen API ChannelTV
			$.getJSON( "<?php echo $ChannelTV ?>", function( data ) {
					//alert(data);
					if(data.header.resultcode == 200){
							//AlertSuccess	('Generate Mega Menu success.');
							$('#preview_data').append('<div class="col-xs-12"><?php echo $language['generate_catch']; ?> <small><i class="ace-icon fa fa-angle-double-right"></i> <b>Channel TV</b> success.</small></div>');
							Gen_API_Category();
							Gen_www();
					}else{
							//AlertError('Can not generate API Mega Menu.');
							$('#preview_data').append('<div class="col-xs-12">Can not generate Channel TV</div>');
					}
			});	
}

function Gen_API_Category(){
<?php

		if($cat)
			for($i=0;$i<count($cat);$i++){
?>
			$.getJSON( "<?php echo $cat[$i] ?>", function( data ) {
					if(data.header.resultcode == 200){
							//AlertSuccess	('Generate Mega Menu success.');
							$('#preview_data').append('<div class="col-xs-12"><?php echo $language['generate_catch']; ?> <small><i class="ace-icon fa fa-angle-double-right"></i> <b><?php echo $cattitle[$i] ?></b> success.</small></div>');
					}else{
							//AlertError('Can not generate API Mega Menu.');
							$('#preview_data').append('<div class="col-xs-12">Can not generate <?php echo $cattitle[$i] ?></div>');
					}
			});	
<?php	
			}

?>
}

function Gen_www(){

			//Gen Home Page
			$.getJSON( "<?php echo $home ?>", function( rsponse ) {
					if(rsponse.meta.code == 200){
							AlertSuccess	('Generate success.');
							$('#preview_data').append('<div class="col-xs-12"><?php echo $language['generate_catch']; ?> <small><i class="ace-icon fa fa-angle-double-right"></i> <b><?php echo $this->config->config['www']; ?></b> success.</small></div>');
					}else{
							AlertError('Can not generate <?php echo $this->config->config['www']; ?>');
							$('#preview_data').append('<div class="col-xs-12">Can not generate <?php echo $this->config->config['www']; ?></div>');
					}
			});	

}
</script>