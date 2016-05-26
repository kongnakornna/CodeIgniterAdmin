<?php # $this->load->view('hardware/hardware_config');?>
<script src="<?php echo base_url('theme');?>/assets/js/jquery.datetimepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url('theme');?>/assets/js/jquery.timeTo.js"></script>

  <script type="text/javascript">
      $(document).ready(function() {
      
      pageSetUp();






/*
$('#datetimepicker_end').datetimepicker({
dayOfWeekStart : 1,
lang:'en'
});
*/






$('#check_load').hide();

$(':checkbox').on('change',function(){
 var th = $(this), name = th.prop('name'); 
 if(th.is(':checked')){
     $(':checkbox[name="'  + name + '"]').not($(this)).prop('checked',false);   
  }else{
    $('#content_hw3loader').html('');
    $('#check_load').hide();
  }

  if ($('#s1chk').is(":checked"))
  {
      var c1 =   $('#s1chk').val();
      //alert(c1);
      $('#check_load').show();
      $('#content_hw3loader').load('<?php echo base_url();?>hwdata/modules/hardwareconfig/hwsensor1_control.php',function(data1){
      });

  }

  if ($('#s2chk').is(":checked"))
  {
      var c2 =   $('#s2chk').val();
      //alert(c2);
      $('#check_load').show();
      $('#content_hw3loader').load('<?php echo base_url();?>hwdata/modules/hardwareconfig/hwsensor2_control.php',function(data2){
      });
  }

    if ($('#s3chk').is(":checked"))
  {
      var c3 =   $('#s3chk').val();
      //alert(c3);
      $('#check_load').show();
      $('#content_hw3loader').load('<?php echo base_url();?>hwdata/modules/hardwareconfig/hwsensor3_control.php',function(data3){
      });
  }

    if ($('#s4chk').is(":checked"))
  {
      var c4 =   $('#s4chk').val();
      //alert(c4);
      $('#check_load').show();
      $('#content_hw3loader').load('<?php echo base_url();?>hwdata/modules/hardwareconfig/hwsensor4_control.php',function(data4){
      });
  }


});







     $('#clock-1').timeTo();

  $(function(){
      function hw3(){


      $('#showhw3info').load('<?php echo base_url();?>hwdata/modules/hardwareconfig/hardwareconfig_info.php',function(data){
      });



    }
    hw3();
     //setInterval(hw3,3600); // 1 sec
	 setInterval(hw3,18000); // 5 sec
  });


    });
</script>