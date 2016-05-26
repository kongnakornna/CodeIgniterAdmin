
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();

			$(document).on("click", ".open-AddPrivilegeDialog", function () {
			     var myPrivilegeId = $(this).data('id');
			     var myPrivilegeId_Hidden = $(this).data('id-hidden');
			     $(".modal-body #levelnameedit").val( myPrivilegeId );
			     $(".modal-body #levelnameedit_id").val( myPrivilegeId_Hidden );
			     $(".modal-body #levelnamedel").val( myPrivilegeId );
			     $(".modal-body #levelnamedel_id").val( myPrivilegeId_Hidden );
			});

			/*
			 * COL ORDER List
			 */
			$('#datatable_col_reorder').dataTable({
				"sPaginationType" : "bootstrap",
				"bProcessing": true,
       			"bServerSide": true,
        		"sAjaxSource": "modules/data/dt_privilege_user.php",
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
			      "aTargets": [ 2 ],
			      "mData": function (data) {
			       	 return '<button class="open-AddPrivilegeDialog btn btn-primary btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddPrivilegeDialog btn btn-danger btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
				var jsURL_privilege_Add = 'modules/data/privilege_add.php';
				$("form#newprivilegeform").validate({
				  rules: {
			      levelname: {
			        required: true
			      }
			    },
			    messages: {
			      levelname: "Please specify your Privilege"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_privilege_Add,
				            data ,
				            function(data) {
				               // top.location.reload();
				               var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_privilege_user.php",
					    
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 2 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddPrivilegeDialog btn btn-primary btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddPrivilegeDialog btn btn-danger btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
	        					if(value == "Success"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Add New Privilege Successful...</i>",
										color : "#659265",
										iconSmall : "fa fa-check fa-2x fadeInRight animated",
										timeout : 3000
									});
									$('#myModal').modal('toggle').fadeOut('slow', 0);
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Privilege Exist...</i>",
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
				/* ------ Add New ------  */

				/* ------ Add Edit ------  */
				var jsURL_privilege_Edit = 'modules/data/privilege_edit.php';
				$("form#newprivilegeformedit").validate({
				  rules: {
			      levelnameedit: {
			        required: true
			      }
			    },
			    messages: {
			      levelnameedit: "Please specify your Privilege"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_privilege_Edit,
				            data ,
				            function(data) {
								var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_privilege_user.php",
					    
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 2 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddPrivilegeDialog btn btn-primary btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddPrivilegeDialog btn btn-danger btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
										content : "<i class='fa fa-clock-o'></i> <i>Not Edit Privilege Data...</i>",
										color : "#3276b1",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
									$('#myModalEdit').modal('toggle').fadeOut('slow', 0);
	        					}else if(value == "Privilege Exist Not Edit Data"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Privilege Exist Not Edit Data...</i>",
										color : "#C46A69",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
									//$('#myModalEdit').modal('toggle').fadeOut('slow', 0);
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Edit Privilege Successful...</i>",
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
				var jsURL_privilege_Del = 'modules/data/privilege_del.php';
				$("form#newprivilegeformdel").validate({
				  rules: {
			      levelnamedel: {
			        required: true
			      }
			    },
			    messages: {
			      levelnamedel: "Please specify your Privilege"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_privilege_Del,
				            data ,
				            function(data) {
								var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_privilege_user.php",
					    
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 2 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddPrivilegeDialog btn btn-primary btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddPrivilegeDialog btn btn-danger btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
										content : "<i class='fa fa-clock-o'></i> <i>Delete Privilege Successful...</i>",
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
