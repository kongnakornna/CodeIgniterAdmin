
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();

			$(document).on("click", ".open-AddCojDialog", function () {
			     var myCojId = $(this).data('id');
			     var myCojId_Code = $(this).data('id-code');
			     var myCojId_List = $(this).data('id-list');
			     var myCojId_Hidden = $(this).data('id-hidden');
			     $(".modal-body #cojcodeedit").val( myCojId_Code );
			     $(".modal-body #cojnameedit").val( myCojId );

			     $.get(
					'modules/data/get_data_sector.php',
					{id:myCojId_List},
					function(data){
						var idget = data;
						$('.modal-body #opx').html(data+' [+]');
					},
					'html'
				);	

			     $(".modal-body #opx").val( myCojId_List );

			     //$(".modal-body #op").prepend("<option selected=selected>"+myCojId_List+"</option>");

			     $(".modal-body #cojedit_id").val( myCojId_Hidden );
			     $(".modal-body #cojnamedel").val( myCojId );
			     $(".modal-body #cojnamedel_id").val( myCojId_Hidden );

			    
			});


			/*
			 * COL ORDER List
			 */
			$('#datatable_col_reorder').dataTable({
				"sPaginationType" : "bootstrap",
				"bProcessing": true,
       			"bServerSide": true,
        		"sAjaxSource": "modules/data/dt_cojs.php",
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
			       	 return '<button class="open-AddCojDialog btn btn-primary btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddCojDialog btn btn-danger btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
				var jsURL_coj_Add = 'modules/data/coj_add.php';
				$("form#newcojform").validate({
				  rules: {
			      cojcode: {
			        required: true
			      },
			      cojname: {
			        required: true
			      },
			      sectorid: {
			        required: true
			      }
			    },
			    messages: {
			      cojcode: "Please specify your COJ Code",
			      cojname: "Please specify your COJ Name",
			      sectorid: "Please specify your Sector Name"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_coj_Add,
				            data ,
				            function(data) {
				               // top.location.reload();
				               var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_cojs.php",
					    			 
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 4 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddCojDialog btn btn-primary btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddCojDialog btn btn-danger btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
										content : "<i class='fa fa-clock-o'></i> <i>COJ Name Exist...</i>",
										color : "#C46A69",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Add New COJ Successful...</i>",
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
				var jsURL_sector_Edit = 'modules/data/coj_edit.php';
				$("form#cojformedit").validate({
				  rules: {
			      cojcode: {
			        required: true
			      },
			      cojname: {
			        required: true
			      },
			      sectorid: {
			        required: true
			      }
			    },
			    messages: {
			      cojcode: "Please specify your COJ Code",
			      cojname: "Please specify your COJ Name",
			      sectorid: "Please specify your Sector Name"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_sector_Edit,
				            data ,
				            function(data) {
								var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_cojs.php",
					    
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 4 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddCojDialog btn btn-primary btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddCojDialog btn btn-danger btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
										content : "<i class='fa fa-clock-o'></i> <i>Not Edit COJ Data...</i>",
										color : "#3276b1",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
									$('#myModalEdit').modal('toggle').fadeOut('slow', 0);
	
	        					}else if(value == "COJ Code Exist Not Edit Data"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>COJ Code Exist Not Edit Data...</i>",
										color : "#3276b1",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
									$('#myModalEdit').modal('toggle').fadeOut('slow', 0);
	
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Edit COJ Successful...</i>",
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
				var jsURL_coj_Del = 'modules/data/coj_del.php';
				$("form#cojformdel").validate({
				  rules: {
			      cojnamedel: {
			        required: true
			      }
			    },
			    messages: {
			      cojnamedel: "Please specify your COJ Name"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        $.post(jsURL_coj_Del,
				            data ,
				            function(data) {
								var table_edit = $('#datatable_col_reorder').dataTable();
								table_edit.fnDestroy();
								$('#datatable_col_reorder').dataTable({
									"sPaginationType" : "bootstrap",
									"bProcessing": true,
					       			"bServerSide": true,
					        		"sAjaxSource": "modules/data/dt_cojs.php",
					    
									"aoColumnDefs": [ {
									  "bSortable": false,
								      "aTargets": [ 4 ],
								      "mData": function (data) {
								       	 return '<button class="open-AddCojDialog btn btn-primary btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Edit</button> <button class="open-AddCojDialog btn btn-danger btn-xs" data-id-list="'+data[3]+'" data-id-code="'+data[1]+'" data-id="'+data[2]+'" data-id-hidden="'+data[0]+'" data-toggle="modal" data-target="#myModalDel"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp; Delete</button>';
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
										content : "<i class='fa fa-clock-o'></i> <i>Delete COJ Successful...</i>",
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
