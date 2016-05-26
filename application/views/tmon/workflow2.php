<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($admin_team);
?>
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

 <style type="text/css">
  .gbox {
    width:100px; 
    height:80px;
  }
</style>


<div class="page-content-area">

		 
							<h1>
								<?php  echo $this->lang->line('overview');?>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									  <?php  echo $this->lang->line('graphsmonitor');?>
								</small>
							</h1>
		 


<?php #################################################################
$this->load->view('tmon/workflow_main');
?>
