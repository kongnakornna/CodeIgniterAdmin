<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>TrafficLight</title>
      <script src='<?php echo base_url('theme');?>/assets/steelseriescanvas/steelseries-min.js'></script>

      <script>
        var trafficLight;

        function init()
        {
            // Initialzing
            trafficLight = steelseries.TrafficLight('canvas', {
                            width: 200,
                            height: 200
                            });
        }
    
	    function setLights() {
		    trafficLight.setRedOn(document.getElementById('red').checked);
			trafficLight.setYellowOn(document.getElementById('yellow').checked);
			trafficLight.setGreenOn(document.getElementById('green').checked);
	    }	
  </script>
  </head>
  <body onload='init()' BGCOLOR="333333" TEXT="cccccc">
   <div class="center"> <canvas id='canvas' width='400' height='400'>
      No canvas in your browser...sorry...
    </canvas></div>
	<br/><div class="center">
	<input id="red" type="checkbox" onClick="setLights()"/>Red<br />
	<input id="yellow" type="checkbox" onClick="setLights()"/>Yellow<br />
	<input id="green" type="checkbox" onClick="setLights()"/>Green<br />
	</div>
  </body>
</html>
