<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($web_menu);
		$lang=$language['lang']; 
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

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								 

								<div class="row">
									<div class="col-xs-12">
<?php /* ?>
							<h1><?php 
							$modules=$language['modules'];
							echo " <span style=\"color: #030;\">$modules</span> "; 
							 ?>  
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<!-- (single &amp; multiple) --> <?php echo $language['admin_menu'] ?> 
								</small>
							</h1>									 
<php */?>
				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($this->session->userdata);
					//Debug($this->lang->language);
				}
				//Debug($this->session->userdata('admin_id')) ;
?>
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
				<div>
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('sensorreport', $attributes);
?>


										<div class="row">
											<div class="col-md-12 space20">
												 
											</div>
										</div>

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="sample-table-2">
	<thead>
			<tr>
				<th width="54">ID</th>
				<th width="42"><?php echo $language['no'] ?>.</th>
				<th width="221"><?php echo $language['hardware'] ?></th>
				<th width="298"><?php echo $language['sensor'] ?></th>
				<th width="168" class="hidden-480"><?php echo $language['statushigh']?></th>
				<th width="168" class="hidden-480"><?php echo $language['statuswarning']?></th>
				<th width="229"><?php echo $language['status']?> </th>
				<th width="256"><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i><?php echo $language['date']?></th>
				<th width="256"><?=$language['settings']?></td>
			</tr>
	</thead>
<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
				$i=1;
				//$i=0;
				if($web_menu)
				for($key=0;$key<$maxcat;$key++){


  $sensor_config_id=$web_menu[$key]['sensor_config_id'];
  $hardware_id=$web_menu[$key]['hardware_id'];
  $sensor_group=$web_menu[$key]['sensor_group'];
  $sensor_name=$web_menu[$key]['sensor_name'];
  $sensor_type_id=$web_menu[$key]['sensor_type_id'];
  $sensor_high=$web_menu[$key]['sensor_high'];
	$sensor_warning=$web_menu[$key]['sensor_warning'];
	$sn=$web_menu[$key]['sn'];
	$model=$web_menu[$key]['model'];
	$date=$web_menu[$key]['date'];
	$vendor=$web_menu[$key]['vendor'];
	$sensor_status=$web_menu[$key]['sensor_status'];
	$sensor_type_name=$web_menu[$key]['sensor_type_name'];
						 
?>
		<tr>
						<td><a href="#"><?=$web_menu[$key]['sensor_config_id']?></a></td>
						<td><?php echo $i;?></td>
						<td><a href="#"><?=$web_menu[$key]['sensor_group']?></a></td>
						<td><a href="#"><?php echo $sensor_name; echo ' '; echo '['.$sensor_type_name.']';?></a></td>
						<td><a href="#"><?=$web_menu[$key]['sensor_high']?></a></td>
						<td><a href="#"><?=$web_menu[$key]['sensor_warning']?></a></td>
						<td><a href="#"> <?php
						 $sensor_status=$web_menu[$key]['sensor_status'];
						 $enable=$language['enable'];
						 $disable=$language['disable'];
						 if($sensor_status == 'y'){echo $enable;}else{echo $disable;} ?>
						</a>
						</td>
						<td><a href="#"><?php $create_date=$date;
						if($lang=='th'){echo RenDateTime($create_date);}else{echo  $create_date;} 
						?></a></td>
						<td>											 
							<a href="<?php echo site_url('sensormanage/edit/'.$web_menu[$key]['sensor_config_id']); ?>" class="tooltip-success" data-rel="tooltip" title="<?php echo $language['edit']?>">
							<span class="green">
							<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
							</span>
							</a>
						</td>
		</tr>
 
<?
							$i++;
						//}
				}
?>
		</tbody>
	</table>
</div>	
<?php
	echo form_close();
?>
										</div>
									</div>
								</div>

						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->

<script type="text/javascript">
$( document ).ready(function() {
<?php
		if($web_menu)		
				for($key=0;$key<$maxcat;$key++){
						
						$sensor_hwname = $web_menu[$key]['sensor_hwname'];
						$sensor_alert_log_id = $web_menu[$key]['sensor_alert_log_id'];
?>
		$('#status<?=$sensor_alert_log_id?>').on('click', function() {
				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
				//alert($(this).attr('id'));
				//alert($(this).val());
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('sensorreport/status/'.$sensor_alert_log_id)?>",
					cache: false,
					success: function(data){
							if(data == 0){
								$("#msg_error").attr('style','display:block;');
								AlertError('Inactive');
							}else{
								$("#msg_success").attr('style','display:block;');
								AlertSuccess	('Active');
							}
					}
				});
		});

		$('#bootbox-confirm<?=$sensor_alert_log_id?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('admin_menu/delete/'.$sensor_alert_log_id)?>';
						}
					});
		});

		$('#bx-confirm<?=$sensor_alert_log_id?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('admin_menu/delete/'.$sensor_alert_log_id)?>';
						}
					});
		});

<?php
				}	
?>

		$('#saveorder').on('click', function() {
				document.getElementById("jform").submit();
		});		
});

</script>
<?php echo js_asset('checkall.js'); ?>
