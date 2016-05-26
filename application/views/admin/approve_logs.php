<?php 
	$language = $this->lang->language; 
	//Debug($logs_list);
	//Debug($this->db->last_query());
	//die();
?>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<!-- <button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('admin/memberadd') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add_member'] ?>
								</button> -->

								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php echo $language['activity_logs'].' '.$language['approve'] ?></h3>
										<div class="table-header">
											<?php echo $language['activity_logs'].' '.$language['approve'] ?>
										</div>

<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($all_member);
					//Debug($memberlist);
				}
				/*echo "<pre>";
				var_dump($this);
				echo "</pre>";*/

				/*$result_object = $all_member->result_object;
				if($result_object)
					foreach($result_object as $key ){
									echo $key.'<br>';
					}*/
			
			if(isset($error)){
?>
				<div class="col-xs-12">
							<div class="alert alert-danger">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											</strong><?php echo $error?>.
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
			//Debug($logs_list);
?>
				<div>

				<form method="post" action="" id="listFrm">
											<table id="dataTables-logs" class="table-responsive table table-striped table-bordered table-hover ">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" id="checkall" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th>NO.</th>
														<th><?php echo $language['title'] ?></th>
														<th>ID</th>
														<th><?php echo $language['type'] ?></th>
														<th><?php echo $language['create_date'] ?></th>
														<!-- <th class="hidden-480"><?php echo $language['username'] ?></th>
														<th class="hidden-480">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php echo $language['update'] ?>
														</th>
														<th>Action</th> -->
													</tr>
												</thead>

	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
				$i=0;
				if($logs_list)
				foreach($logs_list as $key => $arr_field){

					$i++;
					$id = $logs_list[$key]->id;
					$ref_type = $logs_list[$key]->ref_type;
					$title = $logs_list[$key]->title;
					$create_date = $logs_list[$key]->create_date;
					/*switch($ref_type){
							case 1 : $type = 'News'; break;
							case 2 : $type = 'Column'; break;
							case 3 : $type = 'Gallery'; break;
							case 4 : $type = 'Clip'; break;
							case 5 : $type = 'Dara'; break;
							case 6 : $type = 'Programtv'; break;
							//case 7 : $type = '-'; break;
							default : $type = 'General'; break;
					
					}
					switch($action){
							case 1 : $action = $language['create']; break;
							case 2 : $action = $language['edit']; break;
							case 3 : $action = $language['delete']; break;
							case 4 : $action = $language['order']; break;
					}*/
?>
		<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $title?></td>
						<td><?php echo $id ?></td>
						<td><?php echo $ref_type ?></td>
						<td><?php echo RenDateTime($create_date)?></td>
		</tr>

<?
							//$i++;
				}
?>
	</tbody>
</table>
</form>
										</div>
									</div>
								</div>

						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->

<script type="text/javascript">
$( document ).ready(function() {
			
		$('#dataTables-logs').dataTable(); 
		$('.del-confirm').on('click', function() {				
				var v = $(this).attr('data-value');
				var title = $(this).attr('data-name');

				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
					if(result) {
							//alert(img + ' '+ v);
							AlertError('You can not ' + title + ' delete. id = '+ v);
							/*$.ajax({
									type: 'POST',
									url: "<?php echo base_url() ?>activity_logs/delete_log/" + v,
									data : { title : title},
									cache: false,
									success: function(data){
											//alert(data);
											if(data = 'Yes'){
													$('#admin_avatar').attr('style', 'display:none');
													$('#upload_avatar').attr('style', 'display:block');
											}
									}
							});*/
						}
				});
		});

});
</script>
<?php //echo js_asset('checkall.js'); ?>