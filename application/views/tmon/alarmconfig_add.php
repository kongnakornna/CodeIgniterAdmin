<?php $language = $this->lang->language; 
$date=date('Y-m-d H:i:s');
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('alarmconfig/save', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $language['add'] ?>
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['sensorsettings'] ?>
											</small>
										</h4>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($web_menu);
					//Debug($parent);
			}

 
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
									<!-- #section:elements.form -->
 					
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['hardware']?> ID </label>
<div class="col-sm-9">

<?php echo $ListSelectHardware;?>
<!-- <input type="hidden"  name="sensor_config_id"  value="0" />-->
</div>
</div>
<!-- ################################## -->
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensortype']?> : </label>
<div class="col-sm-9">
<select class="form-control" id="sensor_config_id_map" name="sensor_config_id_map"></select>
</div>
</div>								
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> (<?php echo $language['alarmconfig']?>) EN </label>
<div class="col-sm-9"><input name="alarmname_en" type="text" class="col-xs-10 col-sm-10" id="alarmname_en" placeholder="<?php echo $language['name']?> (<?php echo $language['alarmconfig']?>) EN">
</div>
</div>
<!-- ################################## -->	
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> (<?php echo $language['alarmconfig']?>) TH</label>
<div class="col-sm-9"><input name="alarmname_th" type="text" class="col-xs-10 col-sm-10" id="alarmname_th" placeholder="<?php echo $language['name']?> (<?php echo $language['alarmconfig']?>) TH">
</div>
</div>
<!-- ################################## -->																			
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['date']?> </label>
<div class="col-sm-9"><input type="hidden"  class="col-xs-2 col-sm-2" placeholder="<?php echo $language['date']?>" id="date" name="date" value="<?php echo $date ?>">
 <span class="badge badge-success"> 
<?php echo $date ?>
</span>
</div>
</div>
<input type="hidden"  class="col-xs-2 col-sm-2" id="status_email" name="status_email" value="1">
<input type="hidden"  class="col-xs-2 col-sm-2" id="status_sms" name="status_sms" value="0">
<input type="hidden"  class="col-xs-2 col-sm-2" id="status_call" name="status_call" value="0">
<input type="hidden"  class="col-xs-2 col-sm-2" id="status" name="status" value="1">
<!-- ################################## -->											

						</div>
 
		                   <div style="clear: both;"></div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												<?php echo $language['save']?>
											</button>

											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												<?php echo $language['reset']?>
											</button>
										</div>
									</div>
							</div><br/>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->

<script type="text/javascript">
$( document ).ready(function() {
		console.log( "ready!" );		

		$('#hardware_id_map').change(function( ) {
				
				var hardware_id_map = $(this).val();
				//alert($(this).attr('id'));
				//alert($(this).val());
				$('#sensor_config_id_map').load('<?php echo base_url() ?>Sensorconfig/list_dd/' + hardware_id_map);

				/*$.ajax({
						type: 'POST',
						url: "<?php echo base_url() ?>Sensorconfig/list_dd/" + hardware_id_map,
						data : { catid : catid},
						 dataType: "json",
						cache: false,
						success: function(data){
								//alert(data);
								//alert(data[0]['sensor_config_id_map']);
								//$("#countview").html('จำนวนผู้อ่าน : ' + data.response.header.view);
								//if(data = 'Yes'){										
								//		$('#dara_avatar').attr('style', 'display:none');
								//		$('#upload_avatar').attr('style', 'display:block');
								//}
						}
				});*/
		});

		 



		$('#form_submit').on('click', function(e){
				chkform();
		});
});

function chkform(){

		var hardware_id_map = document.AddForm.hardware_id_map.value;
		var sensor_config_id_map = document.AddForm.sensor_config_id_map.value;

		if(hardware_id_map > 0){

				if(document.getElementById("hardware_id_map").value == ''){
					alert('กรุณาใส่ <?php echo $language['hardware']?> ด้วยครับ');
					document.AddForm.title_th.focus();
				}else if(document.getElementById("sensor_config_id_map").value == ''){
					alert('กรุณาใส่ <?php echo $language['sensorconfig']?> ด้วยครับ');
					document.AddForm.description_th.focus();
				}else if(document.getElementById("alarmname").value == ''){
					alert('กรุณาใส่ <?php echo $language['name']?><?php echo $language['sensorconfig']?> ด้วยครับ');
					//document.getElementById("tag_id").focus();
					document.AddForm.other_link.focus();
				}else{
					$('#form_submit').attr('disabled', 'disabled');
					document.AddForm.submit();
				}

		}else alert('<?php echo $language['please_select']?>');
		
}
</script>