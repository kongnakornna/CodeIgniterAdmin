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
	<!-- MAIN CONTENT -->
	<div id="content">
        <div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-sitemap fa-fw "></i> 
					<?php echo $this->lang->line('floorplan');?>
					<span>
					 <?php echo $this->lang->line('sensorreport');?>
					</span>
				</h1>
			</div>
		</div>

				<!-- widget grid -->
				<section id="widget-grid" class="">
				<div class="row">
				
				
<div class="col-sm-12">
	<div class="well">


			<img src="<?php echo base_url();?>images/floowplan/floorplan_3d_v2.png" style="max-height:100%; max-width:100%;">
			<ul>

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw1_s1val_humi"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw1_s1val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw1_s2val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw1_s3val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw1_s4val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw1_s5val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw1_s6val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw1_s7val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->



				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw2_s1val_humi"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw2_s1val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw2_s2val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw2_s3val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw2_s4val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw2_s5val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw2_s6val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

				<li class="cd-single-point" style="display:block;">
					<span class="badge bg-color-green" id="hw2_s7val_temp"><img src="<?php echo base_url('theme');?>/assets/img/green_loader2.gif"></span>
				</li> <!-- .cd-single-point -->

			</ul>


	</div>
</div>





<!--
<div class="col-sm-12">
	<div class="well">

<img src="modules/monitor/floorplan_3d_v2.png" style="max-height:100%; max-width:100%;">

	</div>
</div>
-->




<!--
<img src="modules/monitor/floorplan_3d_v2.png">
-->


				</div>
				</section>
				<!-- end widget grid -->

			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->