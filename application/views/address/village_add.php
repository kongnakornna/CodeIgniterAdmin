<?php
	    $language = $this->lang->language;
		$district_id = $this->uri->segment(3);
		$amphur_id= $this->uri->segment(4); 
		$province_id= $this->uri->segment(5); 
		$geo= $this->uri->segment(6); 
		$countries_id= $this->uri->segment(7); 
		$district_id = $this->uri->segment(3);
		$amphurid= $this->uri->segment(4); 
		$provinceid= $this->uri->segment(5); 
		$geoid= $this->uri->segment(6); 
		$countries_id= $this->uri->segment(7); 
		    $get_countries = $this->Countries_model->get_countries_by_id($countries_id);
			//Debug($get_countries);
			$object = json_decode(json_encode($get_countries), TRUE);
            $countries=$countriesname=$object[0]['countries_name'];
            
            $get_geography = $this->Geography_model->get_geography_by_id($geoid);
			//Debug($get_geography);
			$object = json_decode(json_encode($get_geography), TRUE);
            $geon=$geoname=$object[0]['geo_name'];
            
            $get_province = $this->Province_model->get_province_by_id($provinceid,$language);
			//Debug($get_province);
			$object = json_decode(json_encode($get_province), TRUE);
            $province=$provincename=$object[0]['province_name'];
            
            $get_amphur = $this->Amphur_model->get_amphur_by_id($amphurid,$language);
			//Debug($get_amphur);
			$object = json_decode(json_encode($get_amphur), TRUE);
            $amphur=$amphurname=$object[0]['amphur_name']; 
            
			$get_district = $this->District_model->get_district_by_id($district_id,$language);
			//Debug($get_district);
			$object = json_decode(json_encode($get_district), TRUE);
            $district=$districtname=$object[0]['district_name']; 
	
	        $get_village_id_map= $this->Village_model->get_village_id_map($language);
			 #Debug($get_village_id_map);
			
			  

?>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="village/save"> -->
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('village/save', $attributes);
?>
									<div class="page-header">
										<h4>
											<?php echo $language['village'] ?>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['add'] ?>
											</small>
										</h4>
									</div>

									<div class="col-xs-12">
										<!-- <h3 class="header smaller lighter blue"><?php echo $language['village'] ?></h3> -->
										<!-- <div class="table-header">
											<?php echo $language['village'] ?>
										</div> -->

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
		if(function_exists('Debug')){
			//Debug($village );
		}

		if(isset($error)){
?>
											<div class="alert alert-danger">
												<button data-dismiss="alert" class="close" type="button">
													<i class="ace-icon fa fa-times"></i>
												</button>
												<strong>
													<i class="ace-icon fa fa-times"></i>
													Oh snap!</strong><?php echo $error?>.
												<br>
											</div>
<?php
			}
?>
									<!-- #section:elements.form -->
									
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['moo']?>(EN)</label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['moo']?>" id="village_moo" name="village_moo">
										</div>
									</div>
									
									
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['village']?>(EN)</label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['village']?>" id="village_en" name="village_en">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['village']?>(TH)</label>

									  <div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['village']?>" id="village_th" name="village_th">
										</div>
									</div>
									
<?php ###############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['detail']?></label>

									  <div class="col-sm-9"><hr />

<?php
echo $language['countries'];echo ' : '.$countries; echo '<br>';
echo $language['geography'];echo ' : '.$geon;  echo '<br>';
echo $language['province'];echo ' : '.$province;  echo '<br>';
echo $language['amphur'];echo ' : '.$amphur;  echo '<br>';
echo $language['district'];echo ' : '.$district;  echo '<br>';
?>
<input type="hidden" name="district_id" value="<?php echo $district_id;?>">
<input type="hidden" name="amphur_id" value="<?php echo $amphurid;?>">
<input type="hidden" name="province_id" value="<?php echo $provinceid;?>">
<input type="hidden" name="geo_id" value="<?php echo $geoid;?>">
<input type="hidden" name="countries_id" value="<?php echo $countries_id;?>">



										</div>
									</div>
<?php ###############?>

									<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>

										<div class="col-xs-3">
													<label>
														<input name="status" id="status" class="ace ace-switch" type="checkbox" value=1 checked/>
														<span class="lbl"></span>
													</label>
												</div>
										</div>
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

							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
