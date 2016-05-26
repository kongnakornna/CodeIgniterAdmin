<?php 
$admin_type=$this->session->userdata('admin_type');
$language = $this->lang->language; 
//Debug($calibrationsensor_list);die();
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('calibrationsensor/save2', $attributes);
?>
									<div class="page-header">
										<h3>&nbsp;&nbsp;&nbsp;
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['sensorsettings'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit'].' '.$calibrationsensor_list[0]['sensor_name'] ?>
											</small>
										</h3>
									</div>

									<div class="col-xs-12">

<?php

			if(function_exists('Debug')){
					//Debug($calibrationsensor_list);
					//Debug($parent);
			}
//Debug($calibrationsensor_list);
  $countitem = count($calibrationsensor_list);
  $sensor_config_id=$calibrationsensor_list[0]['sensor_config_id'];
  $sensor_config_id_map=$calibrationsensor_list[0]['sensor_config_id_map'];
  $hardware_id=$calibrationsensor_list[0]['hardware_id'];
  $sensor_group_en=$calibrationsensor_list[0]['sensor_group'];
  $sensor_name_en=$calibrationsensor_list[0]['sensor_name'];
  $sensor_type_id=$calibrationsensor_list[0]['sensor_type_id'];
  $sensor_high=$calibrationsensor_list[0]['sensor_high'];
  $sensor_warning=$calibrationsensor_list[0]['sensor_warning'];
  $alert=$calibrationsensor_list[0]['alert'];
  $sn=$calibrationsensor_list[0]['sn'];
  $model=$calibrationsensor_list[0]['model'];
  //$date=$calibrationsensor_list[0]['date'];
  $date=date('Y-m-d H:i:s');
  $vendor=$calibrationsensor_list[0]['vendor'];
  $status=$calibrationsensor_list[0]['status'];
  $sensor_type_name=$calibrationsensor_list[0]['sensor_type_name'];
  $status=$calibrationsensor_list[0]['status'];
  $sensor_group_th=$calibrationsensor_list[1]['sensor_group'];
  $sensor_name_th=$calibrationsensor_list[1]['sensor_name'];
  $comparevalue=$calibrationsensor_list[0]['comparevalue'];
    $lang=$this->lang->line('lang');
	if($lang==='en'){
    $sensor_type_name=$calibrationsensor_list[0]['sensor_type_name'];
	}else{
    $sensor_type_name=$calibrationsensor_list[1]['sensor_type_name'];
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
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> </label>
<div class="col-sm-9">
<span class="label label-success"> 

<?php 
$lang=$this->lang->line('lang');
	if($lang==='en'){
    echo $sensor_name_en;
	}else{
   echo $sensor_name_th;
    }
?>
 </span>
</div>
</div>
<!-- ################################## -->		
 
 <!-- ################################## -->		
 <input type="hidden" class="col-xs-1 col-sm-1" placeholder="title" id="hardware_id" name="hardware_id" value="<?php echo $hardware_id ?>">

 <input type="hidden" class="col-xs-1 col-sm-1" placeholder="title" id="sensor_config_id_map" name="sensor_config_id_map" value="<?php echo $sensor_config_id_map; ?>">
 
<input name="sensor_group_en" type="hidden" class="col-xs-10 col-sm-5" id="sensor_group" value="<?php echo $sensor_group_en; ?>" placeholder="<?php echo $language['mainhardware']?>">
 
<input name="sensor_group_th" type="hidden" class="col-xs-10 col-sm-5" id="sensor_group" value="<?php echo $sensor_group_th; ?>" placeholder="<?php echo $language['mainhardware']?>">
 <input name="sensor_name_en" type="hidden" class="col-xs-8 col-sm-4" id="sensor_name_en" value="<?php echo $sensor_name_en;?>" placeholder="<?php echo $language['sensor']?> ">
<input name="sensor_name_th" type="hidden" class="col-xs-8 col-sm-4" id="sensor_name_th" value="<?php echo $sensor_name_th;?>" placeholder="<?php echo $language['sensor']?> ">
 
<!-- ################################## -->		
 
 <input type="hidden"  class="col-xs-1 col-sm-1" placeholder="<?php echo $language['sensortype']?>" id="sensor_type_id" name="sensor_type_id" value="<?php echo $sensor_type_id ?>">
 <input type="hidden" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['statushigh']?>" id="sensor_high" name="sensor_high" value="<?php echo $sensor_high ?>"> 
<input type="hidden" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['statuswarning']?>" id="sensor_warning" name="sensor_warning" value="<?php echo $sensor_warning; ?>"> 
<input type="hidden" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['alert']?>" id="alert" name="alert" value="<?php echo $alert; ?>">
 
<!-- ################################## -->	


<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['comparevalue']?> </label>
<div class="col-sm-9">
<?php if($admin_type==1 || $admin_type==2){?>
<input type="text" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['comparevalue']?>" id="comparevalue" name="comparevalue" value="<?php echo $comparevalue; ?>">
<?php }else{?> 
<input type="hidden" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['comparevalue']?>" id="comparevalue" name="comparevalue" value="<?php echo $comparevalue; ?>">
<span class="label label-success"> <?php  echo $comparevalue;?> </span><?php }?>
</div>
</div>
<!-- ################################## -->	

 
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['date']?> </label>
<div class="col-sm-9"><input type="hidden"  class="col-xs-2 col-sm-2" placeholder="<?php echo $language['date']?>" id="date" name="date" value="<?php echo $date ?>">
 <span class="label label-success"> 
<?php echo $date ?>
</span>
<input name="status" type="hidden" value="<?php echo $status; ?>" /></div>
</div>
<!-- ################################## -->											
 							
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
									<br />
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
