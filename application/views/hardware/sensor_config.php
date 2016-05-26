<?php # $this->load->view('hardware/sensor_config');?>
<script src="<?php echo base_url('theme');?>/assets/js/raphael.js"></script>
<script src="<?php echo base_url('theme');?>/assets/js/jquery.classyled.min.js"></script>
<script src="<?php echo base_url('theme');?>/assets/js/footable.js" type="text/javascript"></script>
<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!		
	$(document).ready(function() {		
			pageSetUp();
			$('.footable').footable();
	});
</script>

<script>
$(document).ready(function() {
$('.led').ClassyLED({
 type: "time", // time, countdown or random
 format: "hh:mm:ii", // time format for the led
 color: "#fff", // hex color of the digits
 backgroundColor: "#666", // hex color of the background
 size: 2, // LED digit size in pixels
 rounded: 4, // round radius of the LED digits
 length: 4, // spacing between the digits
 fontType: 1 // type of the LED font display
});
});
</script>
