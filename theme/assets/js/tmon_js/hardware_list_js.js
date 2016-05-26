
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();

			$(document).on("click", ".open-AddHWDialog", function () {
			     var myHwId = $(this).data('id');
			     var myHw_Code = $(this).data('id-code');
			     var myHw_List = $(this).data('id-list');
			     var myHw_Hidden = $(this).data('id-hidden');
			     $(".modal-body #hwcodeedit").val( myHw_Code );
			     $(".modal-body #hwnameedit").val( myHwId );

			     $.get(
					'modules/data/get_data_hw_type.php',
					{id:myHw_List},
					function(data){
						var idget = data;
						$('.modal-body #opx').html(data+' [+]');
					},
					'html'
				);	

			     $(".modal-body #opx").val( myHw_List );

			     //$(".modal-body #op").prepend("<option selected=selected>"+myCojId_List+"</option>");

			     $(".modal-body #hwedit_id").val( myHw_Hidden );
			     $(".modal-body #hwnamedel").val( myHwId );
			     $(".modal-body #hwnamedel_id").val( myHw_Hidden );

			    
			});


			/*
			 * COL ORDER List
			 */
			$('#datatable_col_reorder').dataTable({
				"sPaginationType" : "bootstrap",
				"bProcessing": true,
       			"bServerSide": true,
        		"sAjaxSource": "modules/data/dt_hardware_list.php",
        		//"sScrollY": 200,
        		//"sScrollX": "100%",
        		/* "aoColumns" : [
			      { "sWidth": "7%"},
			      null,
			      null
			    ], */
				"aoColumnDefs": [
				{
				  "bSortable": false,
			      "aTargets": [ 4 ],
			      "mData": function (data) {
			      	//alert(data[0]+data[1]+data[2]);
			       	 return '<button class="open-AddHWDialog btn btn-primary btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddHWDialog btn btn-danger btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
			      }
			    }
			    ],

				"sDom" : "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
				"fnInitComplete" : function(oSettings, json) {
					$('.ColVis_Button').addClass('btn btn-default btn-sm').html('Columns <i class="icon-arrow-down"></i>');
				}
			});
			
			/* END COL ORDER */

			/* ------ Add New ------  */
				var jsURL_HWL_Add = 'modules/data/hwl_add.php';
				$("form#newhwform").validate({
				  rules: {
			      hwlcode: {
			        required: true
			      },
			      hwlname: {
			        required: true
			      },
			      hwl_typeid: {
			        required: true
			      }
			    },
			    messages: {
			      hwlcode: "Please specify your Hardware Code",
			      hwlname: "Please specify your Hardware Name",
			      hwl_typeid: "Please specify your Hardware Type Name"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_HWL_Add,
				            data ,
				            function(data) {
				               // top.location.reload();
				               var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_hardware_list.php",
					    			 
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 4 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddHWDialog btn btn-primary btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddHWDialog btn btn-danger btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
								      }
								    } ],

									"sDom" : "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
									"fnInitComplete" : function(oSettings, json) {
										$('.ColVis_Button').addClass('btn btn-default btn-sm').html('Columns <i class="icon-arrow-down"></i>');
									}
								});

				            } // END Function
				        ).done(function( data ) {
				        	var data = $.parseJSON(data);

	        				$.each(data, function(index, value) {
	        					//alert(value);
	        					
	        					if(value == "Error Code"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Hardware Code Exist...</i>",
										color : "#C46A69",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Add New Hardware Successful...</i>",
										color : "#659265",
										iconSmall : "fa fa-check fa-2x fadeInRight animated",
										timeout : 3000
									});
									$('#myModal').modal('toggle').fadeOut('slow', 0);
	        					} 

	        				});

					  	});
				    },
				highlight: function (element) {
			      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			    },
			    unhighlight: function (element) {
			      $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			    },
			    errorElement: 'span',
			    errorClass: 'help-block',
			    errorPlacement: function (error, element) {
			      if (element.parent('.input-group').length) {
			        error.insertAfter(element.parent());
			      } else {
			        error.insertAfter(element);
			      }
			    }
				});
				/* ------ Add New ------  */

				/* ------ Add Edit ------  */
				var jsURL_hwl_Edit = 'modules/data/hwl_edit.php';
				$("form#hwformedit").validate({
				  rules: {
			      hwcodeedit: {
			        required: true
			      },
			      hwnameedit: {
			        required: true
			      },
			      hw_nameedit: {
			        required: true
			      }
			    },
			    messages: {
			      hwcodeedit: "Please specify your Hardware Code",
			      hwnameedit: "Please specify your Hardware Name",
			      hw_nameedit: "Please specify your Hardware Type Name"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_hwl_Edit,
				            data ,
				            function(data) {
								var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_hardware_list.php",

									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 4 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddHWDialog btn btn-primary btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddHWDialog btn btn-danger btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
								      }
								    } ],

									"sDom" : "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
									"fnInitComplete" : function(oSettings, json) {
										$('.ColVis_Button').addClass('btn btn-default btn-sm').html('Columns <i class="icon-arrow-down"></i>');
									}
								});

				            } // End Function
				        ).done(function( data ) {
				        	var data = $.parseJSON(data);
	        				$.each(data, function(index, value) {

	        					if(value == "Not Edit Data"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Not Edit Hardware Data...</i>",
										color : "#3276b1",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
									$('#myModalEdit').modal('toggle').fadeOut('slow', 0);
	
	        					}else if(value == "Hardware Code Exist Not Edit Data"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Hardware Code Exist Not Edit Data...</i>",
										color : "#3276b1",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
									$('#myModalEdit').modal('toggle').fadeOut('slow', 0);
	
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Edit Hardware Successful...</i>",
										color : "#659265",
										iconSmall : "fa fa-check fa-2x fadeInRight animated",
										timeout : 3000
									});
									$('#myModalEdit').modal('toggle').fadeOut('slow', 0);
	        					}

	        				
					    		
	        				});
					        

					  	});

				    },
				highlight: function (element) {
			      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			    },
			    unhighlight: function (element) {
			      $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			    },
			    errorElement: 'span',
			    errorClass: 'help-block',
			    errorPlacement: function (error, element) {
			      if (element.parent('.input-group').length) {
			        error.insertAfter(element.parent());
			      } else {
			        error.insertAfter(element);
			      }
			    }
				});
				/* ------ Add Edit ------  */

				/* ------ Delete Reccord ------  */
				var jsURL_HW_Del = 'modules/data/hwl_del.php';
				$("form#hwformdel").validate({
				  rules: {
			      hwnamedel: {
			        required: true
			      }
			    },
			    messages: {
			      hwnamedel: "Please specify your Hardware Name"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_HW_Del,
				            data ,
				            function(data) {
								var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_hardware_list.php",
					    
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 4 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddHWDialog btn btn-primary btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddHWDialog btn btn-danger btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
								      }
								    } ],

									"sDom" : "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
									"fnInitComplete" : function(oSettings, json) {
										$('.ColVis_Button').addClass('btn btn-default btn-sm').html('Columns <i class="icon-arrow-down"></i>');
									}
								});
				            } // End Function
				        ).done(function( data ) {
				        	var data = $.parseJSON(data);
	        				$.each(data, function(index, value) {
	        					if(value == "Success"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Delete Hardware Successful...</i>",
										color : "#659265",
										iconSmall : "fa fa-check fa-2x fadeInRight animated",
										timeout : 3000
									});
									$('#myModalDel').modal('toggle').fadeOut('slow', 0);
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Unknow Error...</i>",
										color : "#C46A69",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
	        					}
					    		
	        				});
					        

					  	});

				    },
				highlight: function (element) {
			      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			    },
			    unhighlight: function (element) {
			      $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			    },
			    errorElement: 'span',
			    errorClass: 'help-block',
			    errorPlacement: function (error, element) {
			      if (element.parent('.input-group').length) {
			        error.insertAfter(element.parent());
			      } else {
			        error.insertAfter(element);
			      }
			    }
				});
				/* ------ Delete Reccord ------  */


				/* ------ Reset Input When Close Modal------  */
				$('#myModal').on('hidden.bs.modal', function (e) {
				  //$(this).data('#newuserform', null);
				  $(this)
				    .find("input,textarea,select")
				       .val('')
				       .end()
				    .find("input[type=checkbox], input[type=radio]")
				       .prop("checked", "")
				       .end();
				});
				/* ------ Reset Input When Close Modal------  */

		});
