<?php 
		$language = $this->lang->language; 
		$i=0;
		//$maxcat = count($member_type);
		//Debug($search_form);
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('member/gridview', $attributes);
		if($this->input->get('success')) $success = $this->input->get('success');
		if(!isset($search_form['sortby'])) $search_form['sortby'] = 'lastupdate_date';
##############
if(!isset($countries_id)) $countries_id = 0;
if(!isset($geography_id)) $geography_id = 2;
if(!isset($province_id)) $province_id = 0;
if(!isset($amphur_id)) $amphur_id = 0;
if(!isset($district_id)) $district_id = 0;
if(!isset($village_id)) $village_id = 0;
if(!isset($member_type)) $member_type = 0;
##############
?>
<div class="col-xs-12">
		<div class="col-xs-2">
				<a href="<?php echo site_url('member/add') ?>"><button class="btn btn-sm btn-primary" type="button">
						<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].' '.$language['member']  ?>
				</button></a> 
				<br><?=$member_all?> record
		</div>
<?php #############################?>
<div class="col-xs-2"><?php echo $countries_list ?></div>
<div class="col-xs-2"><?php echo $geography_list ?></div>
<div class="col-xs-2"><?php echo $province_list ?> </div>
<div class="col-xs-2"><?php echo $amphur_list ?>   </div>
<div class="col-xs-2"><?php echo $district_list ?> </div>
<div class="col-xs-2"><?php echo $village_list ?>  </div>
<div class="col-xs-2"><?php echo $memberstatus ?>  </div> 
<div class="col-xs-2">
<select class="form-control" id="form-field-select-1" name="gender">
					<option <? //if(!isset($this->input->post()) echo 'selected'; ?>><?php echo $language['all']?></option>
					<option value="m" <?php echo ($this->input->post('gender') =='m') ? 'selected' : '' ?>><?php echo $language['male']?></option>
					<option value="f" <?php echo ($this->input->post('gender') =='f') ? 'selected' : '' ?>><?php echo $language['female']?></option>
</select>
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
<!-- #########################-->
<!--
<div class="col-xs-2"><select class="form-control" id="form-field-select-1" name="member_type"><option value="0"><?php echo $language['member_type']?></option>
<?php
 /*
				$datamember_type = $this->input->post('member_type');
				$alltype = count($member_type);
				if($member_type)
						for($i = 0; $i < $alltype; $i++){
									$selected = ($datamember_type == $member_type[$i]['member_type_id_map']) ? 'selected' : '';
									echo '<option value="'.$member_type[$i]['member_type_id_map'].'" '.$selected.'>'.$member_type[$i]['member_type_name'].'</option>';
						}
*/
?>
			</select>
</div>
-->
<!-- #########################-->
 <div class="col-xs-1">
			 <a href="<?php echo base_url('member/listview'); ?>"><i class="ace-icon glyphicon glyphicon-list icon-only bigger-150" title="List View"></i></a>
			 
			 <a href="<?php echo base_url('member/gridview'); ?>"><i class="ace-icon glyphicon glyphicon-th icon-only bigger-150" title="Grid View"></i></a>
		    
 </div>
<div class="col-xs-1">
			<button class="btn btn-sm btn-primary" type="submit">
					<i class="ace-icon fa fa-glass align-top bigger-125"></i>Filter
			</button>
</div>
<!-- #########################-->
</div>
<?php
			// Debug($this->input->post());
			//if(function_exists('Debug')) Debug($member);
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
?>
<div class="col-xs-12">
								<div>
									<ul class="ace-thumbnails clearfix">
<?php
			$allmember = count($member_list);
			if($member_list)
					for($i=0;$i<$allmember;$i++){
								
								if(isset($member_list[$i]['avatar'])){
									//echo $member_list[$i]['avatar'];

									if($member_list[$i]['avatar'] != "" && $member_list[$i]['avatar'] != "-"){

											$avatar = 'uploads/member/'.$member_list[$i]['avatar'];
											$thumb1 = 'uploads/thumb/member/'.$member_list[$i]['avatar'];
											$thumb3 = 'uploads/thumb3/member/'.$member_list[$i]['avatar'];

											//$img_size = ' width="80" height="80" alt="80x80"';
											//$avatar = (!file_exists($thumb3)) ? $thumb1 : $thumb3;
											//if (!file_exists($thumb3)){ $img_size = ' width="170" '; }

											if (!file_exists($thumb1)){
												 $img_size = ' width="250" height="170" alt="250x170"';
											}else{
												 $avatar = $thumb1;
												 $img_size = ' width="170"';
											}

											$fulimg = 'uploads/member/'.$member_list[$i]['avatar'];

									}else{
											$fulimg = $avatar = 'theme/assets/avatars/avatar3.png';
											$thumb1 = $thumb3 = "";
											unset($img_size);
									}

								}else{
									$fulimg = $avatar = 'theme/assets/avatars/avatar3.png';
									$thumb1 = $thumb3 = "";
									unset($img_size);
								}
								$thumb = $avatar;

								$member_profile_id = $member_list[$i]['member_profile_id'];
								//$full_name = $member_list[$i]['first_name'];
								$full_name = trim($member_list[$i]['first_name'].' '.$member_list[$i]['last_name']);
								$nickname = $member_list[$i]['nick_name'];
								$member_type_id = $member_list[$i]['member_type_id'];
								$member_type_name = $member_list[$i]['member_type_name'];

								$belong_to = $member_list[$i]['belong_to'];

								//$status = ($member_list[$i]['status'] == 1) ? $language['status'] : $language['unpublish'];
								if($member_list[$i]['status'] == 1){
										$status = $language['status'];
										$status_class = 'label label-success arrowed-in';
								}else{
										$status = $language['unpublish'];
										$status_class = 'label label-danger arrowed-in';
								}
								$lastupdate_date = $member_list[$i]['lastupdate_date'];

								$url_preview = $this->config->config['www'].'/member/'.$member_type_id.'/'.$member_profile_id.'/'.RewriteTitle($member_type_name).'/'.RewriteTitle($full_name);

?>
										<li>
											<a href="<?php echo base_url().$fulimg?>" data-rel="colorbox">
												<?php //if($thumb1 != ""){ ?><img <?php if(isset($img_size)) echo $img_size?> src="<?php echo base_url($thumb)?>" /><?php //} ?>
												<div class="tags">
													<?php echo $nickname?> <?php echo $full_name?><br>
													<?php echo $language['lastupdate'].' <br>'.$lastupdate_date?><br>
													<?php echo $language['type'].' '.$member_type_name?>

													<!-- <span class="label-holder" style="max-width:170px;overflow: hidden;">
														<span class="label"><?php echo $nickname?> <?php echo $full_name?></span>
													</span>
					
													<span class="label-holder">
														<span class="label"><?php echo $language['lastupdate'].' '.$lastupdate_date?></span>
													</span>
													<span class="label-holder">
														<span class="label"><?php echo $member_type_name?></span>
													</span> -->
													<span class="label-holder">
														<span class="<?php echo $status_class ?>"><?php echo $status?></span>
													</span>

												</div>
											</a>

											<div class="tools tools-top">
												<a href="<?php echo $url_preview ?>" target=_blank>
													<i class="ace-icon fa fa-link"></i>
												</a>

												<!-- <a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a> -->

												<a href="<?=base_url('member/edit/'.$member_profile_id)?>">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="javascript:void(0);" id="bootbox-confirm<?=$member_profile_id?>" class="del-confirm" data-value="<?php echo $member_profile_id ?>" data-name="<?php echo $nickname." ".$full_name ?>" >
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li>
<?php
					
					}
?>
										<!-- <li>
											<a href="../assets/images/gallery/image-4.jpg" data-rel="colorbox">
												<img width="150" height="150" alt="150x150" src="../assets/images/gallery/thumb-4.jpg" />
												<div class="tags">
													<span class="label-holder">
														<span class="label label-info arrowed">fountain</span>
													</span>

													<span class="label-holder">
														<span class="label label-danger">recreation</span>
													</span>

												</div>
											</a>

											<div class="tools tools-top">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li> -->

									</ul>
								</div><!-- PAGE CONTENT ENDS -->
<?php
	echo form_close();
?>
</div><!-- /.col -->

<script type="text/javascript">
///////////////////////////
$( document ).ready(function() {

<?php
		if($countries_id > 0){
		$countries_id='209';
		$geography_id='2';
?>
			$('#geography_id').load('<?php echo base_url() ?>geography/list_dd/' + <?php echo $countries_id?> + '/' + <?php echo $geography_id?>);
<?php
		}
 
?>
 
////////////////////////  Country --geography	
 
		$('#countries_id').change(function( ) {
				var id = $(this).val();
				  //alert('<?php echo base_url() ?>geography/list_ddi/' + id);
				 $('#geography_id').load('<?php echo base_url() ?>geography/list_ddi/' + id);
		});		
 
////////////////////////  geography--province	

		$('#geography_id').change(function( ) {
				var id = $(this).val();
				 //alert('<?php echo base_url() ?>province/list_dd/' + id);
				 $('#province_id_map').load('<?php echo base_url() ?>province/list_dd/' + id);
		});		
////////////////////////  province---amphur		
		$('#province_id_map').change(function( ) {
				var id = $(this).val();
				//  alert('<?php echo base_url() ?>amphur/list_dd/' + id);
				 $('#amphur_id_map').load('<?php echo base_url() ?>amphur/list_dd/' + id);
		});		
////////////////////////  amphur---district		
		$('#amphur_id_map').change(function( ) {
				var id = $(this).val();
				 // alert('<?php echo base_url() ?>district/list_dd/' + id);
				 $('#district_id_map').load('<?php echo base_url() ?>district/list_dd/' + id);
		});		
////////////////////////  district---village		
		$('#district_id_map').change(function( ) {
				var id = $(this).val();
				  //alert('<?php echo base_url() ?>village/list_dd/' + id);
				 $('#village_id_map').load('<?php echo base_url() ?>village/list_dd/' + id);
		});		
////////////////////////
		$('#saveorder').on('click', function() {
				document.getElementById("jform").submit();
		});		
});
///////////////////////////
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

		$('#dataTables-member').dataTable();

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


/////////////////////////////////

</script>
<?php  echo js_asset('checkall.js'); ?>