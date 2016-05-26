<?php 
//echo base_url();
$timer='3';
$timer3='1';
$timer4='1';
$timeloop=(int)$timer*60*60;// x sec
$timeloop3=(int)$timer3*20*60;// x sec
$timeloop4=(int)$timer4*20*60;// x sec
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($admin_team);
?>
<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($admin_team);
?>
<style type="text/css">
.col-sm-6 {width: 100%;text-align: center;	}
#saveorder{cursor:pointer;}
.input-small{text-align: center;}
</style>
						<!-- <div class="page-header">
							<h1>
							<?php //echo $HeadTitle?>
							<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								<?php //echo $HeadTitle?>
							</small>
							</h1>
						</div> -->
<?php
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
<?php
			if(isset($success)){
?>
				<div class="col-xs-12">
							<div class="alert alert-success">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											</strong><?php echo $success?>.
									<br>
							</div>
				</div>
<?php
			}
?>

<!-- start: PAGE CONTENT -->

 <style type="text/css">
  .gbox {
    width:100px; 
    height:80px;
  }
</style>


<div class="page-content-area">

		 
							<h1>
								<?php  echo $this->lang->line('overview');?>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									  <?php  echo $this->lang->line('graphsmonitor');?>
								</small>
							</h1>
		 


<div class="row">

<div id="sensor_th_setting"></div>
<?php ###########################[Box 1]############################### ?>
<article class="col-sm-12 col-md-6 col-lg-3">

              <div class="jarviswidget jarviswidget-color-blue" id="wid-id-tree1" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-tachometer"></i> </span>
                  <h2><?php echo $this->lang->line('hardware');?> #1 </h2>
                </header>
                <div>
                  <div class="jarviswidget-editbox">
                  </div>
                  <div class="widget-body">
                    <div class="tree smart-form">
                      <ul>
                        <li>
                          <span><i class="fa fa-lg fa-sun-o fa-spin"></i> <?php echo $this->lang->line('mainhardware');?></span>
                          <ul>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 1</span>
                              <ul>
                                <li>
                                  <span id="s1_humi">  </span>
                                </li>
                                <li>
                                  <span id="s1_temp">  </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 2</span>
                              <ul>
                                <li>
                                  <span id="s2_temp"> </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 3</span>
                              <ul>
                                <li>
                                  <span id="s3_temp"> </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 4</span>
                              <ul>
                                <li>
                                  <span id="s4_temp">  </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 5</span>
                              <ul>
                                <li>
                                  <span id="s5_temp"> </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 6</span>
                              <ul>
                                <li>
                                  <span id="s6_temp"> </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 7</span>
                              <ul>
                                <li>
                                  <span id="s7_temp"> </span>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </article>
<?php ###########################[Box 1]############################### ?>


<?php ###########################[Box 2]############################### ?>
<article class="col-sm-12 col-md-6 col-lg-3">
              <div class="jarviswidget jarviswidget-color-green" id="wid-id-tree2" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-tachometer"></i> </span>
                  <h2><?php echo $this->lang->line('hardware');?> #2 </h2>
                </header>
                <div>
                  <div class="jarviswidget-editbox">
                  </div>
                  <div class="widget-body">
                    <div class="tree smart-form">
                      <ul>
                        <li>
                          <span><i class="fa fa-lg fa-sun-o fa-spin"></i> <?php echo $this->lang->line('mainhardware');?></span>
                          <ul>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 1</span>
                              <ul>
                                <li>
                                  <span id="s21_humi"></span>
                                </li>
                                <li>
                                  <span id="s21_temp"></span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 2</span>
                              <ul>
                                <li>
                                  <span id="s22_temp"> </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 3</span>
                              <ul>
                                <li>
                                  <span id="s23_temp">  </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 4</span>
                              <ul>
                                <li>
                                  <span id="s24_temp">  </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 5</span>
                              <ul>
                                <li>
                                  <span id="s25_temp"> </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 6</span>
                              <ul>
                                <li>
                                  <span id="s26_temp"> </span>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-lg fa-minus-circle"></i> <?php echo $this->lang->line('sensor');?> 7</span>
                              <ul>
                                <li>
                                  <span id="s27_temp">  </span>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </article>
<?php ###########################[Box 2]############################### ?>


<?php ###########################[Box 3]############################### ?>
<article class="col-sm-12 col-md-6 col-lg-3">
              <div class="jarviswidget jarviswidget-color-orange" id="wid-id-tree3" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
                  <h2><?php echo $this->lang->line('hardware');?> #3</h2>
                </header>
                <div>
                  <div class="jarviswidget-editbox">
                  </div>
                  <div class="widget-body">
                    <div class="tree smart-form">
                      <ul>
                        <li>
                          <span><i class="fa fa-lg fa-sun-o fa-spin"></i> <?php echo $this->lang->line('hardwarecontrol');?></span>
                            <ul id="load_hw3_wf">

                            </ul>
                        </li>
                      </ul>
                     
                         <br><hr><br>
                         <?php
                           // include('loadhw3json_action.php');
                        ?>
<?php #########################################################################?>

<?php
$this->load->view('tmon/html_dom');
$this->load->view('tmon/html_dom_hw');
?>
<?php #########################################################################?>
                    </div>

                   
                  </div>
                </div>
              </div>


              

</article>
<?php ###########################[Box 3]############################### ?>

<?php ###########################[Box 4]############################### ?>
<article class="col-sm-12 col-md-6 col-lg-3">

<div class="jarviswidget jarviswidget-color-red" id="wid-id-tree4" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-exclamation-triangle"></i> </span>
                  <h2><?php echo $this->lang->line('hardware');?> #4 </h2>
                </header>
                <div>
                  <div class="jarviswidget-editbox">
                  </div>
                  <div class="widget-body">
                    <div class="tree smart-form">
                      <ul>
                        <li>
                          <span><i class="fa fa-lg fa-sun-o fa-spin"></i> <?php echo $this->lang->line('warterleak');?></span>
                            <ul id="load_hw4_wf">
                              
                            </ul>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <!--
              <div class="jarviswidget jarviswidget-color-orange" id="wid-id-tree3" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
                  <h2>Hardware #3 - Action</h2>
                </header>
                <div>
                  <div class="jarviswidget-editbox">
                  </div>
                  <div class="widget-body">
                    <div class="tree smart-form">
                      <ul>
                        <li>
                          <span><i class="fa fa-lg fa-sun-o fa-spin"></i> ON - OFF Control</span>
                            <ul>
                              <?php
                             // include('loadhw3json_action.php');
                              ?>
                            </ul>
                          </ul>
                        </li>
                      </ul>
                    </div>

                   
                  </div>
                </div>
              </div>
              -->



</article>
<?php ###########################[Box 4]############################### ?>















<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    
  $(document).ready(function() {
      
      pageSetUp();


  $(function(){
        function load_hw3_json(){
        $('#load_hw3_wf').load('<?php echo base_url();?>hwdata/overview/loadhw3json_wf.php',function(datahw3){
        });
      }
      load_hw3_json();
       setInterval(load_hw3_json,<?php echo $timeloop3;?>); /*Time sec*/
  }); 


  $(function(){
        function load_hw4_json(){
        $('#load_hw4_wf').load('<?php echo base_url();?>hwdata/overview/loadhw4json_wf.php',function(datahw4){
          
        });
      }
      load_hw4_json();
       setInterval(load_hw4_json,<?php echo $timeloop4;?>); /*Time sec*/
  });  


  });
</script>
