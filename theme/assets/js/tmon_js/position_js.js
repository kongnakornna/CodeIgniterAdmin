
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();

			$(document).on("click", ".open-AddPositionDialog", function () {
			     var myPositionId = $(this).data('id');
			     var myPositionId_Hidden = $(this).data('id-hidden');
			     $(".modal-body #positionnameedit").val( myPositionId );
			     $(".modal-body #positionedit_id").val( myPositionId_Hidden );
			     $(".modal-body #positionnamedel").val( myPositionId );
			     $(".modal-body #positionnamedel_id").val( myPositionId_Hidden );
			});

			/*
			 * COL ORDER List
			 */
			$('#datatable_col_reorder').dataTable({
				"sPaginationType" : "bootstrap",
				"bProcessing": true,
       			"bServerSide": true,
        		"sAjaxSource": "modules/data/dt_positions.php",
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
			      	//alert(data[0]+data[1]+data[2]);
			       	 return '<button class="open-AddPositionDialog btn btn-primary btn-xs"  data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddPositionDialog btn btn-danger btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
				var jsURL_position_Add = 'modules/data/position_add.php';
				$("form#newpositionform").validate({
				  rules: {
			      positionname: {
			        required: true
			      }
			    },
			    messages: {
			      positionname: "Please specify your Position Name"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_position_Add,
				            data ,
				            function(data) {
				               // top.location.reload();
				               var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_positions.php",
					    
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 2 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddPositionDialog btn btn-primary btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddPositionDialog btn btn-danger btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
	        					
	        					if(value == "Error Name"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Position Name Exist...</i>",
										color : "#C46A69",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Add New Position Successful...</i>",
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
				var jsURL_position_Edit = 'modules/data/position_edit.php';
				$("form#positionformedit").validate({
				  rules: {
			      positionnameedit: {
			        required: true
			      }
			    },
			    messages: {
			      positionnameedit: "Please specify your Position Name"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_position_Edit,
				            data ,
				            function(data) {
								var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_positions.php",
					    
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 2 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddPositionDialog btn btn-primary btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddPositionDialog btn btn-danger btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
										content : "<i class='fa fa-clock-o'></i> <i>Not Edit Position Data...</i>",
										color : "#3276b1",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
									$('#myModalEdit').modal('toggle').fadeOut('slow', 0);
	        					}else if(value == "Position Exist Not Edit Data"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Position Exist Not Edit Data...</i>",
										color : "#C46A69",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
									//$('#myModalEdit').modal('toggle').fadeOut('slow', 0);
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Edit Position Successful...</i>",
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
				var jsURL_Position_Del = 'modules/data/position_del.php';
				$("form#positionformdel").validate({
				  rules: {
			      positionnamedel: {
			        required: true
			      }
			    },
			    messages: {
			      positionnamedel: "Please specify your Position"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_Position_Del,
				            data ,
				            function(data) {
								var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_positions.php",
					    
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 2 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddPositionDialog btn btn-primary btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddPositionDialog btn btn-danger btn-xs" data-id="'+data[1]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
										content : "<i class='fa fa-clock-o'></i> <i>Delete Position Successful...</i>",
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
