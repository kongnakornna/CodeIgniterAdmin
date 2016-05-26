<?php # $this->load->view('hardware/sms_config');?>
 <script src="<?php echo base_url('theme');?>/assets/js/footable.js" type="text/javascript"></script>
<script src="<?php echo base_url('theme');?>/assets/js/footable.filter.js" type="text/javascript"></script>
<script src="<?php echo base_url('theme');?>/assets/js/footable.paginate.js" type="text/javascript"></script>
<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
	$(document).ready(function() {
			
			pageSetUp();

			$('.footable1').footable();

			$('.footable').footable();

				var jsURL_BackupRestore_Action = '<?php echo base_url();?>hwdata/modules/admincontrol/email_config_exec.php';
				$("form#addnew_emailconfig").validate({
				  rules: {
			      emailhost: {
			        required: true
			      },
			      emailport: {
			        required: true
			      },
			      emailusername: {
			        required: true
			      },
			      emailpassword: {
			        required: true
			      },
			      emailstatus: {
			        required: true
			      }
			    },
			    messages: {
			      emailhost: "Please Input your Email Host",
			      emailport: "Please Input your Email Port",
			      emailusername: "Please Input your Email Username",
			      emailpassword: "Please Input your Email Password",
			      emailstatus: "Please Select your Email Status"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_BackupRestore_Action,
				            data ,
				            function(data) {
				               

								/*

				               var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_backup_getdb.php",
					    
									"sDom" : "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
									"fnInitComplete" : function(oSettings, json) {
										$('.ColVis_Button').addClass('btn btn-default btn-sm').html('Columns <i class="icon-arrow-down"></i>');
									}
								});*/
								

				            } // END Function
				        ).done(function( data ) {
				        	var data = $.parseJSON(data);

	        				$.each(data, function(index, value) {
	        					//alert(value);
	        					if(value == "Success"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Save Successful!...</i>",
										color : "#659265",
										iconSmall : "fa fa-check fa-2x fadeInRight animated",
										timeout : 3000
									});
									//$('#alert').hide();

									var reloadUrl = '<?php echo base_url();?>hwdata/modules/admincontrol/emailconfig_reload.php';
									$('#emailconfig_reload').load(reloadUrl, function(){
							    		$(this).css({
											opacity : '0.0'
										}).delay(50).animate({
											opacity : '1.0'
										}, 300);
							    	});
							    	$('#myModal').modal('toggle').fadeOut('slow', 0);

	        					}else if(value == "Error"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Email Host Exist!...</i>",
										color : "#C46A69",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Email Host Exist!...</i>",
										color : "#C46A69",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
	        					}
					    		
	        				});

					  	});
				    },
				highlight: function (element) {
			      $(element).closest('.input,.select').removeClass('state-success').addClass('state-error');
			    },
			    unhighlight: function (element) {
			      $(element).closest('.input,.select').removeClass('state-error').addClass('state-success');
			    },
			    errorElement: 'span',
			    errorClass: 'note',
			    errorPlacement: function (error, element) {
			      if (element.parent('.input-group').length) {
			        error.insertAfter(element.parent());
			      } else {
			        error.insertAfter(element);
			      }
			    }
				});

				$('#myModal').on('hidden.bs.modal', function (e) {
				  $(this)
				    .find("input,textarea,select")
				       .val('')
				       .end();
				}); 

	});
</script>