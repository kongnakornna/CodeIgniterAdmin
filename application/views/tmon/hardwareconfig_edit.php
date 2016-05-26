<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$mainmenu =  $this->uri->segment(3);
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('hardwareconfig/save', $attributes);
?>
									<div class="page-header">
										<h1>
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['hardwareconfig'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit']?>
											</small>
										</h1>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($hardwareconfig);
			}
					//Debug($hardwareconfig);Die();
					$countitem = count($hardwareconfig);
					//echo'$countitem='.$countitem;Die();
					$condition_group_id2=$hardwareconfig[0]['condition_group_id2'];
  					$condition_group_name_en=$hardwareconfig[0]['condition_group_name'];
                    $condition_group_name_th=$hardwareconfig[1]['condition_group_name'];
                    $hour_start=$hardwareconfig[0]['hour_start'];
                    $minute_start=$hardwareconfig[0]['minute_start'];
                    $hour_finish=$hardwareconfig[0]['hour_finish'];
                    $minute_finish=$hardwareconfig[0]['minute_finish'];
                    $day_start=$hardwareconfig[0]['day_start'];
                    $day_finish=$hardwareconfig[0]['day_finish'];
                    $date_start=$hardwareconfig[0]['date_start'];
                    $date_finish=$hardwareconfig[0]['date_finish'];
                    $month_start=$hardwareconfig[0]['month_start'];
                    $month_finish=$hardwareconfig[0]['month_finish'];
                    $Sun=$hardwareconfig[0]['Sun'];
					$Mon=$hardwareconfig[0]['Mon'];
					$Tue=$hardwareconfig[0]['Tue'];
					$Wed=$hardwareconfig[0]['Wed'];
					$Thu=$hardwareconfig[0]['Thu'];
					$Fri=$hardwareconfig[0]['Fri'];
					$Sat=$hardwareconfig[0]['Sat'];
					$status=$hardwareconfig[0]['status'];
 
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
											<input name="condition_group_name_th" type="text" class="col-xs-10 col-sm-5" id="condition_group_name_th" value="<?php echo $condition_group_name_th;?>" placeholder="<?php echo $language['title']?> <?php echo $language['hardwareconfig'] ?> (TH)"> 
											 
											<?php //echo 'ระบบสั่งอุปกรณ์ทำงาน';//echo $language['hwcontrols']?>
										</div>
									</div>
									<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['title']?> EN</span></label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['title']?> <?php echo $language['hardwareconfig'] ?> (EN)" id="condition_group_name_en" name="condition_group_name_en" value="<?php echo $condition_group_name_en;?>"> 
											 <?php  //echo 'hardwareconfig Control Auto works';//echo $language['hwcontrols']; ?>
										</div>
									</div>
									
									<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['start']?></span></label>

									  <div class="col-sm-9">
									  <?php echo $language['hour']?> 
									    <select name="hour_start">
										  <option value="00"<?php if($hour_start==00){?>selected="selected"<?php }?>>00</option>
									      <option value="01"<?php if($hour_start==01){?>selected="selected"<?php }?>>01</option>
									      <option value="02"<?php if($hour_start==02){?>selected="selected"<?php }?>>02</option>
									      <option value="03"<?php if($hour_start==03){?>selected="selected"<?php }?>>03</option>
									      <option value="04"<?php if($hour_start==04){?>selected="selected"<?php }?>>04</option>
									      <option value="05"<?php if($hour_start==05){?>selected="selected"<?php }?>>05</option>
									      <option value="06"<?php if($hour_start==06){?>selected="selected"<?php }?>>06</option>
									      <option value="07"<?php if($hour_start==07){?>selected="selected"<?php }?>>07</option>
									      <option value="08"<?php if($hour_start==08){?>selected="selected"<?php }?>>08</option>
									      <option value="09"<?php if($hour_start==09){?>selected="selected"<?php }?>>09</option>
									      <option value="10"<?php if($hour_start==10){?>selected="selected"<?php }?>>10</option>
									      <option value="11"<?php if($hour_start==11){?>selected="selected"<?php }?>>11</option>
									      <option value="12"<?php if($hour_start==12){?>selected="selected"<?php }?>>12</option>
									      <option value="13"<?php if($hour_start==13){?>selected="selected"<?php }?>>13</option>
									      <option value="14"<?php if($hour_start==14){?>selected="selected"<?php }?>>14</option>
									      <option value="15"<?php if($hour_start==15){?>selected="selected"<?php }?>>15</option>
									      <option value="16"<?php if($hour_start==16){?>selected="selected"<?php }?>>16</option>
									      <option value="17"<?php if($hour_start==17){?>selected="selected"<?php }?>>17</option>
									      <option value="18"<?php if($hour_start==18){?>selected="selected"<?php }?>>18</option>
									      <option value="19"<?php if($hour_start==19){?>selected="selected"<?php }?>>19</option>
									      <option value="10"<?php if($hour_start==20){?>selected="selected"<?php }?>>20</option>
									      <option value="21"<?php if($hour_start==21){?>selected="selected"<?php }?>>21</option>
									      <option value="22"<?php if($hour_start==22){?>selected="selected"<?php }?>>22</option>
									      <option value="23"<?php if($hour_start==23){?>selected="selected"<?php }?>>23</option>
                                        </select>
									   
									   <?php echo ' - '.$language['minute']?> 
									   <select name="minute_start">
										  <option value="00"<?php if($minute_start==00){?>selected="selected"<?php }?>>00</option>
									      <option value="01"<?php if($minute_start==01){?>selected="selected"<?php }?>>01</option>
									      <option value="02"<?php if($minute_start==02){?>selected="selected"<?php }?>>02</option>
									      <option value="03"<?php if($minute_start==03){?>selected="selected"<?php }?>>03</option>
									      <option value="04"<?php if($minute_start==04){?>selected="selected"<?php }?>>04</option>
									      <option value="05"<?php if($minute_start==05){?>selected="selected"<?php }?>>05</option>
									      <option value="06"<?php if($minute_start==06){?>selected="selected"<?php }?>>06</option>
									      <option value="07"<?php if($minute_start==07){?>selected="selected"<?php }?>>07</option>
									      <option value="08"<?php if($minute_start==08){?>selected="selected"<?php }?>>08</option>
									      <option value="09"<?php if($minute_start==09){?>selected="selected"<?php }?>>09</option>
									      <option value="10"<?php if($minute_start==10){?>selected="selected"<?php }?>>10</option>
									      <option value="11"<?php if($minute_start==11){?>selected="selected"<?php }?>>11</option>
									      <option value="12"<?php if($minute_start==12){?>selected="selected"<?php }?>>12</option>
									      <option value="13"<?php if($minute_start==13){?>selected="selected"<?php }?>>13</option>
									      <option value="14"<?php if($minute_start==14){?>selected="selected"<?php }?>>14</option>
									      <option value="15"<?php if($minute_start==15){?>selected="selected"<?php }?>>15</option>
									      <option value="16"<?php if($minute_start==16){?>selected="selected"<?php }?>>16</option>
									      <option value="17"<?php if($minute_start==17){?>selected="selected"<?php }?>>17</option>
									      <option value="18"<?php if($minute_start==18){?>selected="selected"<?php }?>>18</option>
									      <option value="19"<?php if($minute_start==19){?>selected="selected"<?php }?>>19</option>
									      <option value="10"<?php if($minute_start==20){?>selected="selected"<?php }?>>20</option>
									      <option value="21"<?php if($minute_start==21){?>selected="selected"<?php }?>>21</option>
									      <option value="22"<?php if($minute_start==22){?>selected="selected"<?php }?>>22</option>
									      <option value="23"<?php if($minute_start==23){?>selected="selected"<?php }?>>23</option>
									      <option value="24"<?php if($minute_start==24){?>selected="selected"<?php }?>>24</option>
									      <option value="25"<?php if($minute_start==25){?>selected="selected"<?php }?>>25</option>
									      <option value="26"<?php if($minute_start==26){?>selected="selected"<?php }?>>26</option>
									      <option value="27"<?php if($minute_start==27){?>selected="selected"<?php }?>>27</option>
									      <option value="28"<?php if($minute_start==28){?>selected="selected"<?php }?>>28</option>
									      <option value="29"<?php if($minute_start==29){?>selected="selected"<?php }?>>29</option>
									      <option value="30"<?php if($minute_start==30){?>selected="selected"<?php }?>>30</option>
									      <option value="31"<?php if($minute_start==31){?>selected="selected"<?php }?>>31</option>
									      <option value="32"<?php if($minute_start==32){?>selected="selected"<?php }?>>32</option>
									      <option value="33"<?php if($minute_start==33){?>selected="selected"<?php }?>>33</option>
									      <option value="34"<?php if($minute_start==34){?>selected="selected"<?php }?>>34</option>
									      <option value="35"<?php if($minute_start==35){?>selected="selected"<?php }?>>35</option>
									      <option value="36"<?php if($minute_start==36){?>selected="selected"<?php }?>>36</option>
									      <option value="37"<?php if($minute_start==37){?>selected="selected"<?php }?>>37</option>
									      <option value="38"<?php if($minute_start==38){?>selected="selected"<?php }?>>38</option>
									      <option value="39"<?php if($minute_start==39){?>selected="selected"<?php }?>>39</option>
									      <option value="40"<?php if($minute_start==40){?>selected="selected"<?php }?>>40</option>
									      <option value="41"<?php if($minute_start==41){?>selected="selected"<?php }?>>41</option>
									      <option value="42"<?php if($minute_start==42){?>selected="selected"<?php }?>>42</option>
									      <option value="43"<?php if($minute_start==43){?>selected="selected"<?php }?>>43</option>
									      <option value="44"<?php if($minute_start==44){?>selected="selected"<?php }?>>44</option>
									      <option value="45"<?php if($minute_start==45){?>selected="selected"<?php }?>>45</option>
									      <option value="46"<?php if($minute_start==46){?>selected="selected"<?php }?>>46</option>
									      <option value="47"<?php if($minute_start==47){?>selected="selected"<?php }?>>47</option>
									      <option value="48"<?php if($minute_start==48){?>selected="selected"<?php }?>>48</option>
									      <option value="49"<?php if($minute_start==49){?>selected="selected"<?php }?>>49</option>
									      <option value="50"<?php if($minute_start==50){?>selected="selected"<?php }?>>50</option>
									      <option value="51"<?php if($minute_start==51){?>selected="selected"<?php }?>>51</option>
									      <option value="52"<?php if($minute_start==52){?>selected="selected"<?php }?>>52</option>
									      <option value="53"<?php if($minute_start==53){?>selected="selected"<?php }?>>53</option>
									      <option value="54"<?php if($minute_start==54){?>selected="selected"<?php }?>>54</option>
									      <option value="55"<?php if($minute_start==55){?>selected="selected"<?php }?>>55</option>
									      <option value="56"<?php if($minute_start==56){?>selected="selected"<?php }?>>56</option>
									      <option value="57"<?php if($minute_start==57){?>selected="selected"<?php }?>>57</option>
									      <option value="58"<?php if($minute_start==58){?>selected="selected"<?php }?>>58</option>
									      <option value="59"<?php if($minute_start==59){?>selected="selected"<?php }?>>59</option>
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
										  <option value="00"<?php if($hour_finish==00){?>selected="selected"<?php }?>>00</option>
									      <option value="01"<?php if($hour_finish==01){?>selected="selected"<?php }?>>01</option>
									      <option value="02"<?php if($hour_finish==02){?>selected="selected"<?php }?>>02</option>
									      <option value="03"<?php if($hour_finish==03){?>selected="selected"<?php }?>>03</option>
									      <option value="04"<?php if($hour_finish==04){?>selected="selected"<?php }?>>04</option>
									      <option value="05"<?php if($hour_finish==05){?>selected="selected"<?php }?>>05</option>
									      <option value="06"<?php if($hour_finish==06){?>selected="selected"<?php }?>>06</option>
									      <option value="07"<?php if($hour_finish==07){?>selected="selected"<?php }?>>07</option>
									      <option value="08"<?php if($hour_finish==08){?>selected="selected"<?php }?>>08</option>
									      <option value="09"<?php if($hour_finish==09){?>selected="selected"<?php }?>>09</option>
									      <option value="10"<?php if($hour_finish==10){?>selected="selected"<?php }?>>10</option>
									      <option value="11"<?php if($hour_finish==11){?>selected="selected"<?php }?>>11</option>
									      <option value="12"<?php if($hour_finish==12){?>selected="selected"<?php }?>>12</option>
									      <option value="13"<?php if($hour_finish==13){?>selected="selected"<?php }?>>13</option>
									      <option value="14"<?php if($hour_finish==14){?>selected="selected"<?php }?>>14</option>
									      <option value="15"<?php if($hour_finish==15){?>selected="selected"<?php }?>>15</option>
									      <option value="16"<?php if($hour_finish==16){?>selected="selected"<?php }?>>16</option>
									      <option value="17"<?php if($hour_finish==17){?>selected="selected"<?php }?>>17</option>
									      <option value="18"<?php if($hour_finish==18){?>selected="selected"<?php }?>>18</option>
									      <option value="19"<?php if($hour_finish==19){?>selected="selected"<?php }?>>19</option>
									      <option value="10"<?php if($hour_finish==20){?>selected="selected"<?php }?>>20</option>
									      <option value="21"<?php if($hour_finish==21){?>selected="selected"<?php }?>>21</option>
									      <option value="22"<?php if($hour_finish==22){?>selected="selected"<?php }?>>22</option>
									      <option value="23"<?php if($hour_finish==23){?>selected="selected"<?php }?>>23</option>
                                        </select>
									   
									   <?php echo ' - '.$language['minute']?> 
									   <select name="minute_finish">
										  <option value="00"<?php if($minute_finish==00){?>selected="selected"<?php }?>>00</option>
									      <option value="01"<?php if($minute_finish==01){?>selected="selected"<?php }?>>01</option>
									      <option value="02"<?php if($minute_finish==02){?>selected="selected"<?php }?>>02</option>
									      <option value="03"<?php if($minute_finish==03){?>selected="selected"<?php }?>>03</option>
									      <option value="04"<?php if($minute_finish==04){?>selected="selected"<?php }?>>04</option>
									      <option value="05"<?php if($minute_finish==05){?>selected="selected"<?php }?>>05</option>
									      <option value="06"<?php if($minute_finish==06){?>selected="selected"<?php }?>>06</option>
									      <option value="07"<?php if($minute_finish==07){?>selected="selected"<?php }?>>07</option>
									      <option value="08"<?php if($minute_finish==08){?>selected="selected"<?php }?>>08</option>
									      <option value="09"<?php if($minute_finish==09){?>selected="selected"<?php }?>>09</option>
									      <option value="10"<?php if($minute_finish==10){?>selected="selected"<?php }?>>10</option>
									      <option value="11"<?php if($minute_finish==11){?>selected="selected"<?php }?>>11</option>
									      <option value="12"<?php if($minute_finish==12){?>selected="selected"<?php }?>>12</option>
									      <option value="13"<?php if($minute_finish==13){?>selected="selected"<?php }?>>13</option>
									      <option value="14"<?php if($minute_finish==14){?>selected="selected"<?php }?>>14</option>
									      <option value="15"<?php if($minute_finish==15){?>selected="selected"<?php }?>>15</option>
									      <option value="16"<?php if($minute_finish==16){?>selected="selected"<?php }?>>16</option>
									      <option value="17"<?php if($minute_finish==17){?>selected="selected"<?php }?>>17</option>
									      <option value="18"<?php if($minute_finish==18){?>selected="selected"<?php }?>>18</option>
									      <option value="19"<?php if($minute_finish==19){?>selected="selected"<?php }?>>19</option>
									      <option value="10"<?php if($minute_finish==20){?>selected="selected"<?php }?>>20</option>
									      <option value="21"<?php if($minute_finish==21){?>selected="selected"<?php }?>>21</option>
									      <option value="22"<?php if($minute_finish==22){?>selected="selected"<?php }?>>22</option>
									      <option value="23"<?php if($minute_finish==23){?>selected="selected"<?php }?>>23</option>
									      <option value="24"<?php if($minute_finish==24){?>selected="selected"<?php }?>>24</option>
									      <option value="25"<?php if($minute_finish==25){?>selected="selected"<?php }?>>25</option>
									      <option value="26"<?php if($minute_finish==26){?>selected="selected"<?php }?>>26</option>
									      <option value="27"<?php if($minute_finish==27){?>selected="selected"<?php }?>>27</option>
									      <option value="28"<?php if($minute_finish==28){?>selected="selected"<?php }?>>28</option>
									      <option value="29"<?php if($minute_finish==29){?>selected="selected"<?php }?>>29</option>
									      <option value="30"<?php if($minute_finish==30){?>selected="selected"<?php }?>>30</option>
									      <option value="31"<?php if($minute_finish==31){?>selected="selected"<?php }?>>31</option>
									      <option value="32"<?php if($minute_finish==32){?>selected="selected"<?php }?>>32</option>
									      <option value="33"<?php if($minute_finish==33){?>selected="selected"<?php }?>>33</option>
									      <option value="34"<?php if($minute_finish==34){?>selected="selected"<?php }?>>34</option>
									      <option value="35"<?php if($minute_finish==35){?>selected="selected"<?php }?>>35</option>
									      <option value="36"<?php if($minute_finish==36){?>selected="selected"<?php }?>>36</option>
									      <option value="37"<?php if($minute_finish==37){?>selected="selected"<?php }?>>37</option>
									      <option value="38"<?php if($minute_finish==38){?>selected="selected"<?php }?>>38</option>
									      <option value="39"<?php if($minute_finish==39){?>selected="selected"<?php }?>>39</option>
									      <option value="40"<?php if($minute_finish==40){?>selected="selected"<?php }?>>40</option>
									      <option value="41"<?php if($minute_finish==41){?>selected="selected"<?php }?>>41</option>
									      <option value="42"<?php if($minute_finish==42){?>selected="selected"<?php }?>>42</option>
									      <option value="43"<?php if($minute_finish==43){?>selected="selected"<?php }?>>43</option>
									      <option value="44"<?php if($minute_finish==44){?>selected="selected"<?php }?>>44</option>
									      <option value="45"<?php if($minute_finish==45){?>selected="selected"<?php }?>>45</option>
									      <option value="46"<?php if($minute_finish==46){?>selected="selected"<?php }?>>46</option>
									      <option value="47"<?php if($minute_finish==47){?>selected="selected"<?php }?>>47</option>
									      <option value="48"<?php if($minute_finish==48){?>selected="selected"<?php }?>>48</option>
									      <option value="49"<?php if($minute_finish==49){?>selected="selected"<?php }?>>49</option>
									      <option value="50"<?php if($minute_finish==50){?>selected="selected"<?php }?>>50</option>
									      <option value="51"<?php if($minute_finish==51){?>selected="selected"<?php }?>>51</option>
									      <option value="52"<?php if($minute_finish==52){?>selected="selected"<?php }?>>52</option>
									      <option value="53"<?php if($minute_finish==53){?>selected="selected"<?php }?>>53</option>
									      <option value="54"<?php if($minute_finish==54){?>selected="selected"<?php }?>>54</option>
									      <option value="55"<?php if($minute_finish==55){?>selected="selected"<?php }?>>55</option>
									      <option value="56"<?php if($minute_finish==56){?>selected="selected"<?php }?>>56</option>
									      <option value="57"<?php if($minute_finish==57){?>selected="selected"<?php }?>>57</option>
									      <option value="58"<?php if($minute_finish==58){?>selected="selected"<?php }?>>58</option>
									      <option value="59"<?php if($minute_finish==59){?>selected="selected"<?php }?>>59</option>
                                       </select>
									  </div>
									</div>
									
									
									
									
									<?php ############?>
									 
									<input type="hidden" name="day_start" value="<?php echo $day_start;?>">
									<input type="hidden" name="day_finish" value="<?php echo $day_finish;?>">
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"> </label>

									<div class="col-sm-9">
									<p>
									<span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['Sun']?></span>
									</p>  
									<label class="radio-inline"><input name="Sun" type="radio" class="grey" value="1" <?php if($Sun==1){?>checked="checked"<?php }?>><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Sun" class="grey"><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['Mon']?></span>
									</p>
									<label class="radio-inline"><input name="Mon" type="radio" class="grey" value="1" <?php if($Mon==1){?>checked="checked"<?php }?>><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Mon" class="grey"<?php if($Mon==0){?>checked="checked"<?php }?>><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['Tue']?></span>
									</p>
									<label class="radio-inline"><input name="Tue" type="radio" class="grey" value="1" <?php if($Tue==1){?>checked="checked"<?php }?>><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Tue" class="grey"<?php if($Tue==0){?>checked="checked"<?php }?>><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-info arrowed-in arrowed-in-right"><?php echo $language['Wed']?></span>
									</p>
									<label class="radio-inline"><input name="Wed" type="radio" class="grey" value="1" <?php if($Wed==1){?>checked="checked"<?php }?>><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Wed" class="grey"<?php if($Wed==0){?>checked="checked"<?php }?>><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-default arrowed-in arrowed-in-right"><?php echo $language['Thu']?></span>
									</p>
									<label class="radio-inline"><input name="Thu" type="radio" class="grey" value="1" <?php if($Thu==1){?>checked="checked"<?php }?>><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Thu" class="grey"<?php if($Thu==0){?>checked="checked"<?php }?>><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-inverse arrowed-in arrowed-in-right"><?php echo $language['Fri']?></span>
									</p>
									<label class="radio-inline"><input name="Fri" type="radio" class="grey" value="1" <?php if($Fri==1){?>checked="checked"<?php }?>><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Fri" class="grey"<?php if($Fri==0){?>checked="checked"<?php }?>><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
									<?php ############?>
									<p>
									<span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['Sat']?></span>
									</p>
									<label class="radio-inline"><input name="Sat" type="radio" class="grey" value="1" <?php if($Sat==1){?>checked="checked"<?php }?>><span class="label label-success arrowed-in arrowed-in-right"><?php echo $language['active']?></span></label>
									<label class="radio-inline"><input type="radio" value="0" name="Sat" class="grey"<?php if($Sat==0){?>checked="checked"<?php }?>><span class="label label-danger arrowed-in arrowed-in-right"><?php echo $language['inactive']?></span></label>
								<?php ############?>
 	</div>
</div>
			
									
									<?php ############?>
									
									
									
									
									
									
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['date']?></span></label>

									  <div class="col-sm-9">
									  <?php echo $language['start'].$language['date']?> 
									    <select name="date_start">
									      <option value="1"<?php if($date_start==1){?>selected="selected"<?php }?>>1</option>
									      <option value="2"<?php if($date_start==2){?>selected="selected"<?php }?>>2</option>
									      <option value="3"<?php if($date_start==3){?>selected="selected"<?php }?>>3</option>
									      <option value="4"<?php if($date_start==4){?>selected="selected"<?php }?>>4</option>
									      <option value="5"<?php if($date_start==5){?>selected="selected"<?php }?>>5</option>
									      <option value="6"<?php if($date_start==6){?>selected="selected"<?php }?>>6</option>
									      <option value="7"<?php if($date_start==7){?>selected="selected"<?php }?>>7</option>
									      <option value="8"<?php if($date_start==8){?>selected="selected"<?php }?>>8</option>
									      <option value="9"<?php if($date_start==9){?>selected="selected"<?php }?>>9</option>
									      <option value="10"<?php if($date_start==10){?>selected="selected"<?php }?>>10</option>
									      <option value="11"<?php if($date_start==11){?>selected="selected"<?php }?>>11</option>
									      <option value="12"<?php if($date_start==12){?>selected="selected"<?php }?>>12</option>
									      <option value="13"<?php if($date_start==13){?>selected="selected"<?php }?>>13</option>
									      <option value="14"<?php if($date_start==14){?>selected="selected"<?php }?>>14</option>
									      <option value="15"<?php if($date_start==15){?>selected="selected"<?php }?>>15</option>
									      <option value="16"<?php if($date_start==16){?>selected="selected"<?php }?>>16</option>
									      <option value="17"<?php if($date_start==17){?>selected="selected"<?php }?>>17</option>
									      <option value="18"<?php if($date_start==18){?>selected="selected"<?php }?>>18</option>
									      <option value="19"<?php if($date_start==19){?>selected="selected"<?php }?>>19</option>
									      <option value="20"<?php if($date_start==20){?>selected="selected"<?php }?>>20</option>
									      <option value="21"<?php if($date_start==21){?>selected="selected"<?php }?>>21</option>
									      <option value="22"<?php if($date_start==22){?>selected="selected"<?php }?>>22</option>
									      <option value="23"<?php if($date_start==23){?>selected="selected"<?php }?>>23</option>
									      <option value="24"<?php if($date_start==24){?>selected="selected"<?php }?>>24</option>
									      <option value="25"<?php if($date_start==25){?>selected="selected"<?php }?>>25</option>
									      <option value="26"<?php if($date_start==26){?>selected="selected"<?php }?>>26</option>
									      <option value="27"<?php if($date_start==27){?>selected="selected"<?php }?>>27</option>
									      <option value="28"<?php if($date_start==28){?>selected="selected"<?php }?>>28</option>
									      <option value="29"<?php if($date_start==29){?>selected="selected"<?php }?>>29</option>
									      <option value="30"<?php if($date_start==30){?>selected="selected"<?php }?>>30</option>
									      <option value="31"<?php if($date_start==31){?>selected="selected"<?php }?>>31</option>
                                       </select>
									   
									   <?php echo $language['finish'].$language['date']?> 
									   <select name="date_finish">
									      <option value="1"<?php if($date_finish==1){?>selected="selected"<?php }?>>1</option>
									      <option value="2"<?php if($date_finish==2){?>selected="selected"<?php }?>>2</option>
									      <option value="3"<?php if($date_finish==3){?>selected="selected"<?php }?>>3</option>
									      <option value="4"<?php if($date_finish==4){?>selected="selected"<?php }?>>4</option>
									      <option value="5"<?php if($date_finish==5){?>selected="selected"<?php }?>>5</option>
									      <option value="6"<?php if($date_finish==6){?>selected="selected"<?php }?>>6</option>
									      <option value="7"<?php if($date_finish==7){?>selected="selected"<?php }?>>7</option>
									      <option value="8"<?php if($date_finish==8){?>selected="selected"<?php }?>>8</option>
									      <option value="9"<?php if($date_finish==9){?>selected="selected"<?php }?>>9</option>
									      <option value="10"<?php if($date_finish==10){?>selected="selected"<?php }?>>10</option>
									      <option value="11"<?php if($date_finish==11){?>selected="selected"<?php }?>>11</option>
									      <option value="12"<?php if($date_finish==12){?>selected="selected"<?php }?>>12</option>
									      <option value="13"<?php if($date_finish==13){?>selected="selected"<?php }?>>13</option>
									      <option value="14"<?php if($date_finish==14){?>selected="selected"<?php }?>>14</option>
									      <option value="15"<?php if($date_finish==15){?>selected="selected"<?php }?>>15</option>
									      <option value="16"<?php if($date_finish==16){?>selected="selected"<?php }?>>16</option>
									      <option value="17"<?php if($date_finish==17){?>selected="selected"<?php }?>>17</option>
									      <option value="18"<?php if($date_finish==18){?>selected="selected"<?php }?>>18</option>
									      <option value="19"<?php if($date_finish==19){?>selected="selected"<?php }?>>19</option>
									      <option value="20"<?php if($date_finish==20){?>selected="selected"<?php }?>>20</option>
									      <option value="21"<?php if($date_finish==21){?>selected="selected"<?php }?>>21</option>
									      <option value="22"<?php if($date_finish==22){?>selected="selected"<?php }?>>22</option>
									      <option value="23"<?php if($date_finish==23){?>selected="selected"<?php }?>>23</option>
									      <option value="24"<?php if($date_finish==24){?>selected="selected"<?php }?>>24</option>
									      <option value="25"<?php if($date_finish==25){?>selected="selected"<?php }?>>25</option>
									      <option value="26"<?php if($date_finish==26){?>selected="selected"<?php }?>>26</option>
									      <option value="27"<?php if($date_finish==27){?>selected="selected"<?php }?>>27</option>
									      <option value="28"<?php if($date_finish==28){?>selected="selected"<?php }?>>28</option>
									      <option value="29"<?php if($date_finish==29){?>selected="selected"<?php }?>>29</option>
									      <option value="30"<?php if($date_finish==30){?>selected="selected"<?php }?>>30</option>
									      <option value="31"<?php if($date_finish==31){?>selected="selected"<?php }?>>31</option>
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
									      <option value="1"<?php if($month_start==1){?>selected="selected"<?php }?>>1</option>
									      <option value="2"<?php if($month_start==2){?>selected="selected"<?php }?>>2</option>
									      <option value="3"<?php if($month_start==3){?>selected="selected"<?php }?>>3</option>
									      <option value="4"<?php if($month_start==4){?>selected="selected"<?php }?>>4</option>
									      <option value="5"<?php if($month_start==5){?>selected="selected"<?php }?>>5</option>
									      <option value="6"<?php if($month_start==6){?>selected="selected"<?php }?>>6</option>
									      <option value="7"<?php if($month_start==7){?>selected="selected"<?php }?>>7</option>
									      <option value="8"<?php if($month_start==8){?>selected="selected"<?php }?>>8</option>
									      <option value="9"<?php if($month_start==9){?>selected="selected"<?php }?>>9</option>
									      <option value="10"<?php if($month_start==10){?>selected="selected"<?php }?>>10</option>
									      <option value="11"<?php if($month_start==11){?>selected="selected"<?php }?>>11</option>
									      <option value="12"<?php if($month_start==12){?>selected="selected"<?php }?>>12</option>
                                       </select>
									   <?php echo $language['finish'].$language['month']?> 
									   <select name="month_finish">
									      <option value="1"<?php if($month_finish==1){?>selected="selected"<?php }?>>1</option>
									      <option value="2"<?php if($month_finish==2){?>selected="selected"<?php }?>>2</option>
									      <option value="3"<?php if($month_finish==3){?>selected="selected"<?php }?>>3</option>
									      <option value="4"<?php if($month_finish==4){?>selected="selected"<?php }?>>4</option>
									      <option value="5"<?php if($month_finish==5){?>selected="selected"<?php }?>>5</option>
									      <option value="6"<?php if($month_finish==6){?>selected="selected"<?php }?>>6</option>
									      <option value="7"<?php if($month_finish==7){?>selected="selected"<?php }?>>7</option>
									      <option value="8"<?php if($month_finish==8){?>selected="selected"<?php }?>>8</option>
									      <option value="9"<?php if($month_finish==9){?>selected="selected"<?php }?>>9</option>
									      <option value="10"<?php if($month_finish==10){?>selected="selected"<?php }?>>10</option>
									      <option value="11"<?php if($month_finish==11){?>selected="selected"<?php }?>>11</option>
									      <option value="12"<?php if($month_finish==12){?>selected="selected"<?php }?>>12</option>
                                       </select>
									  </div>
									</div>
									
									<?php ############?>
									
									

									
									 
									
									<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['status']?></span></label>

										<div class="col-xs-3">
													<label>
<!-- <input name="switch-field-1" class="ace ace-switch" type="checkbox"  name="status" <?php //if($status == 1) echo 'value=1 checked'?>/> -->
<input type="checkbox" name="status" id="cat_status" class="ace ace-switch ace-switch-5"  <?php if($status == 1) echo 'value=1 checked'?>>

														<span class="lbl"></span>
													</label>
									  </div>
									  </div>
									</div>
								<?php ############?>
								
								
								<input type="hidden" name="condition_group_id2" value="<?php echo $condition_group_id2;?>">
								 
								 
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
					url: "<?php echo base_url('hardwareconfig/status/'.$admin_team[$key]['admin_team_id'])?>",
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
								window.location='<?php echo base_url('hardwareconfig/delete/'.$admin_team[$key]['admin_team_id'])?>';
						}
					});
		});

		$('#bx-confirm<?=$admin_team[$key]['admin_team_id']?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('hardwareconfig/delete/'.$admin_team[$key]['admin_team_id'])?>';
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