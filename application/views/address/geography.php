<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($geography);		
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
								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php echo $language['geography'] ?></h3>
										<div class="table-header">
											<?php //echo $language['geography'] ?>
										</div>

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($geography );
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
	echo form_open('geography', $attributes);
?>				
											<table width="100%" class="table table-striped table-bordered table-hover" id="sample-table-2">
												<thead>
													<tr>
														<th width="6%">ID</th>
														<th width="6%"><?php echo $language['no'] ?></th>
														<th width="70%"><?php echo $language['name'] ?></th>
														<th width="15%" class="hidden-480"><?php echo $language['province'] ?></th>
													</tr>
												</thead>



	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

				$i=1;
				//$maxcat = count($geography);
				if($geography)
				for($key=0;$key<$maxcat;$key++){
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
										<input type="checkbox" class="ace" name="selectid[]" value="<?php echo $geography[$key]['geo_id'] ?>"/>
										<span class="lbl"></span>
								</label>
						</td> -->
						<td><?=$geography[$key]['geo_id']?></td>
						<td><?=$geography[$key]['geo_id']?><input type="hidden" class="ace" name="selectid[]" value="<?=$geography[$key]['geo_id']?>" /></td>
						<td><a href="<?php echo site_url('province/pid/'.$geography[$key]['geo_id_map']); ?>/<?=$geography[$key]['countries_id']?>"><?=$geography[$key]['geo_name']?></a> 

<?php $geo_id=$geography[$key]['geo_id_map']; 
      $provincecount = $this->Province_model->province_count_id($geo_id,$language); 
	  echo ' ('.$provincecount.')';
?>                         </td>
		 
						<td><?php echo $provincecount;?></td>
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

		$('.ace-switch').on('click', function() {
				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
		    
				$.ajax({
						type: 'POST',
						url: "<?php echo base_url('geography/status')?>",
						data: {id: res},
						cache: false,
						success: function(data){
								//alert(data)
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

<?php
		if($geography)
				for($i=0;$i<$maxcat;$i++){
?>
		$('#bootbox-confirm<?=$geography[$i]["geo_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('geography/delete/'.$geography[$i]['geo_id_map'])?>';
						}
					});
		});

		$('#bx-confirm<?=$geography[$i]["geo_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('geography/delete/'.$geography[$i]['geo_id_map'])?>';
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

<?php //echo js_asset('checkall.js'); ?>