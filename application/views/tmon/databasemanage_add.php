<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$mainmenu =  $this->uri->segment(3);
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('databasemanage/save', $attributes);
?>
									<div class="page-header">
										<h1>
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['databasemanage'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['add']?>
											</small>
										</h1>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($web_menu);
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
									<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['title']?> TH</span></label>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['title']?> <?php echo $language['databasemanage'] ?> (TH)" id="condition_group_name_th" name="condition_group_name_th">   
											<?php //echo 'ระบบสั่งอุปกรณ์ทำงาน';//echo $language['hwcontrols']?>
										</div>
									</div>
									<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['title']?> EN</span></label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['title']?> <?php echo $language['databasemanage'] ?> (EN)" id="condition_group_name_en" name="condition_group_name_en" value="">   <?php // echo 'databasemanage Control Auto works';//echo $language['hwcontrols']; ?>
										</div>
									</div>
									
									<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['start']?></span></label>

									  <div class="col-sm-9">
									  <?php echo $language['hour']?> 
									    <select name="hour_start">
										  <option value="00"selected="selected">00</option>
									      <option value="01">01</option>
									      <option value="02">02</option>
									      <option value="03">03</option>
									      <option value="04">04</option>
									      <option value="05">05</option>
									      <option value="06">06</option>
									      <option value="07">07</option>
									      <option value="08">08</option>
									      <option value="09">09</option>
									      <option value="10">10</option>
									      <option value="11">11</option>
									      <option value="12">12</option>
									      <option value="13">13</option>
									      <option value="14">14</option>
									      <option value="15">15</option>
									      <option value="16">16</option>
									      <option value="17">17</option>
									      <option value="18">18</option>
									      <option value="19">19</option>
									      <option value="10">20</option>
									      <option value="21">21</option>
									      <option value="22">22</option>
									      <option value="23">23</option>
                                        </select>
									   
									   <?php echo ' - '.$language['minute']?> 
									   <select name="minute_start">
										  <option value="00"selected="selected">00</option>
									      <option value="01">01</option>
									      <option value="02">02</option>
									      <option value="03">03</option>
									      <option value="04">04</option>
									      <option value="05">05</option>
									      <option value="06">06</option>
									      <option value="07">07</option>
									      <option value="08">08</option>
									      <option value="09">09</option>
									      <option value="10">10</option>
									      <option value="11">11</option>
									      <option value="12">12</option>
									      <option value="13">13</option>
									      <option value="14">14</option>
									      <option value="15">15</option>
									      <option value="16">16</option>
									      <option value="17">17</option>
									      <option value="18">18</option>
									      <option value="19">19</option>
									      <option value="10">20</option>
									      <option value="21">21</option>
									      <option value="22">22</option>
									      <option value="23">23</option>
									      <option value="24">24</option>
									      <option value="25">25</option>
									      <option value="26">26</option>
									      <option value="27">27</option>
									      <option value="28">28</option>
									      <option value="29">29</option>
									      <option value="30">30</option>
									      <option value="31">31</option>
									      <option value="32">32</option>
									      <option value="33">33</option>
									      <option value="34">34</option>
									      <option value="35">35</option>
									      <option value="36">36</option>
									      <option value="37">37</option>
									      <option value="38">38</option>
									      <option value="39">39</option>
									      <option value="40">40</option>
									      <option value="41">41</option>
									      <option value="42">42</option>
									      <option value="43">43</option>
									      <option value="44">44</option>
									      <option value="45">45</option>
									      <option value="46">46</option>
									      <option value="47">47</option>
									      <option value="48">48</option>
									      <option value="49">49</option>
									      <option value="50">50</option>
									      <option value="51">51</option>
									      <option value="52">52</option>
									      <option value="53">53</option>
									      <option value="54">54</option>
									      <option value="55">55</option>
									      <option value="56">56</option>
									      <option value="57">57</option>
									      <option value="58">58</option>
									      <option value="59">59</option>
                                       </select>
									  </div>
									</div>
									
									<?php ############?>
									
									
									<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['finish']?></span></label>

									  <div class="col-sm-9">
									  <?php echo $language['hour']?> 
									    <select name="hour_finish">
										  <option value="00">00</option>
									      <option value="01">01</option>
									      <option value="02">02</option>
									      <option value="03">03</option>
									      <option value="04">04</option>
									      <option value="05">05</option>
									      <option value="06">06</option>
									      <option value="07">07</option>
									      <option value="08">08</option>
									      <option value="09">09</option>
									      <option value="10">10</option>
									      <option value="11">11</option>
									      <option value="12">12</option>
									      <option value="13">13</option>
									      <option value="14">14</option>
									      <option value="15">15</option>
									      <option value="16">16</option>
									      <option value="17">17</option>
									      <option value="18">18</option>
									      <option value="19">19</option>
									      <option value="10">20</option>
									      <option value="21">21</option>
									      <option value="22">22</option>
									      <option value="23"selected="selected">23</option>
                                        </select>
									   
									   <?php echo ' - '.$language['minute']?> 
									   <select name="minute_finish">
										  <option value="00">00</option>
									      <option value="01">01</option>
									      <option value="02">02</option>
									      <option value="03">03</option>
									      <option value="04">04</option>
									      <option value="05">05</option>
									      <option value="06">06</option>
									      <option value="07">07</option>
									      <option value="08">08</option>
									      <option value="09">09</option>
									      <option value="10">10</option>
									      <option value="11">11</option>
									      <option value="12">12</option>
									      <option value="13">13</option>
									      <option value="14">14</option>
									      <option value="15">15</option>
									      <option value="16">16</option>
									      <option value="17">17</option>
									      <option value="18">18</option>
									      <option value="19">19</option>
									      <option value="10">20</option>
									      <option value="21">21</option>
									      <option value="22">22</option>
									      <option value="23">23</option>
									      <option value="24">24</option>
									      <option value="25">25</option>
									      <option value="26">26</option>
									      <option value="27">27</option>
									      <option value="28">28</option>
									      <option value="29">29</option>
									      <option value="30">30</option>
									      <option value="31">31</option>
									      <option value="32">32</option>
									      <option value="33">33</option>
									      <option value="34">34</option>
									      <option value="35">35</option>
									      <option value="36">36</option>
									      <option value="37">37</option>
									      <option value="38">38</option>
									      <option value="39">39</option>
									      <option value="40">40</option>
									      <option value="41">41</option>
									      <option value="42">42</option>
									      <option value="43">43</option>
									      <option value="44">44</option>
									      <option value="45">45</option>
									      <option value="46">46</option>
									      <option value="47">47</option>
									      <option value="48">48</option>
									      <option value="49">49</option>
									      <option value="50">50</option>
									      <option value="51">51</option>
									      <option value="52">52</option>
									      <option value="53">53</option>
									      <option value="54">54</option>
									      <option value="55">55</option>
									      <option value="56">56</option>
									      <option value="57">57</option>
									      <option value="58">58</option>
									      <option value="59"selected="selected">59</option>
                                       </select>
									   
									   
									

								
									  </div>
									</div>
								<?php ############?>
								 
   
									<input type="hidden" name="day_start" value="Sun">
									<input type="hidden" name="day_finish" value="Sat">
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"> </label>

									<div class="col-sm-9">
									<p>
									<span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['Sun']?></span>
									</p>
									<label class="radio-inline"><input name="Sun" type="radio" class="grey" value="1" checked="checked"><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Sun" class="grey"><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['Mon']?></span>
									</p>
									<label class="radio-inline"><input name="Mon" type="radio" class="grey" value="1" checked="checked"><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Mon" class="grey"><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['Tue']?></span>
									</p>
									<label class="radio-inline"><input name="Tue" type="radio" class="grey" value="1" checked="checked"><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Tue" class="grey"><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-info arrowed-in arrowed-in-right"><?php echo $language['Wed']?></span>
									</p>
									<label class="radio-inline"><input name="Wed" type="radio" class="grey" value="1" checked="checked"><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Wed" class="grey"><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-default arrowed-in arrowed-in-right"><?php echo $language['Thu']?></span>
									</p>
									<label class="radio-inline"><input name="Thu" type="radio" class="grey" value="1" checked="checked"><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Thu" class="grey"><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-inverse arrowed-in arrowed-in-right"><?php echo $language['Fri']?></span>
									</p>
									<label class="radio-inline"><input name="Fri" type="radio" class="grey" value="1" checked="checked"><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Fri" class="grey"><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['Sat']?></span>
									</p>
									<label class="radio-inline"><input name="Sat" type="radio" class="grey" value="1" checked="checked"><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Sat" class="grey"><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
								<?php ############?>
 	</div>
</div>
									 
									
									
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['date']?></span></label>

									  <div class="col-sm-9">
									  <?php echo $language['start'].$language['date']?> 
									    <select name="date_start">
									      <option value="1"selected="selected">1</option>
									      <option value="2">2</option>
									      <option value="3">3</option>
									      <option value="4">4</option>
									      <option value="5">5</option>
									      <option value="6">6</option>
									      <option value="7">7</option>
									      <option value="8">8</option>
									      <option value="9">9</option>
									      <option value="10">10</option>
									      <option value="11">11</option>
									      <option value="12">12</option>
									      <option value="13">13</option>
									      <option value="14">14</option>
									      <option value="15">15</option>
									      <option value="16">16</option>
									      <option value="17">17</option>
									      <option value="18">18</option>
									      <option value="19">19</option>
									      <option value="10">20</option>
									      <option value="21">21</option>
									      <option value="22">22</option>
									      <option value="23">23</option>
									      <option value="24">24</option>
									      <option value="25">25</option>
									      <option value="26">26</option>
									      <option value="27">27</option>
									      <option value="28">28</option>
									      <option value="29">29</option>
									      <option value="30">30</option>
									      <option value="31">31</option>
                                       </select>
									   
									   <?php echo $language['finish'].$language['date']?> 
									   <select name="date_finish">
									      <option value="1">1</option>
									      <option value="2">2</option>
									      <option value="3">3</option>
									      <option value="4">4</option>
									      <option value="5">5</option>
									      <option value="6">6</option>
									      <option value="7">7</option>
									      <option value="8">8</option>
									      <option value="9">9</option>
									      <option value="10">10</option>
									      <option value="11">11</option>
									      <option value="12">12</option>
									      <option value="13">13</option>
									      <option value="14">14</option>
									      <option value="15">15</option>
									      <option value="16">16</option>
									      <option value="17">17</option>
									      <option value="18">18</option>
									      <option value="19">19</option>
									      <option value="10">20</option>
									      <option value="21">21</option>
									      <option value="22">22</option>
									      <option value="23">23</option>
									      <option value="24">24</option>
									      <option value="25">25</option>
									      <option value="26">26</option>
									      <option value="27">27</option>
									      <option value="28">28</option>
									      <option value="29">29</option>
									      <option value="30">30</option>
									      <option value="31"selected="selected">31</option>
                                       </select>
									  </div>
									</div>
									
									<?php ############?>
									
									
									<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['month']?></span></label>

									  <div class="col-sm-9">
									  <?php echo $language['start'].$language['month']?> 
									    <select name="month_start">
									      <option value="1"selected="selected">1</option>
									      <option value="2">2</option>
									      <option value="3">3</option>
									      <option value="4">4</option>
									      <option value="5">5</option>
									      <option value="6">6</option>
									      <option value="7">7</option>
									      <option value="8">8</option>
									      <option value="9">9</option>
									      <option value="10">10</option>
									      <option value="11">11</option>
									      <option value="12">12</option>
                                       </select>
									   <?php echo $language['finish'].$language['month']?> 
									   <select name="month_finish">
									      <option value="1">1</option>
									      <option value="2">2</option>
									      <option value="3">3</option>
									      <option value="4">4</option>
									      <option value="5">5</option>
									      <option value="6">6</option>
									      <option value="7">7</option>
									      <option value="8">8</option>
									      <option value="9">9</option>
									      <option value="10">10</option>
									      <option value="11">11</option>
									      <option value="12"selected="selected">12</option>
                                       </select>
									  </div>
									</div>
									
									<?php ############?>
									
									

									
									 
									
									<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['status']?></span></label>

										<div class="col-xs-3">
													<label>
														<!-- <input name="switch-field-1" class="ace ace-switch" type="checkbox"  name="status" <?php if($cat_arr[0]['status'] == 1) echo 'value=1 checked'?>/> -->
														<input type="checkbox" name="status" id="cat_status" class="ace ace-switch ace-switch-5" <?php echo 'value=1 checked';?>>

														<span class="lbl"></span>
													</label>
									  </div>
									  </div>
									</div>
								<?php ############?>
								
								
								<input type="hidden" name="condition_group_id2" value="0">
								 
								 
							<div style="clear: both;"></div>
									<div class="clearfix form-actions">
									  <div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												<?php echo $language['save']?>
											</button>
											<input type="reset" name="Reset" value="<?php echo $language['reset']?>" class="btn btn-yellow"/>
										</div>
									</div>
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
<script type="text/javascript">
$( document ).ready(function() {
<?php
		if($admin_team)		
				for($key=0;$key<$maxcat;$key++){
						
						$title = $admin_team[$key]['admin_team_title'];
?>
		$('#status<?=$admin_team[$key]['admin_team_id']?>').on('click', function() {
				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
				
				//alert($(this).attr('id'));			
				//alert($(this).val());

				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('databasemanage/status/'.$admin_team[$key]['admin_team_id'])?>",
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

		$('#bootbox-confirm<?=$admin_team[$key]['admin_team_id']?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('databasemanage/delete/'.$admin_team[$key]['admin_team_id'])?>';
						}
					});
		});

		$('#bx-confirm<?=$admin_team[$key]['admin_team_id']?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('databasemanage/delete/'.$admin_team[$key]['admin_team_id'])?>';
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