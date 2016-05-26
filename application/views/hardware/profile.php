<?php # $this->load->view('hardware/profile');?> 
<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();

	$("#userinfozone").hide();

	$('#updateinfo').click(function(){
		 //console.log('#updateinfo is now visible');
    	$("#userinfozone").slideToggle();
    });

/* ------ Report VCS WEB------  */
				var jsURL_uprofile_update = '<?php echo base_url();?>hwdata/modules/usercontrol/edit_userprofile.php';
				$("form#userupdateinfo").validate({
				  rules: {
			      old_pass: {
			        required: true
			      },
			      new_pass: {
			        required: true
			      },
			      uemail: {
			        required: true
			      }
			    },
			    messages: {
			      old_pass: "Please specify your Old Password",
			      new_pass: "Please specify your New Password",
			      uemail: "Please specify your Email"
			    },
				    submitHandler: function(form) {
				        var data = $(form).serialize();
				        
				        $.post(jsURL_uprofile_update,
				            data ,
				            function(data) {
				               // top.location.reload();
				              
				            } // END Function
				        ).done(function( data ) {
				        	var data = $.parseJSON(data);

	        				$.each(data, function(index, value) {
	        					//alert(value);
	        					
	        					if(value == "Success"){
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Update Successful...</i>",
										color : "#659265",
										iconSmall : "fa fa-check fa-2x fadeInRight animated",
										timeout : 3000
									});

				        				function pageRedirect() {
										//top.location.reload();
										$(this).delay(500).fadeOut(1000, function() { window.location = '<?php echo base_url();?>hwdata/home.php?lang=th&page=profile'; });
										}

										setTimeout(pageRedirect(), 500);

									
	        					}else{
	        						$.smallBox({
										title : value,
										content : "<i class='fa fa-clock-o'></i> <i>Error Update!...</i>",
										color : "#C46A69",
										iconSmall : "fa fa-times fa-2x fadeInRight animated",
										timeout : 3000
									});
	        					}

	        				});

					  	});
				    },
				highlight: function (element) {
			      $(element).closest('.input').removeClass('has-success').addClass('has-error');
			    },
			    unhighlight: function (element) {
			      $(element).closest('.input').removeClass('has-error').addClass('has-success');
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
				/* ------ Report VCS WEB------  */


		});
</script>