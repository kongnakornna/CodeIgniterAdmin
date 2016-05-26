<?php
$html = @file_get_html('http://192.168.10.223');
if($html){
  //$hw = array();
  foreach($html->find('a') as $element){
    $hwaction = explode("=", $element->href);
    //$hw[] = $hwaction;
    $hw[] = $element->href;

    $hw2[] = array("name" => $hwaction[0], "status" => $hwaction[1]);
    //echo $hwaction[0].$hwaction[1];
  } 
?>
<div class="table-responsive">
<table class="table table-bordered">

	<tr>
			<th width="150"><p class="text-center">HardwareNO.1</p></th>
			<td >
<label class="toggle pull-left">
	<input type="checkbox" name="checkbox-toggle" id="hwcheck_1" <?php if($hw2[0]['status'] == 'on'){echo "";}else{echo "checked";} ?>>
	<i data-swchon-text="ON" data-swchoff-text="OFF"></i>&nbsp;
</label>
			</td>
	</tr>
	
	<tr>
			<th><p class="text-center">HardwareNO.2</p></th>
			<td>
<label class="toggle pull-left">
	<input type="checkbox" name="checkbox-toggle" id="hwcheck_2" <?php if($hw2[1]['status'] == 'on'){echo "";}else{echo "checked";} ?>>
	<i data-swchon-text="ON" data-swchoff-text="OFF"></i>&nbsp;
</label>
			</td>
	</tr>

	<tr>
			<th><p class="text-center">HardwareNO.3</p></th>
			<td>
<label class="toggle pull-left">
	<input type="checkbox" name="checkbox-toggle" id="hwcheck_3" <?php if($hw2[2]['status'] == 'on'){echo "";}else{echo "checked";} ?>>
	<i data-swchon-text="ON" data-swchoff-text="OFF"></i>&nbsp;
</label>	
			</td>
	</tr>

	<tr>
			<th><p class="text-center">HardwareNO.4</p></th>
			<td>
<label class="toggle pull-left">
	<input type="checkbox" name="checkbox-toggle" id="hwcheck_4" <?php if($hw2[3]['status'] == 'on'){echo "";}else{echo "checked";} ?>>
	<i data-swchon-text="ON" data-swchoff-text="OFF"></i>&nbsp;
</label>		
			</td>
	</tr>

</table>
</div>


<?php
}else{

}




?>


<script type="text/javascript">

$(document).ready(
    function()
    {
        $("#hwcheck_1").change(
            function()
            {
                if( $(this).is(":checked") )
                {
                	//alert('1');
                 $.post("<?php echo base_url();?>hwdata/overview/hw1_action.php", { uaction: "on" } );
                 //$( "#action_hw1" ).fadeIn().html("Hardware 1 : ON");
                }else{
                	//alert('0');
                  $.post("<?php echo base_url();?>hwdata/overview/hw1_action.php", { uaction: "off" });
                 // $( "#action_hw1" ).fadeIn().html("Hardware 1 : OFF");
                }
            }
        )

        $("#hwcheck_2").change(
            function()
            {
                if( $(this).is(":checked") )
                {
                $.post("<?php echo base_url();?>hwdata/overview/hw2_action.php", { uaction: "on" } );
                 //$( "#action_hw2" ).fadeIn().html("Hardware 2 : ON");
                }else{
                 $.post("<?php echo base_url();?>hwdata/overview/hw2_action.php", { uaction: "off" });
                 // $( "#action_hw2" ).fadeIn().html("Hardware 2 : OFF");
                }
            }
        )

        $("#hwcheck_3").change(
            function()
            {
                if( $(this).is(":checked") )
                {
                $.post("<?php echo base_url();?>hwdata/overview/hw3_action.php", { uaction: "on" } );
                // $( "#action_hw3" ).fadeIn().html("Hardware 3 : ON");
                }else{
                  $.post("<?php echo base_url();?>hwdata/overview/hw3_action.php", { uaction: "off" });
                //  $( "#action_hw3" ).fadeIn().html("Hardware 3 : OFF");
                }
            }
        )

        $("#hwcheck_4").change(
            function()
            {
                if( $(this).is(":checked") )
                {
                 $.post("<?php echo base_url();?>hwdata/overview/hw4_action.php", { uaction: "on" } );
                // $( "#action_hw4" ).fadeIn().html("Hardware 4 : ON");
                }else{
                  $.post("<?php echo base_url();?>hwdata/overview/hw4_action.php", { uaction: "off" });
                 // $( "#action_hw4" ).fadeIn().html("Hardware 4 : OFF");
                }
            }
        )


    }
);
</script>