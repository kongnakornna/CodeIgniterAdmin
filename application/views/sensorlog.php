<div class="search">
	<fieldset>
		<legend>Search</legend>
		<form name='search' action=<?=site_url('parent/');?> method='post'>
		<table>
			<tr>
				<td>sensor_name</td>
				<td>Group</td>					
				<td>Remarks</td>
			</tr>
			<tr>
				<td><input name="sensor_name" type='text' value='<?php echo $sensor_name; ?>'></td>					
				<td><input name="sensor_type" type='text' value='<?php echo $sensor_type; ?>'></td>					
				<td><input name="sensor_value" type='text' value='<?php echo $sensor_value; ?>'></td>
				<td><input type='submit' name='search' value='Search'></td>
			</tr>
		</table>
		</form>
	</fieldset>
</div>
<div class="content">
	<h3>Parent Details</h3>
	<br />				
	<div class="data"><?php echo $table; ?></div>
	<div class="paging"><?php echo $pagination; ?></div>
</div>