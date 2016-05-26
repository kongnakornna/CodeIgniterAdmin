<?php # $this->load->view('hardware/alert_log');?>
<script src="<?php echo base_url('theme');?>/assets/js/jquery.datetimepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url('theme');?>/assets/js/footable.js" type="text/javascript"></script>
<script src="<?php echo base_url('theme');?>/assets/js/footable.filter.js" type="text/javascript"></script>
<script src="<?php echo base_url('theme');?>/assets/js/footable.paginate.js" type="text/javascript"></script>

<script type="text/javascript">
    
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    
    $(document).ready(function() {
      
      pageSetUp();
      
      // PAGE RELATED SCRIPTS
    
    //var uxid = "<?php echo $sessuserid;?>";
    //$('#testx').load('modules/report/report_pdf.php',function(datahw4){
    //  $('#ss').html(uxid);
    //});
$('#loadx').hide();
$('.footable').footable();
$('#datetimepicker_start').datetimepicker({
dayOfWeekStart : 1,
lang:'en'
});

$('#datetimepicker_end').datetimepicker({
dayOfWeekStart : 1,
lang:'en'
});

$( "#alertlog_button" ).click(function( event ) {
  $('#loadx').show();
event.preventDefault();

$.post( "modules/log/alertlog_search.php", $( "#alertlog_search" ).serialize() ).done(function( data ) {
      $( "#search_result" ).html( data );
      $("#listdata").html('');
    });
    //alert( "Data Loaded: " + data );
  });
    



    });

</script>





<!--


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
     $( "#alert_chk" ).removeClass( "active" );
     $( "#normal_chk" ).removeClass( "active" );
     $( "#alert_chk" ).removeClass( "active" );
    });

    $('#clear-val').click(function (e) {
     e.preventDefault();
     $('table.footable').trigger('footable_clear_filter');
     $( "#clear-val" ).addClass( "active" );
     $( "#alert_chk" ).removeClass( "active" );
     $( "#normal_chk" ).removeClass( "active" );
     $( "#alert_chk" ).removeClass( "active" );
	});

    $('#alert_chk').click(function (e) {
     e.preventDefault();
     var logalertvalue = $('#logalert').data('alert');
     //alert(adminvalue);
     $('table.footable').trigger('footable_filter', {filter: logalertvalue});
     $( "#clear-val" ).removeClass( "active" );
     $( "#alert_chk" ).addClass( "active" );
     $( "#warning_chk" ).removeClass( "active" );
     $( "#normal_chk" ).removeClass( "active" );
	});

    $('#warning_chk').click(function (e) {
     e.preventDefault();
     var logwarningvalue = $('#logwarning').data('warning');
     //alert(adminvalue);
     $('table.footable').trigger('footable_filter', {filter: logwarningvalue});
     $( "#clear-val" ).removeClass( "active" );
     $( "#warning_chk" ).addClass( "active" );
     $( "#alert_chk" ).removeClass( "active" );
     $( "#normal_chk" ).removeClass( "active" );
	});

	$('#normal_chk').click(function (e) {
     e.preventDefault();
     var lognormalvalue = $('#lognormal').data('normal');
     $('table.footable').trigger('footable_filter', {filter: lognormalvalue});
     $( "#clear-val" ).removeClass( "active" );
     $( "#normal_chk" ).addClass( "active" );
     $( "#alert_chk" ).removeClass( "active" );
     $( "#warning_chk" ).removeClass( "active" );
	});

		});

		</script>
    -->


 