<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
 
									<div class="page-header">
										<h4>&nbsp;&nbsp;
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['hostmedia'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['detail']?>
											</small>
										</h4>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($hostmedia_list);
			}
 			#Debug($hostmedia_list);Die();
				$host_media_id=$hostmedia_list[0]['host_media_id'];
				$host_media_id_map=$hostmedia_list[0]['host_media_id_map'];
				
				$host=$hostmedia_list[0]['host'];
				$port=$hostmedia_list[0]['port'];
				$username=$hostmedia_list[0]['username'];
				$password=$hostmedia_list[0]['password'];
				$create_date=$hostmedia_list[0]['create_date'];
				$status=$hostmedia_list[0]['status'];
				
				if($language['lang']=='en'){
				$name=$hostmedia_list[0]['host_media_name'];
				
				$host_media_name=$hostmedia_list[1]['host_media_name'];
				}else{
				$name=$hostmedia_list[1]['host_media_name'];
				$host_media_name=$hostmedia_list[1]['host_media_name'];
				}
 
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
									<!-- #section:elements.form -->
									<div class="form-group">
										<div class="col-sm-9">
											<?php echo $language['hostmediatype']?> : <?php echo $host_media_name; ?>
										</div>
									</div>
									
									<?php ############?>
									<div class="form-group">
										<div class="col-sm-9">
											<?php echo $language['name']?> : <?php echo $name;?> 
										</div>
									</div>
									
									  
									
									
								<div class="form-group">
										 
										<div class="col-sm-9">
										<?php echo $language['host']?> : <?php echo $host;?> 

										</div>
									</div>
<div class="form-group">
<div class="col-sm-9">
 <?php echo $language['port']?> : <?php echo $port;?> 
</div>
</div>
<?php ############?>				
<div class="form-group">
<div class="col-sm-9">
 <?php echo $language['username']?> : <?php echo $username;?> 
</div>
</div>
<?php ############?>				
<div class="form-group">
<div class="col-sm-9">
 <?php echo $language['password']?> : <?php echo $password;?> 
</div>
</div>
 
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->