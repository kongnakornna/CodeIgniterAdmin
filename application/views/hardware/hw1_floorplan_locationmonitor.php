<?php 
//echo base_url();
$timer='3';
$timer3='1';
$timer4='1';
$timeloop=(int)$timer*60*60;// x sec
$timeloop3=(int)$timer3*60*60;// x sec
$timeloop4=(int)$timer4*60*60;// x sec
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($admin_team);
?>
<script src="<?php echo base_url('theme');?>/assets/js/main.js"></script> <!-- Resource jQuery -->
<script type="text/javascript">
    //floorplan  DO NOT REMOVE : GLOBAL FUNCTIONS!  
  $(document).ready(function() {
   pageSetUp();
  $(function(){
      function floorplan(){

        $.getJSON( "<?php echo base_url();?>hwdata/json/acms_hw1.json", function( data ) {
          var jsonString = JSON.stringify(data);
          var result = JSON.parse(jsonString);
          var hw1s1_humi = result.sensor1.Humi;
          var hw1s1_temp = result.sensor1.Temp;
          var hw1s2_temp = result.sensor2.Temp;
          var hw1s3_temp = result.sensor3.Temp;
          var hw1s4_temp = result.sensor4.Temp;
          var hw1s5_temp = result.sensor5.Temp;
          var hw1s6_temp = result.sensor6.Temp;
          var hw1s7_temp = result.sensor7.Temp;

          /*if(hw1s1_humi == 56.1){
            //$('#hw1_s1val_humi').removeClass( "bg-color-green" );
            $('#hw1_s1val_humi').addClass( "bg-color-orange" );
          }*/

          $('#hw1_s1val_humi').text(hw1s1_humi);
          $('#hw1_s1val_temp').text(hw1s1_temp);
          $('#hw1_s2val_temp').text(hw1s2_temp);
          $('#hw1_s3val_temp').text(hw1s3_temp);
          $('#hw1_s4val_temp').text(hw1s4_temp);
          $('#hw1_s5val_temp').text(hw1s5_temp);
          $('#hw1_s6val_temp').text(hw1s6_temp);
          $('#hw1_s7val_temp').text(hw1s7_temp);

        }); 

        $.getJSON( "<?php echo base_url();?>hwdata/json/acms_hw2.json", function( data2 ) {
          var jsonString2 = JSON.stringify(data2);
          var result2 = JSON.parse(jsonString2);
          var hw2s1_humi = result2.sensor1.Humi;
          var hw2s1_temp = result2.sensor1.Temp;
          var hw2s2_temp = result2.sensor2.Temp;
          var hw2s3_temp = result2.sensor3.Temp;
          var hw2s4_temp = result2.sensor4.Temp;
          var hw2s5_temp = result2.sensor5.Temp;
          var hw2s6_temp = result2.sensor6.Temp;
          var hw2s7_temp = result2.sensor7.Temp;
          $('#hw2_s1val_humi').text(hw2s1_humi);
          $('#hw2_s1val_temp').text(hw2s1_temp);
          $('#hw2_s2val_temp').text(hw2s2_temp);
          $('#hw2_s3val_temp').text(hw2s3_temp);
          $('#hw2_s4val_temp').text(hw2s4_temp);
          $('#hw2_s5val_temp').text(hw2s5_temp);
          $('#hw2_s6val_temp').text(hw2s6_temp);
          $('#hw2_s7val_temp').text(hw2s7_temp);
        }); 
    }
    floorplan();
     setInterval(floorplan,<?php echo $timeloop;?>); /*Time sec*/
  });

 });
</script>	