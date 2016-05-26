<style type="text/css">
.col-sm-6 {width: 100%;text-align: center;	}
#saveorder{cursor:pointer;}
.input-small{text-align: center;}
</style>
						<!-- <div class="page-header">
							<h1>
							<?php //echo $HeadTitle?>
							<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								<?php //echo $HeadTitle?>
							</small>
							</h1>
						</div> -->
<?php
			if(isset($error)){
?>
				<div class="col-xs-12">
							<div class="alert alert-danger">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											Oh snap!</strong><?php echo $error?>.
									<br>
							</div>
				</div>
<?php
			}
?>
<?php
			if(isset($success)){
?>
				<div class="col-xs-12">
							<div class="alert alert-success">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											</strong><?php echo $success?>.
									<br>
							</div>
				</div>
<?php
			}
?>





<!-- start: PAGE CONTENT -->
<?php ############################################################################################?>
					<div class="row">
						<div class="col-sm-4">
							<div class="core-box">
								<div class="heading">
									<i class="clip-bars circle-icon circle-green"></i>
									<h2><?php echo $this->lang->line('floorplan');?></h2>
								</div>
								<div class="content">
									<?php echo $this->lang->line('floorplan');?>
								</div>
								<a class="view-more" href="<?php echo base_url('floorplan'); ?>">
									 <?php echo $this->lang->line('viewmore');?> <i class="clip-arrow-right-2"></i>
								</a>
							</div>
						</div>
<?php ############################?>
						<div class="col-sm-4">
							<div class="core-box">
								<div class="heading">
									<i class="clip-tree  circle-icon circle-teal"></i>
									<h2><?php echo $this->lang->line('flowchartmonitor');?></h2>
								</div>
								<div class="content">
									<?php echo $this->lang->line('flowchartmonitor');?>
								</div>
								<a class="view-more" href="<?php echo base_url('workflow'); ?>">
									 <?php echo $this->lang->line('viewmore');?> <i class="clip-arrow-right-2"></i>
								</a>
							</div>
						</div>
<?php ############################?>
						<div class="col-sm-4">
							<div class="core-box">
								<div class="heading">
									<i class="clip-stats circle-icon circle-bricky"></i>
									<h2><?php echo $this->lang->line('monitor');?></h2>
								</div>
								<div class="content">
									<?php echo $this->lang->line('monitor');?>
								</div>
								<a class="view-more" href="<?php echo base_url('overview'); ?>">
									 <?php echo $this->lang->line('viewmore');?><i class="clip-arrow-right-2"></i>
								</a>
							</div>
						</div>
					</div>
 
<?php ############################################################################################?>

<style>
 .gauge_box {
      width: 150px;
      height: 150px;
      display: inline-block;
      border: 0px solid #ccc;
      margin: 5px;
    }
</style>
<div class="col-sm-12">



<?php  ###############[Hardware 1]################  ?>
<h1 class="semi-bold">Hardware #1</h1>
<hr>





<div class="well well-light">
    <p></p>
    <h1 class="semi-bold">Hardware #1</h1>
    <br>
        <div class="row">
<?php ############################################################################################?>
					<div class="row">
						<div class="col-sm-4">
							<div class="core-box">
								<div class="content">
  								<table class="table">
                                    <tr>
                                        <td>
                                            <div id="g21" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="g11" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                </table>
								</div>
							</div>
						</div>
<?php ############################?>
						<div class="col-sm-4">
							<div class="core-box">
								<div class="heading">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <div id="g31" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="g41" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                </table>
								</div>
							</div>
						</div>
<?php ############################?>
						<div class="col-sm-4">
							<div class="core-box">
								<div class="heading">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <div id="g51" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="g61" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="g71" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="g81" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                </table>
							</div>
						</div>
					</div>
 
<?php ############################################################################################?>
		</div>
 </div>
<?php  ###############[Hardware 1]################  ?>


<?php  ###############[Hardware 2]################  ?>

    <div class="well well-light">

    <p></p>
    <h1 class="semi-bold">Hardware #2</h1>
    <br>
        <div class="row">
                
                    <div class="col-xs-12 col-sm-6 col-md-3">

                        <div class="panel panel-darken">
                          
                            <div class="panel-body no-padding text-align-center">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <div id="ghw2_s2" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="ghw2_s1" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="panel panel-primary">
                            <div class="panel-body no-padding text-align-center">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <div id="ghw2_s3" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="ghw2_s4" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>           
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="panel panel-greenLight">
                            <div class="panel-body no-padding text-align-center">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <div id="ghw2_s5" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="ghw2_s6" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>            
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="panel panel-primary">
                            <div class="panel-body no-padding text-align-center">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <div id="ghw2_s7" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="ghw2_s8" class="gauge_box"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
         </div>
    </div>
<?php  ###############[Hardware 2]################  ?>
