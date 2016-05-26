<?php 
		$language = $this->lang->language; 
		$i=0;
		$gen_url = base_url('json/gen_nav');
?>
<div class="col-xs-12">

								<!-- <button class="btn btn-sm btn-primary" onclick="window.location='<?php //echo site_url('tags/add') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php //echo $language['add'].' '.$language['tags']  ?>
								</button> -->

					<div class="page-content-area">
						<div class="page-header">
							<h1>
								JSON
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<!-- (single &amp; multiple) -->content
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<!-- #section:plugins/fuelux.treeview -->
								<div class="row">
									<?php
											//Debug(json_decode($navigation_th));
									?>
									<div class="col-sm-6">
										<div class="widget-box widget-color-blue2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">Navigation</h4><a href="<?php echo $gen_url ?>">
												<span class="btn btn-success tooltip-success" style="float:right" data-rel="tooltip" title="" data-original-title="Generate" data-placement="right">Generate</span></a>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">

													<div class="clearfix">
														<?php echo '<a href="'.base_url('json/www/navigation/navigation_en.json').'" target=_blank>navigation_en.json</a>';?>
														
													</div>

													<div class="clearfix">
														<?php echo '<a href="'.base_url('json/www/navigation/navigation_th.json').'" target=_blank>navigation_th.json</a>';?>
													</div>
													
												</div>
											</div>
										</div>
									</div>

									<!-- <span class="btn btn-success btn-sm popover-success" data-rel="popover" data-placement="right" title="<i class='ace-icon fa fa-check green'></i> Right Success" data-content="Well done! You successfully read this important alert message.">Right</span>

									<span class="btn btn-success btn-sm tooltip-success" data-rel="tooltip" data-placement="right" title="Right Success">Right</span>

									<span class="btn btn-danger btn-sm popover-error" data-rel="popover" data-placement="top" data-original-title="<i class='ace-icon fa fa-bolt red'></i> Top Danger" data-content="Oh snap! Change a few things up and try submitting again.">Top</span> -->

									<!-- <div class="col-sm-6">
										<h3 class="row header smaller lighter orange">
											<span class="col-sm-8">
												<i class="ace-icon fa fa-bell"></i>
												Gritter Notifications
											</span>

											<span class="col-sm-4">
												<label class="pull-right inline">
													<small class="muted">Dark:</small>

													<input id="gritter-light" checked="" type="checkbox" class="ace ace-switch ace-switch-5">
													<span class="lbl middle"></span>
												</label>
											</span>
										</h3>

										<p>
											<i>Click to see</i>
										</p>

										<p>
											<button class="btn" id="gritter-regular">Regular</button>
											<button class="btn btn-info" id="gritter-sticky">Sticky</button>
											<button class="btn btn-success" id="gritter-without-image">Without Image</button>
										</p>

										<p>
											<button class="btn btn-danger" id="gritter-error">Error</button>
											<button class="btn btn-warning" id="gritter-max3">Max 3</button>
											<button class="btn btn-primary" id="gritter-center">Center</button>
											<button class="btn btn-inverse" id="gritter-remove">Remove</button>
										</p>
									</div> -->


									<!-- <div class="col-sm-6">
										<div class="widget-box widget-color-blue2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">Choose Categories</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
													<div id="tree1" class="tree"></div>
												</div>
											</div>
										</div>
									</div> -->

									<!-- <div class="col-sm-6">
										<div class="widget-box widget-color-green2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">Browse Files</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
													<div id="tree2" class="tree"></div>
												</div>
											</div>
										</div>
									</div> -->

								</div>

								<!-- /section:plugins/fuelux.treeview -->
								<script type="text/javascript">
									var $assets = "../assets";//this will be used in fuelux.tree-sampledata.js
								</script>

								<!-- PAGE CONTENT ENDS -->
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

			$('[data-rel=tooltip]').tooltip();
			$('[data-rel=popover]').popover({html:true});

		/*$('#tree1').ace_tree({

			dataSource: treeDataSource ,
			multiSelect:true,
			loadingHTML:'<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
			'open-icon' : 'ace-icon tree-minus',
			'close-icon' : 'ace-icon tree-plus',
			'selectable' : true,
			'selected-icon' : 'ace-icon fa fa-check',
			'unselected-icon' : 'ace-icon fa fa-times'
		});*/

		$('#tree2').ace_tree({
			dataSource: treeDataSource2 ,
			loadingHTML:'<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
			'open-icon' : 'ace-icon fa fa-folder-open',
			'close-icon' : 'ace-icon fa fa-folder',
			'selectable' : false,
			'selected-icon' : null,
			'unselected-icon' : null
		});
		
		
		$('#tree1')
		.on('updated', function(e, result) {
			//result.info  >> an array containing selected items
			//result.item
			//result.eventType >> (selected or unselected)
		})
		.on('selected', function(e) {
		})
		.on('unselected', function(e) {
		})
		.on('opened', function(e) {
		})
		.on('closed', function(e) {
		});



		/**
		$('#tree1').on('loaded', function (evt, data) {
		});

		$('#tree1').on('opened', function (evt, data) {
		});

		$('#tree1').on('closed', function (evt, data) {
		});

		$('#tree1').on('selected', function (evt, data) {
		});
		*/


$('#gritter-regular').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a regular notice!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="blue">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets+'/avatars/avatar1.png',
						sticky: false,
						time: '',
						class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
					});
			
					return false;
				});
			
				$('#gritter-sticky').on(ace.click_event, function(){
					var unique_id = $.gritter.add({
						title: 'This is a sticky notice!',
						text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="red">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets+'/avatars/avatar.png',
						sticky: true,
						time: '',
						class_name: 'gritter-info' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-without-image').on(ace.click_event, function(){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: 'This is a notice without an image!',
						// (string | mandatory) the text inside the notification
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="orange">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						class_name: 'gritter-success' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-max3').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a notice with a max of 3 on screen at one time!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="green">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets+'/avatars/avatar3.png',
						sticky: false,
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						class_name: 'gritter-warning' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-center').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a centered notification',
						text: 'Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-info gritter-center' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
				
				$('#gritter-error').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a warning notification',
						text: 'Just add a "gritter-light" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-error' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
					
			
				$("#gritter-remove").on(ace.click_event, function(){
					$.gritter.removeAll();
					return false;
				});
});
</script>