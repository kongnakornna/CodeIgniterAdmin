<?php
$baseurls=base_url();
$json_string=$baseurls.'api/sd_condition.php';
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
		$condition_name=$arr[$i]['condition_name'];
		$condition_group_access=$arr[$i]['condition_group_access'];
		$ip=$arr[$i]['ip'];
		$condition_group_name=$arr[$i]['condition_group_name'];
		$hour_start=$arr[$i]['hour_start'];
		$minute_start=$arr[$i]['minute_start'];
		$hour_finish=$arr[$i]['hour_finish'];
		$minute_finish=$arr[$i]['minute_finish'];
		$month_start=$arr[$i]['month_start'];
		$month_finish=$arr[$i]['month_finish'];
		$sun=$arr[$i]['sun'];
		$mon=$arr[$i]['mon'];
		$tue=$arr[$i]['tue'];
		$wed=$arr[$i]['wed'];
		$thu=$arr[$i]['thu'];
		$fri=$arr[$i]['fri'];
		$sat=$arr[$i]['sat'];
		$status=$arr[$i]['status'];

?>
<li class="media">
	<!-- <a href="#"></a> -->
		<div class="user-label">
			<span class="label label-success"><i class="fa  fa-warning (alias)"></i></span>
				</div>
					<i class="fa fa-circle status-online"></i>
						<!-- <img alt="..." src="assets/images/avatar-3.jpg" class="media-object"> -->
						
				<div class="media-body">
						<h4 class="media-heading">    <i class="fa fa-code-fork"></i><?php echo' ';echo $condition_name;?></h4>
 <span> IP :<?php echo $ip;?> </span>
 <span> Access :<?php echo $condition_group_access;?> </span>
 <span> Start Time :<?php echo $hour_start;?> : <?php echo $minute_start;?></span>
 <span> Finish Time :<?php echo $hour_finish;?> : <?php echo $minute_finish;?> </span>
 <span> Start Time :<?php echo $hour_start;?> : <?php echo $minute_start;?></span>
 <span> FinishTime :<?php echo $hour_finish;?> : <?php echo $minute_finish;?> </span>
 <span> Start Month :<?php echo $month_start;?> </span>
 <span> Finish Month :<?php echo $month_finish;?> </span>
<span> ---------Date Condition ------------</span>
 <span> Group :<?php echo $condition_group_name;?> </span>
<span> Sun :<?php echo $sun;?> </span>
<span> Mon :<?php echo $mon;?> </span>
<span> Tue :<?php echo $tue;?> </span>
<span> Wed :<?php echo $wed;?> </span>
<span> Thu :<?php echo $thu;?> </span>
<span> Fri :<?php echo $fri;?> </span>
<span> Sat :<?php echo $sat;?> </span>
<span> ---------Date Condition ------------</span>
 <span> Status :<?php echo $status;?> </span>
		</div>
	
</li>
<?php
	}
  }else{echo 'Error 200';}
?> 