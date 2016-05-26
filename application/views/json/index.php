<?php 
		$language = $this->lang->language; 
		$i=0;
		$gen_url = base_url('json/gen_nav');
?>
<div class="col-xs-12">

					<div class="page-content-area">
						<div class="page-header">
							<h1> JSON
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
											//Debug(json_decode($news_th));
									?>
									<div class="col-sm-6">
										<div class="widget-box widget-color-blue2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">Navigation</h4><a href="<?php echo $gen_url ?>">
												<span class="btn btn-success tooltip-success" style="float:right" data-rel="tooltip" title="" data-original-title="Generate" data-placement="top">Generate</span></a>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/navigation/navigation_en.json'))
															echo '<a href="'.base_url('json/www/navigation/navigation_en.json').'" target=_blank>navigation_en.json</a>';

														$my_URL = base_url('json/www/navigation/navigation_en.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>

													<div class="clearfix">
														<?php
														if(file_exists('./json/www/navigation/navigation_th.json'))
															echo '<a href="'.base_url('json/www/navigation/navigation_th.json').'" target=_blank>navigation_th.json</a>';
														$my_URL = base_url('json/www/navigation/navigation_th.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>
													
												</div>
											</div>
										</div>
									</div>


									<?php $gen_url = base_url('json/gen_highlight'); ?>
									<div class="col-sm-6">
										<div class="widget-box widget-color-blue2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller"><?php echo $language['highlight'] ?></h4><a href="<?php echo $gen_url ?>">
												<span class="btn btn-success tooltip-success" style="float:right" data-rel="tooltip" title="" data-original-title="Generate" data-placement="top">Generate</span></a>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/highlight/highlight_en.json'))
															echo '<a href="'.base_url('json/www/highlight/highlight_en.json').'" target=_blank>highlight_en.json</a>';
														$my_URL = base_url('json/www/highlight/highlight_en.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/highlight/highlight_th.json'))
															echo '<a href="'.base_url('json/www/highlight/highlight_th.json').'" target=_blank>highlight_th.json</a>';
														$my_URL = base_url('json/www/highlight/highlight_th.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>
													
												</div>
											</div>
										</div>
									</div>

									<?php $gen_url = base_url('json/gen_category'); ?>
									<div class="col-sm-6">
										<div class="widget-box widget-color-blue2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">Category</h4><a href="<?php echo $gen_url ?>">
												<span class="btn btn-success tooltip-success" style="float:right" data-rel="tooltip" title="" data-original-title="Generate" data-placement="top">Generate</span></a>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/category/category_en.json'))
															echo '<a href="'.base_url('json/www/category/category_en.json').'" target=_blank>category_en.json</a>';
														$my_URL = base_url('json/www/category/category_en.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/category/category_th.json'))
															echo '<a href="'.base_url('json/www/category/category_th.json').'" target=_blank>category_th.json</a>';
														$my_URL = base_url('json/www/category/category_th.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>
													
												</div>
											</div>
										</div>
									</div>

									<?php $gen_url = base_url('json/gen_subcategory'); ?>
									<div class="col-sm-6">
										<div class="widget-box widget-color-blue2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">Sub Category</h4><a href="<?php echo $gen_url ?>">
												<span class="btn btn-success tooltip-success" style="float:right" data-rel="tooltip" title="" data-original-title="Generate" data-placement="top">Generate</span></a>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/category/subcategory_en.json'))
															echo '<a href="'.base_url('json/www/category/subcategory_en.json').'" target=_blank>subcategory_en.json</a>';
														$my_URL = base_url('json/www/category/subcategory_en.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/category/subcategory_th.json'))
															echo '<a href="'.base_url('json/www/category/subcategory_th.json').'" target=_blank>subcategory_th.json</a>';
														$my_URL = base_url('json/www/category/subcategory_th.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>
													
												</div>
											</div>
										</div>
									</div>


									<?php $gen_url = base_url('json/gen_dara'); ?>
									<div class="col-sm-6">
										<div class="widget-box widget-color-blue2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller"><?php echo $language['dara'] ?></h4><a href="<?php echo $gen_url ?>">
												<span class="btn btn-success tooltip-success" style="float:right" data-rel="tooltip" title="" data-original-title="Generate" data-placement="top">Generate</span></a>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/dara/dara.json'))
															echo '<a href="'.base_url('json/www/dara/dara.json').'" target=_blank>dara.json</a>';
														$my_URL = base_url('json/www/dara/dara.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>
													<div class="clearfix">&nbsp;
													</div>
													
												</div>
											</div>
										</div>
									</div>

									<?php $gen_url = base_url('json/gen_news'); ?>
									<div class="col-sm-6">
										<div class="widget-box widget-color-blue2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller"><?php echo $language['news'] ?></h4><a href="<?php echo $gen_url ?>">
												<span class="btn btn-success tooltip-success" style="float:right" data-rel="tooltip" title="" data-original-title="Generate" data-placement="top">Generate</span></a>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/news/news_en.json'))
															echo '<a href="'.base_url('json/www/news/news_en.json').'" target=_blank>news_en.json</a>';
														$my_URL = base_url('json/www/news/news_en.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/news/news_th.json'))
															echo '<a href="'.base_url('json/www/news/news_th.json').'" target=_blank>news_th.json</a>';
														$my_URL = base_url('json/www/news/news_th.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>
													
												</div>
											</div>
										</div>
									</div>

									<?php $gen_url = base_url('json/gen_column'); ?>
									<div class="col-sm-6">
										<div class="widget-box widget-color-blue2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller"><?php echo $language['column'] ?></h4><a href="<?php echo $gen_url ?>">
												<span class="btn btn-success tooltip-success" style="float:right" data-rel="tooltip" title="" data-original-title="Generate" data-placement="top">Generate</span></a>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/column/column_en.json'))
															echo '<a href="'.base_url('json/www/column/column_en.json').'" target=_blank>column_en.json</a>';
														$my_URL = base_url('json/www/column/column_en.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/column/column_th.json'))
															echo '<a href="'.base_url('json/www/column/column_th.json').'" target=_blank>column_th.json</a>';
														$my_URL = base_url('json/www/column/column_th.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>
													
												</div>
											</div>
										</div>
									</div>

									<?php $gen_url = base_url('json/gen_gallery'); ?>
									<div class="col-sm-6">
										<div class="widget-box widget-color-blue2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller"><?php echo $language['gallery'] ?></h4><a href="<?php echo $gen_url ?>">
												<span class="btn btn-success tooltip-success" style="float:right" data-rel="tooltip" title="" data-original-title="Generate" data-placement="top">Generate</span></a>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/gallery/gallery_en.json'))
															echo '<a href="'.base_url('json/www/gallery/gallery_en.json').'" target=_blank>gallery_en.json</a>';
														$my_URL = base_url('json/www/gallery/gallery_en.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>

													<div class="clearfix">
														<?php 
														if(file_exists('./json/www/gallery/gallery_th.json'))
															echo '<a href="'.base_url('json/www/gallery/gallery_th.json').'" target=_blank>gallery_th.json</a>';
														$my_URL = base_url('json/www/gallery/gallery_th.json');
														?>
														<a href="<?php echo base_url('json/view?url='.urlencode($my_URL)); ?>"><span style="float:right;" class="">View</span></a>
													</div>
													
												</div>
											</div>
										</div>
									</div>


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