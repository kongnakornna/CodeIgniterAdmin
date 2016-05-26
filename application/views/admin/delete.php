<?php 
         ####  session ######
        $user_name=$this->session->userdata('user_name');
		$user_id=$this->session->userdata('admin_id');
		$admin_type=$this->session->userdata('admin_type');
		$name=$this->session->userdata('name');
		$lastname=$this->session->userdata('lastname');
		$email=$this->session->userdata('email');
         ####  session ######
		$language = $this->lang->language; 
 
		$i=0;
		$gen_url = base_url('json/gen_nav');
        if($admin_type=='1'){
		#Debug($newslist);
		#Debug($columnlist);
		#Debug($gallerylist);
		#Debug($vdolist);
		}//die();
?>
<div class="col-xs-12">

					<div class="page-content-area">
						<div class="page-header">
							<h1><?php 
							$modules=$language['modules'];
							echo " <span style=\"color: #030;\">$modules</span> "; 
							 ?>  
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<!-- (single &amp; multiple) --> <?php echo $language['delete'] ?> 
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<?php
											//Debug(json_decode($news_th));
									?>
<?php
		if($memberlist){
?>
									<div class="col-sm-12">
										<div class="widget-box widget-color-red">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller"><?php echo $language['member"'] ?></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">

														<?php 
														//Debug($memberlist);
														if($memberlist)
																for($i=0;$i<count($memberlist);$i++){
																		echo '<div class="clearfix">';
																		echo $memberlist[$i]->_admin_username.' '.$memberlist[$i]->_admin_email;
																		echo '<a href=""><span style="float:right;" class="delete">Delete</span></a>';
																		echo '</div>';
																}
														?>
													
												</div>
											</div>
										</div>
									</div>
<?php
		}
?>
									<div class="col-sm-12">
										<div class="widget-box widget-color-red">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller"><?php echo $language['news'] ?></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
														<table class="table-responsive table table-striped table-bordered table-hover  dataTable no-footer">
																		<tr>
																			<th><?php echo $language['no'] ?>.</th>
																			<th></th>
																			<th><?php echo $language['title'] ?></th>
																			<th><?php echo $language['category_name'] ?></th>
																			<th><?php echo $language['create_date'] ?></th>
																			<th><?php echo $language['action'] ?></th>
																		</tr>
<?php 
														$type = 1;
														if($newslist)
																for($i=0;$i<count($newslist);$i++){
																		$number = $i+1;

																		$news_id = $newslist[$i]['news_id2'];
																		$create_date = $newslist[$i]['create_date'];
																		$folder = $newslist[$i]['folder'];
																		$file_name = $newslist[$i]['file_name'];
																		if($file_name != '') $img = '<img src="uploads/thumb/'.$folder.'/'.$file_name.'" width="50" border="0" alt="">';
																		else $img = '';

																		//$restore = site_url('admin_delete/restore_news/'.$news_id);
																		//$delete = site_url('admin_delete/delete_news/'.$news_id);
																		$a_href = "javascript:void(0);";
																		$sendtitle = URLTitle($newslist[$i]['title']);

																		echo '<tr>
																			<td>'.$number.'.) </td>
																			<td>'.$img.'</td>
																			<td>'.$newslist[$i]['title'].'</td>
																			<td>'.$newslist[$i]['category_name'].'</td>
																			<td>'.$create_date.'</td>
																			<td algin="center">

																				<a href="'.$a_href.'" data-value="'.$news_id.'" data-type="'.$type.'" data-title="'.$sendtitle.'" class="green  restore-confirm" id="bootbox-restore-confirm'.$news_id.'"><span style="float:left;" class="restore">Restore</span></a>

																				<a href="'.$a_href.'" data-value="'.$news_id.'" data-type="'.$type.'" data-title="'.$sendtitle.'" class="red del-confirm" id="bootbox-confirm'.$news_id.'"><span style="float:right;" class="delete">Delete</span></a>
																			</td>
																		</tr>';

																}
?>													
														</table>
												</div>
											</div>
										</div>
									</div>

									<div class="col-sm-12">
										<div class="widget-box widget-color-red">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller"><?php echo $language['column'] ?></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
														<table class="table-responsive table table-striped table-bordered table-hover  dataTable no-footer">
																		<tr>
																			<th><?php echo $language['no'] ?>.</th>
																			<th></th>
																			<th><?php echo $language['title'] ?></th>
																			<th><?php echo $language['category_name'] ?></th>
																			<th><?php echo $language['create_date'] ?></th>
																			<th><?php echo $language['action'] ?></th>
																		</tr>
<?php 
														$type = 2;
														if($columnlist)
																for($i=0;$i<count($columnlist);$i++){
																		$number = $i+1;

																		$news_id = $columnlist[$i]['column_id2'];
																		$create_date = $columnlist[$i]['create_date'];
																		$folder = $columnlist[$i]['folder'];
																		$file_name = $columnlist[$i]['file_name'];
																		if($file_name != '') $img = '<img src="uploads/thumb/'.$folder.'/'.$file_name.'" width="50" border="0" alt="">';
																		else $img = '';

																		$a_href = "javascript:void(0);";
																		$sendtitle = URLTitle($columnlist[$i]['title']);

																		echo '<tr>
																			<td>'.$number.'.) </td>
																			<td>'.$img.'</td>
																			<td>'.$columnlist[$i]['title'].'</td>
																			<td>'.$columnlist[$i]['category_name'].'</td>
																			<td>'.$create_date.'</td>
																			<td algin="center">

																				<a href="'.$a_href.'" data-value="'.$news_id.'" data-type="'.$type.'" data-title="'.$sendtitle.'" class="green  restore-confirm" id="bootbox-restore-confirm'.$news_id.'"><span style="float:left;" class="restore">Restore</span></a>

																				<a href="'.$a_href.'" data-value="'.$news_id.'" data-type="'.$type.'" data-title="'.$sendtitle.'" class="red del-confirm" id="bootbox-confirm'.$news_id.'"><span style="float:right;" class="delete">Delete</span></a>
																			</td>
																		</tr>';

																}
?>													
														</table>
												</div>
											</div>
										</div>
									</div>


									<div class="col-sm-12">
										<div class="widget-box widget-color-red">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller"><?php echo $language['gallery'] ?></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
														<table class="table-responsive table table-striped table-bordered table-hover  dataTable no-footer">
																		<tr>
																			<th><?php echo $language['no'] ?>.</th>
																			<th></th>
																			<th><?php echo $language['title'] ?></th>
																			<th><?php echo $language['category_name'] ?></th>
																			<th><?php echo $language['create_date'] ?></th>
																			<th><?php echo $language['action'] ?></th>
																		</tr>
<?php 
														$type = 3;
														if($gallerylist)
																for($i=0;$i<count($gallerylist);$i++){
																		$number = $i+1;

																		$news_id = $gallerylist[$i]['gallery_id2'];
																		$gallery_type_id = $gallerylist[$i]['gallery_type_id'];

																		$create_date = $gallerylist[$i]['create_date'];
																		$folder = $gallerylist[$i]['folder'];
																		$file_name = $gallerylist[$i]['file_name'];
																		if($file_name != '') $img = '<img src="uploads/thumb/'.$folder.'/'.$file_name.'" width="50" border="0" alt="">';
																		else $img = '';

																		$a_href = "javascript:void(0);";
																		$sendtitle = URLTitle($gallerylist[$i]['title']);

																		echo '<tr>
																			<td>'.$number.'.) </td>
																			<td>'.$img.'</td>
																			<td>'.$gallerylist[$i]['title'].'</td>
																			<td>'.$gallerylist[$i]['gallery_type_name'].'</td>
																			<td>'.$create_date.'</td>
																			<td algin="center">

																				<a href="'.$a_href.'" data-value="'.$news_id.'" data-type="'.$type.'" data-title="'.$sendtitle.'" class="green  restore-confirm" id="bootbox-restore-confirm'.$news_id.'"><span style="float:left;" class="restore">Restore</span></a>

																				<a href="'.$a_href.'" data-value="'.$news_id.'" data-type="'.$type.'" data-title="'.$sendtitle.'" class="red del-confirm" id="bootbox-confirm'.$news_id.'"><span style="float:right;" class="delete">Delete</span></a>
																			</td>
																		</tr>';

																}
?>													
														</table>
												</div>
											</div>
										</div>
									</div>



									<div class="col-sm-12">
										<div class="widget-box widget-color-red">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller"><?php echo $language['vdo'] ?></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
														<table class="table-responsive table table-striped table-bordered table-hover  dataTable no-footer">
																		<tr>
																			<th><?php echo $language['no'] ?>.</th>
																			<th></th>
																			<th><?php echo $language['title'] ?></th>
																			<th><?php echo $language['category_name'] ?></th>
																			<th><?php echo $language['create_date'] ?></th>
																			<th><?php echo $language['action'] ?></th>
																		</tr>
<?php 
														$type = 4;
														if($vdolist)
																for($i=0;$i<count($vdolist);$i++){
																		$number = $i+1;

																		$news_id = $vdolist[$i]['video_id2'];
																		$create_date = $vdolist[$i]['create_date'];
																		$folder = $vdolist[$i]['folder'];
																		$file_name = $vdolist[$i]['file_name'];
																		if($file_name != '') $img = '<img src="uploads/thumb/'.$folder.'/'.$file_name.'" width="50" border="0" alt="">';
																		else $img = '';

																		$a_href = "javascript:void(0);";
																		$sendtitle = URLTitle($vdolist[$i]['title']);

																		echo '<tr>
																			<td>'.$number.'.) </td>
																			<td>'.$img.'</td>
																			<td>'.$vdolist[$i]['title'].'</td>
																			<td>'.$vdolist[$i]['category_name'].'</td>
																			<td>'.$create_date.'</td>
																			<td algin="center">

<a href="'.$a_href.'" data-value="'.$news_id.'" data-type="'.$type.'" data-title="'.$sendtitle.'" class="green  restore-confirm" id="bootbox-restore-confirm'.$news_id.'"><span style="float:left;" class="restore"> Restore </span></a>

<a href="'.$a_href.'" data-value="'.$news_id.'" data-type="'.$type.'" data-title="'.$sendtitle.'" class="red del-confirm" id="bootbox-confirm'.$news_id.'"><span style="float:right;" class="delete">Delete</span></a>
																			</td>
																		</tr>';

																}
?>													
														</table>
												</div>
											</div>
										</div>
									</div>


								</div>

								<script type="text/javascript">
									var $assets = "../assets";//this will be used in fuelux.tree-sampledata.js
								</script>

							</div>
						</div>
					</div>

</div>

<?php 
	echo js_asset('fuelux/data/fuelux.tree-sample-demo-data.js'); 
	echo js_asset('fuelux/fuelux.tree.min.js'); 
	//echo js_asset('checkall.js'); 
?>
<!-- <link rel="stylesheet" href="../assets/css/ace.onpage-help.css" /> -->

<script type="text/javascript">
$( document ).ready(function() {

		$('[data-rel=tooltip]').tooltip();
		$('[data-rel=popover]').popover({html:true});

		$('.del-confirm').on('click', function(){
				var id = $(this).attr('data-value');
				var type = $(this).attr('data-type');
				var title = $(this).attr('data-title');
				//alert('delete ' + id);
				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
					if(result) {
							//alert('delete id=' + id + ' : type=' + type + ' : title=' + title);
							window.location='<?php echo base_url('admin_delete/delete_news')?>/' + id + '/' + type + '/' + title;
						}
				});
		});

		$('.restore-confirm').on('click', function(){
				var id = $(this).attr('data-value');
				var type = $(this).attr('data-type');
				var title = $(this).attr('data-title');
				bootbox.confirm("<?php echo $language['are you sure to restore']?>", function(result) {
					if(result) {
							//alert('restore id=' + id + ' : type=' + type + ' : title=' + title);
							window.location='<?php echo base_url('admin_delete/restore_data')?>/' + id + '/' + type + '/' + title;
						}
				});
		});

		$('#gritter-regular').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a regular notice!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="blue">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets + '/avatars/avatar1.png',
						sticky: false,
						time: '',
						class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
					});			
					return false;
		});
			
		$('#gritter-sticky').on(ace.click_event, function(){
					var unique_id = $.gritter.add({
						title: 'This is a sticky notice!',
						text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="red">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets + '/avatars/avatar.png',
						sticky: true,
						time: '',
						class_name: 'gritter-info' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});			
					return false;
		});
			
		$('#gritter-without-image').on(ace.click_event, function(){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: 'This is a notice without an image!',
						// (string | mandatory) the text inside the notification
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="orange">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						class_name: 'gritter-success' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});			
					return false;
		});
			
		$('#gritter-max3').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a notice with a max of 3 on screen at one time!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="green">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets+'/avatars/avatar3.png',
						sticky: false,
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						class_name: 'gritter-warning' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});			
					return false;
		});
			
		$('#gritter-center').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a centered notification',
						text: 'Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-info gritter-center' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});			
					return false;
				});
				
				$('#gritter-error').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a warning notification',
						text: 'Just add a "gritter-light" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-error' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});			
					return false;
		});

		$("#gritter-remove").on(ace.click_event, function(){
					$.gritter.removeAll();
					return false;
		});
});
</script>