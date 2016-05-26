<?php
$baseurls=base_url();
$json_string=$baseurls.'api/sd_hardware.php';
$jsondata=file_get_contents($json_string);
$data_ret=json_decode($jsondata,true);
$count=count($data_ret['result']);
$header=$data_ret['header'];
$arr =$data_ret['result'];
?>
 <?php //echo $this->lang->line('hardware'); ?> 
<?php
if($count > 0 && $header['res_code'] == 200){
	for($i=0; $i<$count; $i++){
		$hardware_id=$arr[$i]['hardware_id'];
		$hardware_type_id=$arr[$i]['hardware_type_id'];
		$hardware_name=$arr[$i]['hardware_name'];
		$hardware_type_name=$arr[$i]['hardware_type_name'];
		$hardware_decription=$arr[$i]['hardware_decription'];
		$hardware_ip=$arr[$i]['hardware_ip'];
		$port=$arr[$i]['port'];
		$sn=$arr[$i]['sn'];
	

?>

<?php
echo 'Hardware Type:'.$hardware_type_name; echo '<br>';
echo 'Hardware :'.$hardware_name; echo '<br>';
echo 'Hardware IP:'.$hardware_ip; echo '<br>';
echo 'SN:'.$sn; echo '<br>';
?>
<li class="media">
<a href="#">
<!--
<img alt="..." src="<?php echo base_url('theme'); ?>/assets/images/avatar-7.jpg" class="media-object">
-->	
	<div class="media-body">
		<h4 class="media-heading"> Hardware Type </h4>
		<span> <?php echo $hardware_type_name;?></span>
	</div>
</a>
<?php
	}
  }else{echo 'Error 200';}
?> 

<?php 
	//$this->load->view('tmon/tab_hardware');
 ?>