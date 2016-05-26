

<?php

			$language = $this->lang->language; 
			if (!$this->session->userdata('user_name')) {

			} else {
				$userinput = $this->session->userdata('user_name');
			}
			//Debug($admin_menu);
			 $langn=$language['lang'];
?>
			<h1><?php //echo $headtxt; ?> <?php //echo $language['welcome'];  echo ' : '; echo $userinput; ?></h1>
			
<?php 
	$alinkprofile=base_url('admin/profile'); 
//Debug($this->session->userdata); 
if($this->session->userdata['avatar'] != ''){
	 $avatar=base_url('uploads/admin/'.$this->session->userdata['avatar']);
	 //if(!file_exists($avatar)) $avatar=base_url('uploads/admin/'.$this->session->userdata['avatar']);
	 //if(!file_exists($avatar)) $avatar=base_url('theme/assets/avatars/user.jpg');
 }else{
  $avatar=base_url().'uploads/avatars/user.jpg';	
  //$avatar=base_url().'theme/assets/avatars/userna.jpg';
 }
 ?>
<?php #################################?>
<div id="paginator-content-1" class="alert alert-info">

  <H4>
  <img src="<?php  echo $avatar; ?>" class="circle-img" alt="<?php echo $userinput?>"height="45">
  <?php echo $language['welcome']; ?> 
  <?php 
  	echo $name=$this->session->userdata('name');
	echo'&nbsp;';
	echo $lastname=$this->session->userdata('lastname'); 
  	#echo' (';echo $this->session->userdata('user_name'); echo') ';
  ?>
  </H4> 
  

</div>
<?php #################################?>


<div class="row">
<!--
<?php  if($this->uri->segment(2) == "welcome"){ ?>
            <div class="col-sm-12">
				<p><?php echo $language['welcome']; ?>:</p>
				<code><?php echo $userinput; ?></code>
			</div>
<?php  }   ?>
-->
			<div class="col-sm-12">
				<?php
					/*if($session)
						foreach($session as $key => $v){
								echo "$key => $v <br>";
						}*/
#Debug($admin_menu);
					//if($this->uri->segment(1) == "dashboard"){
						if($admin_menu)
								for($i=0;$i<count($admin_menu);$i++){
										
										if(isset($admin_menu[$i]['admin_menu_id'])){
											$icon = ($admin_menu[$i]['admin_menu_id'] == 28) ? 'fa '.$admin_menu[$i]['icon'] : 'fa '.$admin_menu[$i]['icon'];
											if($langn=='en'){
											$title = $admin_menu[$i]['title_en'];
											}else if($langn=='th'){
											$title = $admin_menu[$i]['title_th'];
											}
											$alink = (trim($admin_menu[$i]['url']) != '') ? base_url($admin_menu[$i]['url']) : '#';
											
											if($admin_menu[$i]['parent'] == 0 && $alink != '#'){
													echo '<a href="'.$alink.'"><button class="btn btn-app btn-primary">
														<i class="ace-icon '.$icon.' bigger-330"></i>
														'.$title.'
													</button>
													</a>';
													//Debug($admin_menu[$i]);
											}
										}
								
								}
					//}
				?>
			</div>
</div>
<?php #################################?>

<?php #################################?>
				
									<?php #################################?>
									<br/>
									<div class="alert alert-warning">
										<button data-dismiss="alert" class="close" type="button">
											&times;
										</button>
										<h4 class="alert-heading"><i class="fa fa-check-circle"></i> 
										<span class="label label-info"> 
										<?php echo $language['selectmenu'] ?>!
										</span>
										</h4>
										<p>
										    <br />
											<?php echo $language['control'] ?>
										</p> 
									</div>
									<?php #################################?>
									<!--
									<div class="alert alert-block alert-success fade in">
										<button data-dismiss="alert" class="close" type="button">
											&times;
										</button>
										<img src="<?php #echo base_url();?>theme/assets/systmon.png"/>
										<h4 class="alert-heading">
										<i class="fa fa-check-circle">
										</i> <?php #echo $language['titleweb'] ?>!
										</h4>
											<?php #echo $language['copyright'] ?>
											
										<p>
										    <br/><?php #echo $language['descriptiontmon'] ?>
											<br/><?php #echo $language['author'] ?>
										</p> 
									</div>
									-->
									<?php #################################?>





<?php ############Flot Chat#####################?>
 