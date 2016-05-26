<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('team/update', $attributes);
?>
									<div class="page-header">
										<h1>
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['admin_team'] ?></a>
									 		<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit'].' '.$admin_team[0]['admin_team_title'] ?>
											</small>
										</h1>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($category);
			}

			$countitem = count($admin_team);

			$admin_team_id = $admin_team[0]['admin_team_id'];
			$admin_team_title = $admin_team[0]['admin_team_title'];
			$team_access = json_decode($admin_team[0]['access']);
			$status = $admin_team[0]['status'];

			//Debug($team_access);

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
								<div class="form-group">
									<div class="col-xs-12 col-sm-5">
											<div class="control-group">
												<label class="control-label bolder blue"><?php echo $language['access'] ?> <?php echo $language['category'] ?></label>
<?php
			if($category){
					for($i=0;$i<count($category);$i++){
							$category_id = $category[$i]['category_id_map'];
							$category_name = $category[$i]['category_name'];

							$checked = '';
							if($team_access)
							foreach($team_access as $arr => $val){
									if($category_id == $val) $checked = "checked";
							}

							echo '<div class="checkbox">
													<label>
														<input name="category_id[]" class="ace ace-checkbox-2" type="checkbox" value="'.$category_id.'" '.$checked.'>
														<span class="lbl"> '.$category_name.'</span>
													</label>
												</div>';
					}
			}
?>
												<!-- <div class="checkbox">
													<label>
														<input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox">
														<span class="lbl"> choice 3</span>
													</label>
												</div>

												<div class="checkbox">
													<label class="block">
														<input name="form-field-checkbox" disabled="" type="checkbox" class="ace">
														<span class="lbl"> disabled</span>
													</label>
												</div> -->

											</div>
									</div>
							</div>

								<input type="hidden" name="admin_team_id" value="<?php echo $admin_team_id;?>">
								<input type="hidden" name="admin_team_title" value="<?php echo $admin_team_title;?>">
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
