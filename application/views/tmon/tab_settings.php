<?php
$baseurls=base_url();
$json_string=$baseurls.'json/setting/configuration.json';
$jsondata=file_get_contents($json_string);
$data_ret=json_decode($jsondata,true);
$arr=$data_ret;
?>
<div class="tab-pane" id="settings">
						<h5 class="sidebar-title"><?php echo $this->lang->line('licencedata'); ?></h5>
<?PHP
 
		$systemname=$arr['systemname'];
		$description=$arr['description'];
		$address=$arr['address'];
		$registerno=$arr['registerno'];
		$author=$arr['author'];
		$phone=$arr['phone'];
		$ip=$arr['ip'];
		$mac_address=$arr['mac_address'];
		$licence_key=$arr['licence_key'];
		$version=$arr['version'];
		$admin_email=$arr['admin_email'];
		$mobile=$arr['mobile'];
?>
						<ul class="media-list">
							<li class="media">
								<div class="checkbox sidebar-content">
									<label>
										<input type="checkbox" value="" class="green" checked="checked">
										 System :<?php echo $systemname;?>
									</label>
								</div>
							</li>
							
							<li class="media">
								<div class="checkbox sidebar-content">
									<label>
										<input type="checkbox" value="" class="green" checked="checked">
										 Description :<?php echo $description;?>
									</label>
								</div>
							</li>
							
							<li class="media">
								<div class="checkbox sidebar-content">
									<label>
										<input type="checkbox" value="" class="green" checked="checked">
										 Address :<?php echo $address;?>
									</label>
								</div>
							</li>
							
							<li class="media">
								<div class="checkbox sidebar-content">
									<label>
										<input type="checkbox" value="" class="green" checked="checked">
										 Register no :<?php echo $registerno;?>
									</label>
								</div>
							</li>
							
							<li class="media">
								<div class="checkbox sidebar-content">
									<label>
										<input type="checkbox" value="" class="green" checked="checked">
										 IP :<?php echo $ip;?>
									</label>
								</div>
							</li>
							<li class="media">
								<div class="checkbox sidebar-content">
									<label>
										<input type="checkbox" value="" class="green" checked="checked">
										 Mac Address :<?php echo $mac_address;?>
									</label>
								</div>
							</li>
							
							<li class="media">
								<div class="checkbox sidebar-content">
									<label>
										<input type="checkbox" value="" class="green" checked="checked">
										 Licence key :<?php echo $licence_key;?>
									</label>
								</div>
							</li>
							
							<li class="media">
								<div class="checkbox sidebar-content">
									<label>
										<input type="checkbox" value="" class="green" checked="checked">
										 Version :<?php echo $version;?>
									</label>
								</div>
							</li>
							
						</ul>
 
						<!--
						<div class="sidebar-content">
							<button class="btn btn-success">
								<i class="icon-settings"></i><?php //echo $this->lang->line('save'); ?>
							</button>
						</div>
						-->
</div>
