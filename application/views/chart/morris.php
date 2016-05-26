<?php
		$language = $this->lang->language;

		if (!$this->session->userdata('user_name')) {

		}else{
			$userinput = $this->session->userdata('user_name');
		}

		$donut = $area_chart = '';
		if($report->name)
			for($i=0;$i<count($report->name);$i++){
					$donut .= '{ label: "'.$report->name[$i].'", value: '.$report->sum_view[$i].'},';
			}

		if($lineall->view_date)
			for($i=0;$i<count($lineall->view_date);$i++){
					
					$period = $lineall->date[$i];
					$all_device = (isset($lineall->all[$i])) ? $lineall->all[$i] : 0;
					$desktop = (isset($lineall->desktop[$i])) ? $lineall->desktop[$i] : 0;
					$mobile = (isset($lineall->mobile[$i])) ? $lineall->mobile[$i] : 0;
					$tablet = (isset($lineall->tablet[$i])) ? $lineall->tablet[$i] : 0;

					if($i == 0) 
						$area_chart .= '{ period: "'.$period.'", all: '.$all_device.', desktop: '.$desktop.', mobile: '.$mobile.', tablet: '.$tablet.'}';
					else
						$area_chart .= ',
						{ period: "'.$period.'", total: '.$all_device.', desktop: '.$desktop.', mobile: '.$mobile.', tablet: '.$tablet.'}';
			}
?>
<style type="text/css">
.widget-body , .widget-main {height: 385px;}	
#piechart-placeholder{height: 225px;}
</style>

<div class="page-content-area">
		<div class="page-header">
							<h1>
								Chart
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats
								</small>
							</h1>
		</div>

		<div class="row">

			  <!-- <div class="col-lg-12">
				<h2>morris.js Charts</h2>
				<div class="panel panel-primary">
				  <div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Area Line Graph Example with Tooltips</h3>
				  </div>
				  <div class="panel-body">
					<div id="morris-chart-area"></div>
				  </div>
				</div>
			  </div> -->

                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Daily report
                        </div>

                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>

                    </div>
                </div>


                <!-- /.col-lg-6 -->
                <!-- <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bar Chart Example
                        </div>

                        <div class="panel-body">
                            <div id="morris-bar-chart"></div>
                        </div>

                    </div>
                </div> -->


                <!-- /.col-lg-6 -->
                <!-- <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Line Chart Example
                        </div>

                        <div class="panel-body">
                            <div id="morris-line-chart"></div>
                        </div>

                    </div>
                </div> -->


                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Donut Chart
                        </div>

                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                        </div>

                    </div>
                </div>

		</div>
</div>

<?php //echo js_asset('morris/morris-ready.js');  ?>

<script type="text/javascript">
$(function() {
    /*Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2012-10-01',
            total: 2666,
            desktop: null,
            mobile: 2647
        }, {
            period: '2012-10-05',
            total: 2778,
            desktop: 2294,
            mobile: 2441
        }, {
            period: '2012-10-15',
            total: 4912,
            desktop: 1969,
            mobile: 2501
        }, {
            period: '2012-10-21',
            total: 3767,
            desktop: 3597,
            mobile: 5689
        }, {
            period: '2012-10-01',
            total: 6810,
            desktop: 1914,
            mobile: 2293
        }, {
            period: '2012-10-05',
            total: 5670,
            desktop: 4293,
            mobile: 1881
        }, {
            period: '2012-10-15',
            total: 4820,
            desktop: 3795,
            mobile: 1588
        }, {
            period: '2012-10-21',
            total: 15073,
            desktop: 5967,
            mobile: 5175
        }, {
            period: '2012-10-01',
            total: 10687,
            desktop: 4460,
            mobile: 2028
        }, {
            period: '2012-10-05',
            total: 8432,
            desktop: 5713,
            mobile: 1791
        }],
        xkey: 'period',
        ykeys: ['total', 'desktop', 'mobile'],
        labels: ['All device', 'Desktop', 'Mobile'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });*/

    /*Morris.Area({
        element: 'morris-area-chart',
        data: [{ period: '2015-02-04', all: 243, desktop: 242, mobile: 1},
						{ period: '2015-02-05', total: 1503509, desktop: 1503491, mobile: 15},
						{ period: '2015-02-06', total: 1410, desktop: 1401, mobile: 4},
						{ period: '2015-02-07', total: 79, desktop: 66, mobile: 8},
						{ period: '2015-02-08', total: 277, desktop: 255, mobile: 21},
						{ period: '2015-02-09', total: 1132, desktop: 1121, mobile: 10},
						{ period: '2015-02-10', total: 992, desktop: 959, mobile: 5},
						{ period: '2015-02-11', total: 1166, desktop: 1161, mobile: 5}],
        xkey: 'period',
        ykeys: ['total', 'desktop', 'mobile'],
        labels: ['All device', 'Desktop', 'Mobile'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });*/


    Morris.Area({
        element: 'morris-area-chart',
        data: [<?php echo $area_chart ?>],
        xkey: 'period',
        ykeys: ['total', 'desktop', 'mobile', 'tablet'],
        labels: ['All device', 'Desktop', 'Mobile', 'Tablet'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [<?php echo $donut ?>],
        resize: true
    });

});
</script>