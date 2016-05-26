<?php 
		$language = $this->lang->language; 
		$i=0;
		//$maxcat = count($member_type);
		//Debug($search_form);
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('sensorlogs/listview', $attributes);

		if(!isset($search_form['sortby'])) $search_form['sortby'] = 'lastupdate_date';
?>
<div class="col-xs-12">
		<div class="col-xs-2">
				 				<br><?=$count_all?> record
		</div>
		<div class="col-xs-2">
			<select class="form-control" id="sortby" name="sortby">
					<option value="0">-</option>
					<option value="create_date" <?php echo ($search_form['sortby'] == "create_date") ? 'selected' : '' ?>><?php echo $language['create_date']?></option>
					<option value="lastupdate_date" <?php echo ($search_form['sortby'] == "lastupdate_date") ? 'selected' : '' ?>><?php echo $language['lastupdate']?></option>
					<option value="member_profile_id_map" <?php echo ($search_form['sortby'] == "id") ? 'selected' : '' ?>>ID</option>
					<option value="first_name" <?php echo ($search_form['sortby'] == "first_name") ? 'selected' : '' ?>><?php echo $language['name']?></option>
					<option value="nick_name" <?php echo ($search_form['sortby'] == "nick_name") ? 'selected' : '' ?>><?php echo $language['nickname']?></option>
			</select>		
		</div>

		<div class="col-xs-2">
			<select class="form-control" id="form-field-select-1" name="gender">
					<option <? //if(!isset($this->input->post()) echo 'selected'; ?>><?php echo $language['all']?></option>
					<option value="m" <?php echo ($this->input->post('gender') =='m') ? 'selected' : '' ?>><?php echo $language['male']?></option>
					<option value="f" <?php echo ($this->input->post('gender') =='f') ? 'selected' : '' ?>><?php echo $language['female']?></option>
			</select>
		</div>
		<div class="col-xs-2">

			<select class="form-control" name="member-status">
					<option><?php echo $language['all']?></option>
					<option value="1" <?php if($this->input->post('member-status') == 1) echo 'selected="selected"'?> ><?php echo $language['publish']?></option>
					<option value="3" <?php if($this->input->post('member-status') == 3) echo 'selected="selected"'?> ><?php echo $language['unpublish']?></option>
			</select>	
		</div>
		<div class="col-xs-1">
			<button class="btn btn-sm btn-primary" type="submit">
					<i class="ace-icon fa fa-glass align-top bigger-125"></i>Filter
			</button>
		</div>
		<div class="col-xs-1">
			&nbsp;<a href="#<?php echo base_url('member/listview'); ?>"><i class="ace-icon glyphicon glyphicon-list icon-only bigger-150" title="List View"></i></a>
			&nbsp;<a href="<?php echo base_url('member/gridview'); ?>"><i class="ace-icon glyphicon glyphicon-th icon-only bigger-150" title="Grid View"></i></a>
		</div>
</div>
<?php
			//Debug($this->input->post());
			//if(function_exists('Debug')) Debug($news);
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
<div class="col-xs-12">
		<div>
<?php
		//	Debug($sensor_list);
?>
	<table width="100%" class="table-responsive table table-striped table-bordered table-hover " id="dataTables-sensor">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" id="checkall" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th width="4%">No.</th>
														<th width="16%">ID Log</th>
														<th width="25%">Hardware Name</th>
														<th width="15%" class="hidden-480">Sensor name</th>
														<th width="10%" class="hidden-480">Value</th>
														<th width="21%" class="hidden-480">date</th>
														<th width="9%" class="hidden-480">Hardware type</th>
													</tr>
												</thead>
	<tbody>												
<?php
			$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
			$list_page = 10;
			$number = 0;
			$allnews=$count_all;
			if($sensor_list)
					for($i=1;$i<$allnews;$i++){
								$number++;
								 $sensor_log_id=$sensor_list[$i]['sensor_log_id'];
								 $sensor_hwname=$sensor_list[$i]['sensor_hwname'];
        						 $sensor_name=$sensor_list[$i]['sensor_name'];
        						 $sensor_type=$sensor_list[$i]['sensor_type'];
        						 $sensor_value=$sensor_list[$i]['sensor_value'];
        						 $datetime_log=$sensor_list[$i]['datetime_log'];
        						 $hardware_id=$sensor_list[$i]['hardware_id'];
        						 $hardware_type_id=$sensor_list[$i]['hardware_type_id'];
        						 $hardware_name=$sensor_list[$i]['hardware_name'];
        						 $hardware_decription=$sensor_list[$i]['hardware_decription'];
        						 $hardgroup_name=$sensor_list[$i]['hardgroup_name'];
        						 $hardware_ip=$sensor_list[$i]['hardware_ip'];
        						 $port=$sensor_list[$i]['port'];
        						 $location_id=$sensor_list[$i]['location_id'];
        						 $date=$sensor_list[$i]['date'];
        						 $vendor=$sensor_list[$i]['vendor'];
        						 $sn=$sensor_list[$i]['sn'];
        						 $model=$sensor_list[$i]['status'];
        						 $status=$sensor_list[$i]['sensor_hwname'];
        						 $hardware_type_name=$sensor_list[$i]['hardware_type_name'];
?>
		<tr>

						<td><?php echo $i;?></td>
						<td><?=$sensor_log_id?></td>
						<td><?=$sensor_hwname?></td>
						<td class="hidden-480"><?=$sensor_name?></td>
						<td class="hidden-480"><?php
						if($sensor_value<'0' || $sensor_value=='0' || $sensor_value=='-127' || $sensor_value=='' ){
						echo "<b><font color='red'> $language['error']</font></b>";
						}else if($sensor_value>0){
						echo "<b><font color='green'> $sensor_name</font></b>";
						}else{
						echo "<b><font color='black'> $sensor_name</font></b>";
						}
						?></td>
						<td class="hidden-480"><?=$date?></td>
						<td class="hidden-480"><?=$hardware_type_name?></td>
		</tr>
<?php
					}
?>
	</tbody>
</table>

		</div><!-- PAGE CONTENT ENDS -->
<?php
	echo form_close();
?>
</div><!-- /.col -->

<script type="text/javascript">
jQuery(function($) {

		var $overflow = '';
		var colorbox_params = {
			rel: 'colorbox',
			reposition:true,
			scalePhotos:true,
			scrolling:false,
			previous:'<i class="ace-icon fa fa-arrow-left"></i>',
			next:'<i class="ace-icon fa fa-arrow-right"></i>',
			close:'&times;',
			current:'{current} of {total}',
			maxWidth:'100%',
			maxHeight:'100%',
			onOpen:function(){
				$overflow = document.body.style.overflow;
				document.body.style.overflow = 'hidden';
			},
			onClosed:function(){
				document.body.style.overflow = $overflow;
			},
			onComplete:function(){
				$.colorbox.resize();
			}
		};
		$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
		$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange'></i>");//let's add a custom loading icon

		$('#dataTables-sensor').dataTable();

		$('.status-buttons').on('click', function() {

				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);

				//alert('status-buttons ' + res);

				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('member/status')?>/" + res,
					//data: {id: res},
					cache: false,
					success: function(data){
							$("#msg_info").fadeOut();
							if(data == 1){
								$("#msg_success").attr('style','display:block;');
								//AlertSuccess	('Active And Generate json file.');
								AlertSuccess	('Active.');
							}else{
								$("#msg_error").attr('style','display:block;');
								AlertError('Inactive');
							}
					}
				});
		});

		$('.del-confirm').on('click', function() {				
				var id = $(this).attr('data-value');
				var name = $(this).attr('data-name');
				bootbox.confirm("<?php echo $language['are you sure to delete']?> " + name, function(result) {
					if(result) {
							//alert('<?php echo base_url('news/delete')?>/' + id + '');
							window.location='<?php echo base_url('member/delete')?>/' + id ;
						}
				});
		});

})
</script>