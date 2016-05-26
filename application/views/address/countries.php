<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($countries);
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
										<h3 class="header smaller lighter blue"><?php echo $language['countries'] ?></h3>
										<div class="table-header">
											<?php echo $language['countries'] ?>
										</div>

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($countries );
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
 
				<div>
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('countries', $attributes);
?>				
											<table width="100%" class="table table-striped table-bordered table-hover" id="sample-table-2">
												<thead>
													<tr>
														<th width="7%"><?php echo $language['no'] ?></th>
														<th width="82%"><?php echo $language['countries'] ?></th>
                                                    </tr>
												</thead>



	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

				$i=0;
				//$maxcat = count($countries);
				if($countries)
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
										<input type="checkbox" class="ace" name="selectid[]" value="<?php echo $countries[$key]['countries_id'] ?>"/>
										<span class="lbl"></span>
								</label>
						</td> -->
						<td><?=$countries[$key]['countries_id']?><input type="hidden" class="ace" name="selectid[]" value="<?=$countries[$key]['countries_id']?>" /></td>
						<td><a href="<?php echo site_url('geography'); ?>"><?=$countries[$key]['countries_name']?></a></td>
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
						url: "<?php echo base_url('countries/status')?>",
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
		if($countries)
				for($i=0;$i<$maxcat;$i++){
?>
		$('#bootbox-confirm<?=$countries[$i]["countries_id"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('countries/delete/'.$countries[$i]['countries_id'])?>';
						}
					});
		});

		$('#bx-confirm<?=$countries[$i]["countries_id"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('countries/delete/'.$countries[$i]['countries_id'])?>';
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