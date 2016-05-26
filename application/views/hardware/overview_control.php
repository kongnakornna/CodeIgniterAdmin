<?php # $this->load->view('hardware/overview_control');?>
<?php 
//echo base_url();
$timer='3';
$timer3='1';
$timer4='1';
$timeloop=(int)$timer*60*60;// x sec
$timeloop3=(int)$timer3*20*60;// x sec
$timeloop4=(int)$timer4*20*60;// x sec
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($admin_team);
?>
<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!	
	$(document).ready(function() {		
			pageSetUp();
  $(function(){
      function load_hw1_json(){
      $('#s1_humi').load('<?php echo base_url();?>hwdata/overview/data_s1_humi.php',function(data){
      });
      $('#s1_temp').load('<?php echo base_url();?>hwdata/overview/data_s1_temp.php',function(data){
      });
      $('#s2_temp').load('<?php echo base_url();?>hwdata/overview/data_s2_temp.php',function(data){
      });
      $('#s3_temp').load('<?php echo base_url();?>hwdata/overview/data_s3_temp.php',function(data){
      });
      $('#s4_temp').load('<?php echo base_url();?>hwdata/overview/data_s4_temp.php',function(data){
      });
      $('#s5_temp').load('<?php echo base_url();?>hwdata/overview/data_s5_temp.php',function(data){
      });
      $('#s6_temp').load('<?php echo base_url();?>hwdata/overview/data_s6_temp.php',function(data){
      });
      $('#s7_temp').load('<?php echo base_url();?>hwdata/overview/data_s7_temp.php',function(data){
      });
      $('#s21_humi').load('<?php echo base_url();?>hwdata/overview/data_s21_humi.php',function(data){
      });
      $('#s21_temp').load('<?php echo base_url();?>hwdata/overview/data_s21_temp.php',function(data){
      });
      $('#s22_temp').load('<?php echo base_url();?>hwdata/overview/data_s22_temp.php',function(data){
      });
      $('#s23_temp').load('<?php echo base_url();?>hwdata/overview/data_s23_temp.php',function(data){
      });
      $('#s24_temp').load('<?php echo base_url();?>hwdata/overview/data_s24_temp.php',function(data){
      });
      $('#s25_temp').load('<?php echo base_url();?>hwdata/overview/data_s25_temp.php',function(data){
      });
      $('#s26_temp').load('<?php echo base_url();?>hwdata/overview/data_s26_temp.php',function(data){
      });
      $('#s27_temp').load('<?php echo base_url();?>hwdata/overview/data_s27_temp.php',function(data){
      });
    }
    load_hw1_json();
	 setInterval(load_hw1_json,<?php echo $timeloop;?>); /*Time sec*/
  });
});
</script>

