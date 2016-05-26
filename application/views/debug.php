<?php

		if (!$this->session->userdata('user_name')) {					
			//redirect('admin/login');
			die();
		}else{
			$userinput = $this->session->userdata('user_name');
		}
		$total_execution_time_start = $this->benchmark->marker['total_execution_time_start'];
		echo "total_execution_time_start = $total_execution_time_start<br>";
		
		if(function_exists('Debug')){
			//Debug($this->db->queries[1]) ;
			//Debug($this->benchmark->marker) ;
			//Debug($this->lang->language) ;
			//Debug($this);
		}
?>

		<!-- bootstrap & fontawesome -->
		<?php echo css_asset('bootstrap.min.css'); ?>
		<?php echo css_asset('font-awesome.min.css'); ?>

		<!-- page specific plugin styles -->
		<?php echo css_asset('jquery-ui.min.css'); ?>

		<!-- text fonts -->
		<?php echo css_asset('ace-fonts.css'); ?>

		<!-- ace styles -->
		<?php echo css_asset('ace.min.css'); ?>
		<link rel="stylesheet" href="theme/assets/css/ace.min.css" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="theme/assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="theme/assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="theme/assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="theme/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="theme/assets/js/ace-extra.min.js"></script>


<div class="row">
									<div class="col-sm-6">
										<h3 class="header blue lighter smaller">
											<i class="ace-icon fa fa-list-alt smaller-90"></i>Dialogs
										</h3>
										<a href="#" id="id-btn-dialog2" class="btn btn-info btn-sm">Confirm Dialog</a>
										<a href="#" id="id-btn-dialog1" class="btn btn-purple btn-sm">Modal Dialog</a>

										<!-- #dialog-message -->
										<div id="dialog-message" class="hide">
											<p>
												This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.
											</p>

											<div class="hr hr-12 hr-double"></div>

											<p>
												Currently using
												<b>36% of your storage space</b>.
											</p>
										</div>
										<!-- #dialog-message -->

										<!-- #dialog-confirm -->
										<div id="dialog-confirm" class="hide">
											<div class="alert alert-info bigger-110">
												These items will be permanently deleted and cannot be recovered.
											</div>

											<div class="space-6"></div>

											<p class="bigger-110 bolder center grey">
												<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i>
												Are you sure?
											</p>
										</div>
										<!-- #dialog-confirm -->

									</div>


									<div class="col-sm-12">
										<!-- #section:elements.tab.position -->
										<div class="tabbable tabs-left">
											<ul id="myTab3" class="nav nav-tabs">
												<li class="active">
													<a href="#home3" data-toggle="tab">
														<i class="pink ace-icon fa fa-tachometer bigger-110"></i>
														ALL
													</a>
												</li>
												<li>
													<a href="#profile" data-toggle="tab">
														<i class="green ace-icon fa fa-user bigger-110"></i>
														Profile
													</a>
												</li>
												<li>
													<a href="#config" data-toggle="tab">
														<i class="green ace-icon fa fa-cog bigger-110"></i>
														Config
													</a>
												</li>
												<li>
													<a href="#queries" data-toggle="tab">
														<i class="red ace-icon fa fa-tasks bigger-110"></i>
														Queries
													</a>
												</li>

												<li>
													<a href="#language" data-toggle="tab">
														<i class="blue ace-icon fa fa-user bigger-110"></i>
														Language
													</a>
												</li>

												<li>
													<a href="#benchmark" data-toggle="tab">
														<i class="ace-icon fa fa-rocket"></i>
														Benchmark
													</a>
												</li>
											</ul>

											<div class="tab-content">
												<div class="tab-pane in active" id="home3">
													<?php Debug($this->form_validation)?>
												</div>

												<div class="tab-pane in active" id="profile">
													<?php Debug($this->session->userdata)?>
												</div>

												<div class="tab-pane in active" id="config">
													<?php Debug($this->config->config)?>
												</div>

												<div class="tab-pane" id="queries">
													<?php 
													Debug($this->db->queries);
													Debug($this->db->query_times)
													?>
												</div>

												<div class="tab-pane" id="language">
													<?php Debug($this->lang->language)?>
												</div>

												<div class="tab-pane" id="benchmark">
													<?php Debug($this->benchmark->marker)?>
												</div>
											</div>
										</div>

										<!-- /section:elements.tab.position -->
									</div><!-- /.col -->

								</div>


		<!-- page specific plugin scripts -->
		<?php echo js_asset('jquery-ui.min.js'); ?>
		<?php echo js_asset('jquery.ui.touch-punch.min.js'); ?>

		<!-- ace scripts -->
		<?php echo js_asset('ace-elements.min.js'); ?>
		<?php echo js_asset('ace.min.js'); ?>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			
				//override dialog's title function to allow for HTML titles
				$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
					_title: function(title) {
						var $title = this.options.title || '&nbsp;'
						if( ("title_html" in this.options) && this.options.title_html == true )
							title.html($title);
						else title.text($title);
					}
				}));
			
				$( "#id-btn-dialog1" ).on('click', function(e) {
					e.preventDefault();
			
					var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
						modal: true,
						title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> jQuery UI Dialog</h4></div>",
						title_html: true,
						buttons: [ 
							{
								text: "Cancel",
								"class" : "btn btn-xs",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							},
							{
								text: "OK",
								"class" : "btn btn-primary btn-xs",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							}
						]
					});
			
					/**
					dialog.data( "uiDialog" )._title = function(title) {
						title.html( this.options.title );
					};
					**/
				});
			
			
				$( "#id-btn-dialog2" ).on('click', function(e) {
					e.preventDefault();
				
					$( "#dialog-confirm" ).removeClass('hide').dialog({
						resizable: false,
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Empty the recycle bin?</h4></div>",
						title_html: true,
						buttons: [
							{
								html: "<i class='ace-icon fa fa-trash-o bigger-110'></i>&nbsp; Delete all items",
								"class" : "btn btn-danger btn-xs",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
							,
							{
								html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Cancel",
								"class" : "btn btn-xs",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
						]
					});
				});
			
			
					
			});
		</script>
