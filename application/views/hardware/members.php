<?php # $this->load->view('hardware/members');?>
<script src="<?php echo base_url('theme');?>/assets/js/footable.js" type="text/javascript"></script>
<script src="<?php echo base_url('theme');?>/assets/js/footable.filter.js" type="text/javascript"></script>
<script src="<?php echo base_url('theme');?>/assets/js/footable.paginate.js" type="text/javascript"></script>
<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();
			
$('.footable').footable();

    $('.clear-filterx').click(function (e) {
      e.preventDefault();
      //$('.filter-status').val('');
      $('table.footable').trigger('footable_clear_filter');
     $( "#clear-val" ).removeClass( "active" );
     $( "#admin_chk" ).removeClass( "active" );
     $( "#user_chk" ).removeClass( "active" );
    });

    $('#clear-val').click(function (e) {
     e.preventDefault();
     $('table.footable').trigger('footable_clear_filter');
     $( "#clear-val" ).addClass( "active" );
     $( "#admin_chk" ).removeClass( "active" );
     $( "#user_chk" ).removeClass( "active" );
	});

    $('#admin_chk').click(function (e) {
     e.preventDefault();
     var adminvalue = $('#adminval').data('admin');
     //alert(adminvalue);
     $('table.footable').trigger('footable_filter', {filter: adminvalue});
     $( "#clear-val" ).removeClass( "active" );
     $( "#admin_chk" ).addClass( "active" );
     $( "#user_chk" ).removeClass( "active" );
	});

	$('#user_chk').click(function (e) {
     e.preventDefault();
     var uservalue = $('#userval').data('user');
     $('table.footable').trigger('footable_filter', {filter: uservalue});
     $( "#clear-val" ).removeClass( "active" );
     $( "#admin_chk" ).removeClass( "active" );
     $( "#user_chk" ).addClass( "active" );
	});
		});

</script>
