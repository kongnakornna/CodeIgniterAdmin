<?php # $this->load->view('hardware/sensorreport');?> 
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
  	//$('#testx').load('<?php echo base_url();?>hwdata/modules/report/report_pdf.php',function(datahw4){
  	//	$('#ss').html(uxid);
  	//});

$('.footable').footable();


$('#loadx').hide();

$('#datetimepicker_start').datetimepicker({
dayOfWeekStart : 1,
lang:'en'
});

$('#datetimepicker_end').datetimepicker({
dayOfWeekStart : 1,
lang:'en'
});

$( "#report_button" ).click(function( event ) {
  $('#loadx').show();
  event.preventDefault();

  /*$("#dialog").dialog({         
      width: 600,
      modal: true,
      close: function(event, ui) {
        $("#dialog").remove();
        }
      });*/

  $.post( "<?php echo base_url();?>hwdata/modules/report/report_search.php", $( "#report_search" ).serialize() ).done(function( data ) {
      
      $( "#search_result" ).html( data );
      $("#listdata").html('');

    });
    //alert( "Data Loaded: " + data );
  });
		
});

</script>
 
