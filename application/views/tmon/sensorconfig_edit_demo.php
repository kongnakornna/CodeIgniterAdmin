<?php 
$admin_type=$this->session->userdata('admin_type');
$language = $this->lang->language; 
//Debug($sensorconfig_list);die();
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('sensorconfig/save', $attributes);
?>
									<div class="page-header">
										<h3>&nbsp;&nbsp;&nbsp;
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['sensorsettings'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit'].' '.$sensorconfig_list[0]['sensor_name'] ?>
											</small>
										</h3>
									</div>

									<div class="col-xs-12">

<?php

			if(function_exists('Debug')){
					//Debug($sensorconfig_list);
					//Debug($parent);
			}
//Debug($sensorconfig_list);
  $countitem = count($sensorconfig_list);
  $sensor_config_id=$sensorconfig_list[0]['sensor_config_id'];
  $sensor_config_id_map=$sensorconfig_list[0]['sensor_config_id_map'];
  $hardware_id=$sensorconfig_list[0]['hardware_id'];
  $sensor_group_en=$sensorconfig_list[0]['sensor_group'];
  $sensor_name_en=$sensorconfig_list[0]['sensor_name'];
  $sensor_type_id=$sensorconfig_list[0]['sensor_type_id'];
  $sensor_high=$sensorconfig_list[0]['sensor_high'];
  $sensor_warning=$sensorconfig_list[0]['sensor_warning'];
  $alert=$sensorconfig_list[0]['alert'];
  $sn=$sensorconfig_list[0]['sn'];
  $model=$sensorconfig_list[0]['model'];
  //$date=$sensorconfig_list[0]['date'];
  $date=date('Y-m-d H:i:s');
  $vendor=$sensorconfig_list[0]['vendor'];
  $status=$sensorconfig_list[0]['status'];
  $sensor_type_name=$sensorconfig_list[0]['sensor_type_name'];
  $status=$sensorconfig_list[0]['status'];
  
  $sensor_group_th=$sensorconfig_list[1]['sensor_group'];
  $sensor_name_th=$sensorconfig_list[1]['sensor_name'];
  
    $lang=$this->lang->line('lang');
	if($lang==='en'){
    $sensor_type_name=$sensorconfig_list[0]['sensor_type_name'];
	}else{
    $sensor_type_name=$sensorconfig_list[1]['sensor_type_name'];
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
 <input type="hidden" class="col-xs-1 col-sm-1" placeholder="title" id="sensor_config_id" name="sensor_config_id" value="<?php echo $sensor_config_id_map; ?>">


<?php if($admin_type==1){?>
<?php echo $ListSelectHardware;?>
<?php }else{?> <span class="label label-success"> <?php echo $hardware_id ?> </span>
<input type="hidden" class="col-xs-1 col-sm-1" placeholder="title" id="hardware_id" name="hardware_id" value="<?php echo $hardware_id ?>">
<?php //echo $hardware_id; ?>
<?php }?>

</div>
</div>
<!-- ################################## -->									
 
 
 <!-- ################################## -->		
<?php if($admin_type==1){?>							
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> EN </label>
<div class="col-sm-9">
<input name="sensor_group_en" type="text" class="col-xs-10 col-sm-5" id="sensor_group" value="<?php echo $sensor_group_en; ?>" placeholder="<?php echo $language['mainhardware']?>">
</div>
</div>
<?php }else{?>
<input name="sensor_group_en" type="hidden" class="col-xs-10 col-sm-5" id="sensor_group" value="<?php echo $sensor_group_en; ?>" placeholder="<?php echo $language['mainhardware']?>">
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> EN </label>
<?php echo $sensor_group_en; ?>
</div>
</div>
<?php }?><?php if($admin_type==1){?>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> EN </label>
<div class="col-sm-9">
<input name="sensor_name_en" type="text" class="col-xs-8 col-sm-4" id="sensor_name_en" value="<?php echo $sensor_name_en;?>" placeholder="<?php echo $language['sensor']?> ">
</div>
</div>
<?php }else{?>
<input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['sensor']?> " id="sensor_name_en" name="sensor_name_en" value="<?php echo $sensor_name_en;?>">
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> EN </label>
<div class="col-sm-9">
<?php echo $sensor_group_en; ?>
</div>
</div>
<?php }?><?php if($admin_type==1){?>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> TH </label>
<div class="col-sm-9">
<input name="sensor_group_th" type="text" class="col-xs-10 col-sm-5" id="sensor_group" value="<?php echo $sensor_group_th; ?>" placeholder="<?php echo $language['mainhardware']?>">
</div>
</div>
<?php }else{?>
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> TH </label>
<div class="col-sm-9">
<input name="sensor_group_th" type="hidden" class="col-xs-10 col-sm-5" id="sensor_group" value="<?php echo $sensor_group_th; ?>" placeholder="<?php echo $language['mainhardware']?>">
<?php echo $sensor_group_th; ?>
</div>
</div>
<?php }?><?php if($admin_type==1){?>
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> TH </label>
<div class="col-sm-9">
<input name="sensor_name_th" type="text" class="col-xs-8 col-sm-4" id="sensor_name_th" value="<?php echo $sensor_name_th;?>" placeholder="<?php echo $language['sensor']?> ">
</div>
</div>
<?php }else{?>
<input name="sensor_name_th" type="hidden" class="col-xs-8 col-sm-4" id="sensor_name_th" value="<?php echo $sensor_name_th;?>" placeholder="<?php echo $language['sensor']?> ">
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> TH </label>
<div class="col-sm-9">
<?php echo $sensor_name_th;?>
</div>
</div>
<?php }?>
<!-- ################################## -->		
 
 
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensortype']?> : </label>
<div class="col-sm-9">
<?php if($admin_type==1){?>
<?php echo $ListSelectSensortype; #echo $sensor_type_name; ?>
<?php  }else{?> 
<input type="hidden"  class="col-xs-1 col-sm-1" placeholder="<?php echo $language['sensortype']?>" id="sensor_type_id" name="sensor_type_id" value="<?php echo $sensor_type_id ?>">
 <span class="label label-success"> 
<?php  echo $sensor_type_name;?> </span><?php }?>
</div>
</div>								
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['statushigh']?> </label>
<div class="col-sm-9"><input type="text" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['statushigh']?>" id="sensor_high" name="sensor_high" value="<?php echo $sensor_high ?>">
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['statuswarning']?> </label>
<div class="col-sm-9">
 
<input type="text" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['statuswarning']?>" id="sensor_warning" name="sensor_warning" value="<?php echo $sensor_warning; ?>">
 

</div>
</div>


<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['alert']?> </label>
<div class="col-sm-9">
<?php if($admin_type==1 || $admin_type==2){?>
<input type="text" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['alert']?>" id="alert" name="alert" value="<?php echo $alert; ?>">
<?php }else{?> 
<input type="hidden" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['alert']?>" id="alert" name="alert" value="<?php echo $alert; ?>">
<span class="label label-success"> <?php  echo $alert;?> </span><?php }?>
**
</div>
</div>
<!-- ################################## -->	





<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['model']?> </label>
<div class="col-sm-9">
<?php if($admin_type==1){?>
<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['model']?>" id="model" name="model" value="<?php echo $model; ?>">
<?php }else{?> 
<input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['model']?>" id="model" name="model" value="<?php echo $model; ?>">
<span class="label label-success"> <?php  echo $model;?> </span><?php }?>
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sn']?> </label>
<div class="col-sm-9">


<?php if($admin_type==1){?>
<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['sn']?>" id="sn" name="sn" value="<?php echo $sn; ?>">
<?php }else{?> 
<input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['sn']?>" id="sn" name="sn" value="<?php echo $sn; ?>">
<span class="label label-success"> <?php  echo $sn; ?> </span><?php }?>


</div>
</div>								
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['vendor']?> </label>
<div class="col-sm-9">
<?php if($admin_type==1){?>
<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['vendor']?>" id="vendor" name="vendor" value="<?php echo $vendor;?>">
<?php }else{?> 
<input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['vendor']?>" id="vendor" name="vendor" value="<?php echo $vendor;?>">
<span class="label label-success"> <?php  echo $vendor; ?> </span><?php }?>

</div>
</div>
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
