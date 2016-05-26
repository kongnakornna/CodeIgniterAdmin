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
<!-- MAIN CONTENT -->
<div id="content">
	
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-sitemap"></i><?php  echo $this->lang->line('workflowmonitor');?> </h1>
		</div>
	</div>

<!-- widget grid -->
	<section id="widget-grid" class="">
				<div class="row">
<style type="text/css">
	.gbox {
		width:100px; 
		height:80px;
	}
</style>
<?php ###########################[Box 1]############################### ?>
<article class="col-sm-12 col-md-6 col-lg-3">

							<div class="jarviswidget jarviswidget-color-blue" id="wid-id-tree1" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-tachometer"></i> </span>
									<h2><?php echo $this->lang->line('hardware');?>  #1 </h2>
								</header>
								<div>
									<div class="jarviswidget-editbox">
									</div>
									<div class="widget-body">
										<div class="tree smart-form">
											<ul>
												<li>
													<span><i class="fa fa-lg fa-sun-o fa-spin"></i> <?php echo $this->lang->line('mainhardware');?></span>
													<ul>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 1</span>
															<ul>
																<li>
																	<span> Humidity <div id="g11" class="gbox"></div></span>
																</li>
																<li>
																	<span> Temperature <div id="g21" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 2</span>
															<ul>
																<li>
																	<span> Temperature <div id="g31" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 3</span>
															<ul>
																<li>
																	<span> Temperature <div id="g41" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 4</span>
															<ul>
																<li>
																	<span> Temperature <div id="g51" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 5</span>
															<ul>
																<li>
																	<span> Temperature <div id="g61" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 6</span>
															<ul>
																<li>
																	<span> Temperature <div id="g71" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 7</span>
															<ul>
																<li>
																	<span> Temperature <div id="g81" class="gbox"></div></span>
																</li>
															</ul>
														</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</article>
<?php ###########################[Box 1]############################### ?>


<?php ###########################[Box 2]############################### ?>
<article class="col-sm-12 col-md-6 col-lg-3">
							<div class="jarviswidget jarviswidget-color-green" id="wid-id-tree2" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-tachometer"></i> </span>
									<h2><?php echo $this->lang->line('hardware');?>  #2 </h2>
								</header>
								<div>
									<div class="jarviswidget-editbox">
									</div>
									<div class="widget-body">
										<div class="tree smart-form">
											<ul>
												<li>
													<span><i class="fa fa-lg fa-sun-o fa-spin"></i> <?php echo $this->lang->line('mainhardware');?></span>
													<ul>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 1</span>
															<ul>
																<li>
																	<span> Humidity <div id="ghw2_s1" class="gbox"></div></span>
																</li>
																<li>
																	<span> Temperature <div id="ghw2_s2" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 2</span>
															<ul>
																<li>
																	<span> Temperature <div id="ghw2_s3" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 3</span>
															<ul>
																<li>
																	<span> Temperature <div id="ghw2_s4" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 4</span>
															<ul>
																<li>
																	<span> Temperature <div id="ghw2_s5" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 5</span>
															<ul>
																<li>
																	<span> Temperature <div id="ghw2_s6" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 6</span>
															<ul>
																<li>
																	<span> Temperature <div id="ghw2_s7" class="gbox"></div></span>
																</li>
															</ul>
														</li>
														<li>
															<span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 7</span>
															<ul>
																<li>
																	<span> Temperature <div id="ghw2_s8" class="gbox"></div></span>
																</li>
															</ul>
														</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</article>
<?php ###########################[Box 2]############################### ?>


<?php ###########################[Box 3]############################### ?>
<article class="col-sm-12 col-md-6 col-lg-3">
							<div class="jarviswidget jarviswidget-color-orange" id="wid-id-tree3" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
									<h2><?php echo $this->lang->line('hardwarecontrol');?>  #3</h2>
								</header>
								<div>
									<div class="jarviswidget-editbox">
									</div>
									<div class="widget-body">
										<div class="tree smart-form">
											<ul>
												<li>
													<span><i class="fa fa-lg fa-sun-o fa-spin"></i> <?php echo $this->lang->line('hardwarecontrol');?></span>
														<ul id="load_hw3_wf">
														</ul>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</article>
<?php ###########################[Box 3]############################### ?>

<?php ###########################[Box 4]############################### ?>
<article class="col-sm-12 col-md-6 col-lg-3">
							<div class="jarviswidget jarviswidget-color-red" id="wid-id-tree4" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-exclamation-triangle"></i> </span>
									<h2><?php echo $this->lang->line('warterleak');?>  #4 </h2>
								</header>
								<div>
									<div class="jarviswidget-editbox">
									</div>
									<div class="widget-body">
										<div class="tree smart-form">
											<ul>
												<li>
													<span><i class="fa fa-lg fa-sun-o fa-spin"></i> <?php echo $this->lang->line('warterleak');?></span>
														<ul id="load_hw4_wf">
															
														</ul>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</article>
<?php ###########################[Box 4]############################### ?>


<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
	$(document).ready(function() {
			
			pageSetUp();

    $(function(){
	      function load_hw3_json(){
	      $('#load_hw3_wf').load('<?php echo base_url();?>hwdata/overview/loadhw3json_wf.php',function(datahw4){
	      });
	    }
	    load_hw3_json();
	     setInterval(load_hw3_json,<?php echo $timeloop3;?>); /*Time sec*/
	}); 

	$(function(){
	      function load_hw4_json(){
	      $('#load_hw4_wf').load('<?php echo base_url();?>hwdata/overview/loadhw4json_wf.php',function(datahw4){
	      });
	    }
	    load_hw4_json();
	     setInterval(load_hw4_json,<?php echo $timeloop4;?>); /*Time sec*/
	}); 


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
          //title: "<?php echo $this->lang->line('sensor');?> 1",
          //label: "Humi",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var g21 = new JustGage({
          id: "g21", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 1",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var g31 = new JustGage({
          id: "g31", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 2",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var g41 = new JustGage({
          id: "g41", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 3",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var g51 = new JustGage({
          id: "g51", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 4",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var g61 = new JustGage({
          id: "g61", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 5",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var g71 = new JustGage({
          id: "g71", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 6",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var g81 = new JustGage({
          id: "g81", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 7",
          //label: "Temp",
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
          //title: "<?php echo $this->lang->line('sensor');?> 1",
          //label: "Humi",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var hw2_s2 = new JustGage({
          id: "ghw2_s2", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 1",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var hw2_s3 = new JustGage({
          id: "ghw2_s3", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 2",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });
        
        var hw2_s4 = new JustGage({
          id: "ghw2_s4", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 3",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var hw2_s5 = new JustGage({
          id: "ghw2_s5", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 4",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var hw2_s6 = new JustGage({
          id: "ghw2_s6", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 5",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var hw2_s7 = new JustGage({
          id: "ghw2_s7", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 6",
          //label: "Temp",
          donut: true,
          gaugeWidthScale: 0.6,
          counter: true
        });

        var hw2_s8 = new JustGage({
          id: "ghw2_s8", 
          value: (0), 
          min: 0,
          max: 100,
          //title: "<?php echo $this->lang->line('sensor');?> 7",
          //label: "Temp",
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
				</div>
				</section>
				<!-- end widget grid -->

			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->