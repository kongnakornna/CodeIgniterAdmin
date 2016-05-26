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
<?php # $this->load->view('hardware/sensor');?>
	<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/flot/jquery.flot.cust.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/flot/jquery.flot.resize.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/flot/jquery.flot.fillbetween.min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/flot/jquery.flot.orderBar.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/flot/jquery.flot.pie.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/flot/jquery.flot.tooltip.js"></script>
		<script type="text/javascript">
			// PAGE RELATED SCRIPTS
			/* chart colors default */
			var $chrt_border_color = "#efefef";
			var $chrt_grid_color = "#DDD"
			var $chrt_main = "#E24913";
			/* red       */
			var $chrt_second = "#6595b4";
			/* blue      */
			var $chrt_third = "#FF9F01";
			/* orange    */
			var $chrt_fourth = "#7e9d3a";
			/* green     */
			var $chrt_fifth = "#BD362F";
			/* dark red  */
			var $chrt_mono = "#000";

			$(document).ready(function() {

				// DO NOT REMOVE : GLOBAL FUNCTIONS!
				pageSetUp();
			});
</script>	
<script src="<?php echo base_url('theme');?>/assets/js/raphael.2.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('theme');?>/assets/js/justgage.js"></script>
<script>
      var g11, g21, g31, g41, g51, g61, g71, g81;
      var acmsrt_hw1 = '<?php echo base_url();?>hwdata/json/acms_hw1.json';
      
      window.onload = function(){
        var g11 = new JustGage({
          id: "g11", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 1",
          label: "Humi",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var g21 = new JustGage({
          id: "g21", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 1",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var g31 = new JustGage({
          id: "g31", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 2",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var g41 = new JustGage({
          id: "g41", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 3",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var g51 = new JustGage({
          id: "g51", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 4",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var g61 = new JustGage({
          id: "g61", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 5",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var g71 = new JustGage({
          id: "g71", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 6",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var g81 = new JustGage({
          id: "g81", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 7",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });


      var hw2_s1, hw2_s2, hw2_s3, hw2_s4, hw2_s5, hw2_s6, hw2_s7,hw2_s8;
      var acmsrt_hw2 = '<?php echo base_url();?>hwdata/json/acms_hw2.json';
      
      //window.onload = function(){
        var hw2_s1 = new JustGage({
          id: "ghw2_s1", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 1",
          label: "Humi",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var hw2_s2 = new JustGage({
          id: "ghw2_s2", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 1",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var hw2_s3 = new JustGage({
          id: "ghw2_s3", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 2",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var hw2_s4 = new JustGage({
          id: "ghw2_s4", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 3",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var hw2_s5 = new JustGage({
          id: "ghw2_s5", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 4",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var hw2_s6 = new JustGage({
          id: "ghw2_s6", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 5",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var hw2_s7 = new JustGage({
          id: "ghw2_s7", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 6",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var hw2_s8 = new JustGage({
          id: "ghw2_s8", 
          value: (0), 
          min: 0,
          max: 100,
          title: "<?php echo $this->lang->line('sensor');?> 7",
          label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
      
        setInterval(function() {

          $.getJSON(acmsrt_hw1, function (json) { 

          	//console.log("1"+json.sensor3['Temp']);

            g11.refresh(json.sensor1['Humi']); 
            g21.refresh(json.sensor1['Temp']);          
            g31.refresh(json.sensor2['Temp']);
            g41.refresh(json.sensor3['Temp']);
            g51.refresh(json.sensor4['Temp']);
            g61.refresh(json.sensor5['Temp']);
            g71.refresh(json.sensor6['Temp']);
            g81.refresh(json.sensor7['Temp']);
          });

 		  $.getJSON(acmsrt_hw2, function (json2) { 

          	//console.log("2 : "+json2.sensor1['Humi']);

            hw2_s1.refresh(json2.sensor1['Humi']); 
            hw2_s2.refresh(json2.sensor1['Temp']);          
            hw2_s3.refresh(json2.sensor2['Temp']);
            hw2_s4.refresh(json2.sensor3['Temp']);
            hw2_s5.refresh(json2.sensor4['Temp']);
            hw2_s6.refresh(json2.sensor5['Temp']);
            hw2_s7.refresh(json2.sensor6['Temp']);
            hw2_s8.refresh(json2.sensor7['Temp']);
          });
         
        }, <?php echo $timeloop;?>); /*Time sec*/
      };
</script>

