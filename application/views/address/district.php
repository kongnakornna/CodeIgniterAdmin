<?php 
#################		
$language = $this->lang->language; 
$i=0;
$pid = $this->uri->segment(3);  
$amphur_id= $this->uri->segment(3); 
$province_id= $this->uri->segment(4); 
$geo= $this->uri->segment(5); 
$countries_id= $this->uri->segment(6); 
$maxpid = count($district);
$display_district = '';
$base_url=base_url('geography');   
if($pid==''){  
?>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?php echo $base_url; ?>">
<?php
exit();
 } 
 
$get_amphur = $this->Amphur_model->get_amphur_by_id($amphur_id,$language);
//Debug($get_amphur); # ดู Json
$object = json_decode(json_encode($get_amphur), TRUE); # Convert Json
$amphurname=$object[0]['amphur_name'];  # Convert Json Methon Fild      
 	 
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
<!-- 
<?php if($pid>76){?>
								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('district/add/'.$pid.'/'.$geo) ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].$language['district'] ?>
								</button>
<?php }?>
-->
								<div class="row">
									<div class="col-xs-12">


									  <h3  class="header smaller lighter blue">
                                          <a href="<?php echo site_url('amphur/pid/'.$province_id.'/'.$geo.'/'.$countries_id.''); ?>"><?php echo $language['amphur']?> <?PHP echo $amphurname;?></a>
											
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												 <?php echo $language['district'] ?>
											</small>
									  </h3>



				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($district_name, 'district_name');
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
				<div>
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('district/pid/'.$this->uri->segment(3), $attributes);
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
														<th width="7%">ID</th>
														<th width="7%"><?php echo $language['no'] ?></th>
														<th width="93%"><?php echo $language['name'] ?></th>
													</tr>
												</thead>



	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

				$i=1;
				//$maxpid = count($district);
				if($district)
				for($key=0;$key<$maxpid;$key++){
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
						<td><?=$district[$key]['district_id']?></td>
						<td><?php echo $i;?></td>
						<td>
<a href="<?php echo site_url('village/pid/'.$district[$key]['district_id_map'].'/'.$amphur_id.'/'.$province_id.'/'.$geo.'/'.$countries_id.''); ?>">
					    <?=$district[$key]['district_name']?></a>
                        
<?php 

      $district_id_map=$district[$key]['district_id_map']; 
      $districtcount = $this->Village_model->village_count_id($district_id_map,$language); 
	   #Debug($districtcount);
	  echo ' ('.$districtcount.')';
	  
  
	  
?>         
                        
                        </td>
			  </tr>
							<!-- 
									<td> &nbsp;<a href="<?php echo site_url('district/show/'.$memberlist[$key]->_did); ?>"><b class="icon-pencil "></b> Edit</a> </td>
							</tr> -->
<?
							$i++;
						//}
				}
?>
	</tbody>
</table>
<input type="hidden" class="ace" name="district_id" value="<?=$this->uri->segment(3)?>" />
<?php
	echo form_close();
?>
									  </div>
									</div>
								</div>
						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
<?php //Debug($district); ?>
<script type="text/javascript">
$( document ).ready(function() {
<?php
		if($district)		
				for($key=0;$key<$maxpid;$key++){
	
?>
		$('#status<?=$district[$key]['district_id_map']?>').on('click', function() {

				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
		    
				//alert($(this).attr('id'));
				//alert($(this).val());
				
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('district/status/'.$district[$key]['district_id_map'])?>",
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

		$('#bootbox-confirm<?=$district[$key]["district_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.lopidion='<?php echo base_url('district/delete/'.$district[$key]['district_id_map'])?>';
						}
					});
		});

		$('#bx-confirm<?=$district[$key]["district_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.lopidion='<?php echo base_url('district/delete/'.$district[$key]['district_id_map'])?>';
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