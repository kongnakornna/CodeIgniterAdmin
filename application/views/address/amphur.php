<?php 
$language = $this->lang->language; 
$i=0;
$pid = $this->uri->segment(3);  
$geo= $this->uri->segment(4); 
$countries_id= $this->uri->segment(5); 
$base_url=base_url('geography');   
if($pid==''){  
?>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?php echo $base_url; ?>">
<?php
exit();
 } 
		$maxpid = count($amphur);
		$display_amphur = '';
        $get_province = $this->Province_model->get_province_by_id($pid,$language);
		$object = json_decode(json_encode($get_province), TRUE);
		$province_name=$object[0]['province_name'];        
	 
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
<?php if($pid>76){?>
								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('amphur/add/'.$pid.'/'.$geo) ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].$language['amphur'] ?>
								</button>
<?php }?>
								<div class="row">
									<div class="col-xs-12">


									  <h3  class="header smaller lighter blue">
                                          <a href="<?php echo site_url('province/pid/'.$geo.'/'.$countries_id.''); ?>"><?php echo $language['province']?> <?php echo $province_name;?></a>
											
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												 <?php echo $language['amphur'] ?>
											</small>
									  </h3>



				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($amphur_name, 'amphur_name');
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
	echo form_open('amphur/pid/'.$this->uri->segment(3), $attributes);
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
														<th width="73%"><?php echo $language['name'] ?></th>
														<th width="20%"><?php echo $language['district'] ?></th>
													</tr>
												</thead>



	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

				$i=1;
				//$maxpid = count($amphur);
				if($amphur)
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
						<td><?=$amphur[$key]['amphur_id']?>
								<input type="hidden" class="ace" name="selectid[]" value="<?=$amphur[$key]['amphur_id_map']?>" />
						</td>
						<td>
								<?php echo $i;?>
						</td>
						<td>
						
						
<a href="<?php echo site_url('district/pid/'.$amphur[$key]['amphur_id_map'].'/'.$pid.'/'.$geo.'/'.$countries_id); ?>">
		<?=$amphur[$key]['amphur_name']?> 
  </a>       
<?php 

      $amphur_id_map=$amphur[$key]['amphur_id_map']; 
      $districtcount = $this->District_model->district_count_id($amphur_id_map,$language); 
	  //Debug($districtcount);
	  echo ' ('.$districtcount.')';
?>  
        
       
						
						
							
							
						</td>
						<td> 
						
															<div class="hidden-sm hidden-xs action-buttons">
																<?php  echo ' ('.$districtcount.')';?>														</div>

															<div class="hidden-md hidden-lg">
																<div class="inline position-relative">
<?php  echo ' ('.$districtcount.')';?>
																</div>
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
<input type="hidden" class="ace" name="amphur_id" value="<?=$this->uri->segment(3)?>" />
<?php
	echo form_close();
?>
									  </div>
									</div>
								</div>
						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
<?php //Debug($amphur); ?>
<script type="text/javascript">
$( document ).ready(function() {
<?php
		if($amphur)		
				for($key=0;$key<$maxpid;$key++){
	
?>
		$('#status<?=$amphur[$key]['amphur_id_map']?>').on('click', function() {

				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
		    
				//alert($(this).attr('id'));
				//alert($(this).val());
				
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('amphur/status/'.$amphur[$key]['amphur_id_map'])?>",
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

		$('#bootbox-confirm<?=$amphur[$key]["amphur_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.lopidion='<?php echo base_url('amphur/delete/'.$amphur[$key]['amphur_id_map'])?>';
						}
					});
		});

		$('#bx-confirm<?=$amphur[$key]["amphur_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.lopidion='<?php echo base_url('amphur/delete/'.$amphur[$key]['amphur_id_map'])?>';
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