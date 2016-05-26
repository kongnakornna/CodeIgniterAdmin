<?php 
		$admin_type=$this->session->userdata('admin_type');
		$language = $this->lang->language; 
		$i=0;
		$district_id = $this->uri->segment(3);
		$amphur_id= $this->uri->segment(4); 
		$province_id= $this->uri->segment(5); 
		$geo= $this->uri->segment(6); 
		$countries_id= $this->uri->segment(7); 
		$maxcat = count($village);
		$display_category = '';
		$districtid = $this->uri->segment(3);
		$amphurid= $this->uri->segment(4); 
		$provinceid= $this->uri->segment(5); 
		$geoid= $this->uri->segment(6); 
		$countries_id= $this->uri->segment(7); 
$base_url=base_url('geography');   
if($districtid==''){  
?>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?php echo $base_url; ?>">
<?php
exit();
 } 
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
            
			$get_district = $this->District_model->get_district_by_id($districtid,$language);
			//Debug($get_district);
			$object = json_decode(json_encode($get_district), TRUE);
            $district=$districtname=$object[0]['district_name']; 
			/*
			 echo $countries;
			 echo '<br>';
			 echo $geon;
			 echo '<br>';
			 echo $province;
			 echo '<br>';
			 echo $amphur; 
			 echo '<br>';
			 echo $district; 
			 echo '<br>';
			*/ 
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
											<div class="col-md-12 space20">
												<div class="btn-group pull-right">
													<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
														Export <i class="fa fa-angle-down"></i>
													</button>
													<ul class="dropdown-menu dropdown-light pull-right">
														<li>
															<a href="#" class="export-pdf" data-table="#sample-table-1">
																Save as PDF
															</a>
														</li>
														<li>
															<a href="#" class="export-png" data-table="#sample-table-1">
																Save as PNG
															</a>
														</li>
														<li>
															<a href="#" class="export-csv" data-table="#sample-table-1">
																Save as CSV
															</a>
														</li>
														<li>
															<a href="#" class="export-txt" data-table="#sample-table-1">
																Save as TXT
															</a>
														</li>
														<li>
															<a href="#" class="export-xml" data-table="#sample-table-1">
																Save as XML
															</a>
														</li>
														<li>
															<a href="#" class="export-sql" data-table="#sample-table-1">
																Save as SQL
															</a>
														</li>
														<li>
															<a href="#" class="export-json" data-table="#sample-table-1">
																Save as JSON
															</a>
														</li>
														<li>
															<a href="#" class="export-excel" data-table="#sample-table-1">
																Export to Excel
															</a>
														</li>
														<li>
															<a href="#" class="export-doc" data-table="#sample-table-1">
																Export to Word
															</a>
														</li>
														<li>
															<a href="#" class="export-powerpoint" data-table="#sample-table-1">
																Export to PowerPoint
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('village/add/'.$district_id.'/'.$amphur_id.'/'.$province_id.'/'.$geo.'/'.$countries_id) ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].$language['village'] ?>
								</button>

								<div class="row">
									<div class="col-xs-12">

										<h3  class="header smaller lighter blue">
											<?php echo $language['village'] ?>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $display_category?>
											</small>
										</h3>



				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($category_name, 'category_name');
					//Debug($this->lang->language);
				}
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




<div class="table-responsive">
			
<?php
    $vurl='/'.$district_id.'/'.$amphur_id.'/'.$province_id.'/'.$geo.'/'.$countries_id;
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('village/pid/'.$vurl, $attributes);
?>
											<table width="100%" class="table table-striped table-bordered table-hover" id="sample-table-2">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th width="4%">ID</th>
														<th width="4%"><?php echo $language['no'] ?></th>
														<th width="12%"><?php echo $language['name'].$language['village'] ?></th>
														<th width="8%" class="hidden-480"><?php echo $language['moo'] ?></th>
														<th width="14%" class="hidden-480"><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i><?php echo $language['district'] ?> /<?php echo $language['postcode'] ?>  </th>
														<th width="13%"><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i><?php echo $language['amphur'] ?></th>
														<th width="13%"> <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i> <?php echo $language['province'] ?> </th>
														<th width="12%"> <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i> <?php echo $language['geography'] ?> </th>
														<th width="12%"> <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i> <?php echo $language['countries'] ?> </th>
														<th width="8%"><?php echo $language['action'] ?></th>
													</tr>
												</thead>



	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

				$i=1;
				//$maxcat = count($village);
				if($village)
				for($key=0;$key<$maxcat;$key++){
				$village_id_map=$village[$key]['village_id_map'];
				$village_id=$village[$key]['village_id'];
						//if(trim($memberlist[$key]->_domain) != ""){

							//$displayexpire = ($displaydate < 0) ? '<span style="color:red">'.$expire_date.'</span>' : $expire_date;
							/*if($memberlist[$key]->_admin_type_id == 1){
								$admin_type_id = "Superadmin";
							}else if($memberlist[$key]->_admin_type_id == 2){
								$admin_type_id = "Admin";
							}else if($memberlist[$key]->_admin_type_id == 3){
								$admin_type_id = "Manager";
							}else
								$admin_type_id = "Web content";*/
?>
		<tr>
						<!-- <td class="center">
								<label class="position-relative">
										<input type="checkbox" class="ace" />
										<span class="lbl"></span>
								</label>
						</td> -->
						<td> <?=$village[$key]['village_id_map']?></td>
						<td> <?php echo $i;?></td>
						<td><?=$village[$key]['village_name']?></td>
						<td><?=$village[$key]['village_moo']?></td>
						<td><?php   echo $district; 
									$vamphur_id=$village[$key]['district_id']; 
            						$get_zipcode = $this->Village_model->zipcode_count_id($vamphur_id,$language);
									#Debug($get_zipcode);
									$object = json_decode(json_encode($get_zipcode), TRUE);
            						$zipcode=$object[0]['zipcode']; 
									echo '('.$zipcode.')';		
						 ?></td>
						<td><?php   echo $amphur;  ?></td>
						<td><?php   echo $province; ?></td>
						<td><?php   echo $geon; ?></td>
						<td><?php   echo $countries; ?></td>
						<td> 
						
	<div class="btn-group">
	<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <span class="caret"></span></a>
	<ul role="menu" class="dropdown-menu pull-right">
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="<?php echo site_url('village/edit/'.$village_id_map.$vurl); ?>">
				<i class="fa fa-edit"></i> <?php $edit=$language['edit']; echo "<b><font color='blue'> $edit </font></b>";?>
			</a>
	 	</li>
		<?php if($admin_type==1){?>
		<li role="presentation">
		<a role="menuitem" tabindex="-1" href="#"id="bx-confirm<?=$village[$key]['village_id_map']?>"class="tooltip-error" data-rel="tooltip" title="Delete">
		<i class="fa fa-times"></i><?php $delete=$language['delete'];echo "<b><font color='red'> $delete </font></b>";?></a>
		</li>
		<?php }?> 
	</ul>
</div>
																					</td>
		</tr>
							<!-- 
									<td> &nbsp;<a href="<?php echo site_url('domains/show/'.$memberlist[$key]->_did); ?>"><b class="icon-pencil "></b> Edit</a> </td>
							</tr> -->
<?
							$i++;
						//}
				}
?>
	</tbody>
</table>
<input type="hidden" class="ace" name="category_id" value="<?=$this->uri->segment(3)?>" />
<?php
	echo form_close();
?>
									  </div>
									</div>
								</div>
						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
<?php //Debug($village); ?>
<script type="text/javascript">
$( document ).ready(function() {
<?php
		if($village)		
				for($key=0;$key<$maxcat;$key++){
	
?>
		$('#status<?=$village[$key]['village_id_map']?>').on('click', function() {

				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
		    
				//alert($(this).attr('id'));
				//alert($(this).val());
				
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('village/status/'.$village[$key]['village_id_map'].$vurl)?>",
					//data: {id: res},
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

		$('#bootbox-confirm<?=$village[$key]["village_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('village/delete/'.$village[$key]['village_id_map'])?>';
						}
					});
		});

		$('#bx-confirm<?=$village[$key]["village_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('village/delete/'.$village[$key]['village_id_map'])?>';
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