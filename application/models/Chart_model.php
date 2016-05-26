<?php
class Chart_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function Traffic_sources($report){
				
			$language = $this->lang->language;
			$guide = 0;

			$guide_display = ($guide == 0) ? 'style="display:none;"' : '';
			//Debug($report);
?>							
							<div class="col-sm-5">
										<div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">
													<i class="ace-icon fa fa-signal"></i>
													<?php echo $language['traffic_sources'] ?> <?php echo $language['category'] ?>
												</h5>

												<div class="widget-toolbar no-border" <?php echo $guide_display ?>>
													<div class="inline dropdown-hover">
														<button class="btn btn-minier btn-primary">
															This Week
															<i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
														</button>

														<ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
															<li class="active">
																<a href="#" class="blue">
																	<i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
																	This Week
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	Last Week
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	This Month
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	Last Month
																</a>
															</li>
														</ul>
													</div>
												</div><!--  -->

											</div>

											<div class="widget-body">
												<div class="widget-main">
													<!-- #section:plugins/charts.flotchart -->
													<div id="piechart-placeholder"></div>

													<!-- /section:plugins/charts.flotchart -->
													<div class="hr hr8 hr-double"></div>

													<div class="clearfix">
														<!-- #section:custom/extra.grid -->

														<?php 
															//$this->display_social() 
															for($i = 0;$i < count($report->name);$i++){
																	
																	$name = $report->name[$i];
																	$icon = $report->icon[$i];
																	$sum_view = numbershort($report->sum_view[$i]);

																	switch($icon){
																			case 'news':
																					$icon = 'fa-list';
																					$color = 'blue';
																			break;
																			case 'column':
																					$icon = 'fa-pencil-square-o';
																					$color = 'green';
																			break;
																			case 'gallery':
																					$icon = 'fa-picture-o';
																					$color = 'purple';
																			break;
																			case 'vdo': 
																					$icon = 'fa-film'; 
																					$color = 'red';
																			break;
																			default :
																					$icon = 'fa-star';
																					$color = 'orange';
																			break;
																	}

																	echo '
																		<div class="grid3">
																			<span class="grey">
																				<i class="ace-icon fa '.$icon.' fa-2x '.$color.'" title="'.$name.'" data-rel="tooltip" ></i>
																				&nbsp; view 
																			</span>
																			<h4 class="bigger pull-right">'.$sum_view.'</h4>
																		</div>';

															}														
														?>

														<!-- /section:custom/extra.grid -->
													</div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
								</div><!-- /.row -->
<?php
	}

	function display_social($count_fb = 0, $count_tw = 0){

			echo '								<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
																&nbsp; likes
															</span>
															<h4 class="bigger pull-right">'.$count_fb.'</h4>
														</div>

														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
																&nbsp; tweets
															</span>
															<h4 class="bigger pull-right">'.$count_tw .'</h4>
														</div>';

														/*<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
																&nbsp; pins
															</span>
															<h4 class="bigger pull-right">'.$count_pin.'</h4>
														</div>*/

	}
 
}
?>	
