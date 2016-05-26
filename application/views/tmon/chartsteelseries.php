<script type='text/javascript' src='<?php echo base_url('theme');?>/assets/tween.js'></script>
<script type='text/javascript' src='<?php echo base_url('theme');?>/assets/steelseries.js'></script>
<body onload='init()'>


<?php
#######################
$a='45';			//$_REQUEST['a'];
$b='65';			//$_REQUEST['b'];
$c='55';			//$_REQUEST['c'];
$d='75';			//$_REQUEST['d'];
$e='35';			//$_REQUEST['e'];
$f='85';
$g='25';
$h='95';
$size='180';			//$_REQUEST['size'];
$min='-50';		//$_REQUEST['min'];
$max='150';			//$_REQUEST['max'];
$width='100';
$height='200';

#######################
if($size==''){
$size='250';  # ขนาด
}if($min==''){
$min='0';     # ต่ำสุด
}if($max==''){
$max='100';  # สุงสุด
}
$threshold1='60';  # ไฟกระพริบ
$threshold2='60';  # ไฟกระพริบ
$threshold3='60';  # ไฟกระพริบ
$threshold4='60';  # ไฟกระพริบ
$threshold5='60';  # ไฟกระพริบ
$threshold6='60';  # ไฟกระพริบ
$threshold7='60';  # ไฟกระพริบ


$name1='Temp1';
$name2='Humi1';
$name3='Temp2';
$name4='Humi2';
$name5='Humi5';
$name6='Temp6';
$name7='Temp7';

$type1='C';
$type2='H';
$type3='C';
$type4='H';
$type5='H';
$type6='C';
$type7='C';
#######################
if($a==''){
$a='25';
}if($b==''){
$b='25';
}if($c==''){
$c='25';
}if($d==''){
$d='25';
}
#######################
?>





<center>
<hr>
<canvas id='canvas1' width='100%' height='100%'></canvas>
<canvas id='canvas2' width='100%' height='100%'></canvas> 
<canvas id='canvas3' width='100%' height='100%'></canvas>  
<hr>
<canvas id='canvas4' width='100%' height='100%'></canvas>
<canvas id='canvas5' width='100%' height='100%'></canvas>
<hr>
<canvas id="canvasLinear6" width="180" height="220"></canvas> 
<canvas id="canvasLinear7" width="180" height="220"></canvas> 
<hr>
</center>

<script>
//=================================================================================		
function init(){
// Define some sections
  var sections = Array(steelseries.Section(22, 24, 'rgba(0, 0, 220, 0.3)'),     //  
                       steelseries.Section(25, 27, 'rgba(0, 220, 0, 0.3)'),     //  
                       steelseries.Section(28, 30, 'rgba(220, 0, 0, 0.3)'));    //  
//=================================================================================							   
   valGrad = new steelseries.gradientWrapper(  20, // 
                                               85,
                                             [ 0, 0.33, 0.66, 0.85, 1],
                                             [ new steelseries.rgbaColor(0, 0, 200, 1),    //  
                                               new steelseries.rgbaColor(0, 200, 0, 1),    //  
                                               new steelseries.rgbaColor(200, 200, 0, 1),  //  
                                               new steelseries.rgbaColor(200, 0, 0, 1),    //  
                                               new steelseries.rgbaColor(200, 0, 0, 1) ]);											   
 //=================================================================================		 
// Define one area
  var areas = Array(steelseries.Section(28, 30, 'rgba(220, 0, 0, 0.3)'));
//=================================================================================	
	        
// Create one radial gauge
  var radial1 = new steelseries.Radial('canvas1', {
                    section: sections,  //  
					size: <?php echo $size;?>,         // 
					minValue: <?php echo $min;?>,      //  
					maxValue: <?php echo $max;?>,      //  
					threshold: <?php echo $threshold1;?>,     //  
                    area: areas,       //           
                    titleString: '<?php echo $name1;?>',                    
                    unitString: '<?php echo $type1;?>',
                   //	backgroundColor: steelseries.BackgroundColor.LIGHT_GRAY, // 
					backgroundColor: steelseries.BackgroundColor.BLACK_METAL,    //  
					frameDesign: steelseries.FrameDesign.BLACK_METAL,          // 
                    pointerType: steelseries.PointerType.TYPE8,
                    });                               
//=================================================================================		
// Create a second radial gauge    
  var radial2 = new steelseries.Radial('canvas2', {
                    gaugeType: steelseries.GaugeType.TYPE2,
					size: <?php echo $size;?>,       //  
					minValue: <?php echo $min;?>,   // 
                    maxValue: <?php echo $max;?>,   //  
                    threshold: <?php echo $threshold2;?>,  //  
                    section: Array(steelseries.Section(25,28,'rgba(0,255,0,0.3)')), //  
                    area: Array(steelseries.Section(28,30,'rgba(255,0,0,0.5)')), //  
                    titleString: '<?php echo $name2;?>', 
                    unitString: '<?php echo $type2;?>', 
                    frameDesign: steelseries.FrameDesign.CHROME, 
                    backgroundColor: steelseries.BackgroundColor.LIGHT_GRAY, 
                    pointerType: steelseries.PointerType.TYPE2, 
                    pointerColor: steelseries.ColorDef.BLUE,    //  
                    lcdColor: steelseries.LcdColor.BLUE2,       //             
                    ledColor: steelseries.LedColor.BLUE_LED,    //  
                    });
					
										
// Create a radial bargraph gauge
  var radial3 = new steelseries.RadialBargraph('canvas3', {
                    gaugeType: steelseries.GaugeType.TYPE3,
					valueGradient: valGrad, //////
					useValueGradient: true,	
					size: <?php echo $size;?>,       // 
					minValue: <?php echo $min;?>,   // 
                    maxValue: <?php echo $max;?>,   // 
					threshold: <?php echo $threshold3;?>,  // 
                    titleString: "<?php echo $name3;?>",                                
                    unitString: "<?php echo $type3;?>",          
                    frameDesign: steelseries.FrameDesign.BLACK_METAL,
                    backgroundColor: steelseries.BackgroundColor.LIGHT_GRAY,
                //    valueColor: steelseries.ColorDef.YELLOW,  //  
               //     lcdColor: steelseries.LcdColor.YELLOW,
               //     ledColor: steelseries.LedColor.YELLOW_LED,  //  
                    }); 
//=================================================================================
// Create a radial bargraph gauge
  var radial4 = new steelseries.RadialBargraph('canvas4', {
                    gaugeType: steelseries.GaugeType.TYPE4, //  
					valueGradient: valGrad,  //////////
					useValueGradient: true,					
					size: <?php echo $size;?>,       //  
					minValue: <?php echo $min;?>,   //  
                    maxValue: <?php echo $max;?>,   //  
					threshold: <?php echo $threshold4;?>,  //  
                    titleString: "<?php echo $name4;?>",                                
                    unitString: "<?php echo $type4;?>",          
                    frameDesign: steelseries.FrameDesign.BLACK_METAL,
                  //  backgroundColor: steelseries.BackgroundColor.LIGHT_GRAY,
                    valueColor: steelseries.ColorDef.YELLOW,  //  
                    lcdColor: steelseries.LcdColor.BLUE,      //  
                    ledColor: steelseries.LedColor.YELLOW_LED,  //  
                    }); 

//=================================================================================					
//=================================================================================
// Create a radial bargraph gauge
  var radial5 = new steelseries.RadialBargraph('canvas5', {
                    gaugeType: steelseries.GaugeType.TYPE5, //  
					valueGradient: valGrad,  //////////
					useValueGradient: true,					
					size: <?php echo $size;?>,       //  
					minValue: <?php echo $min;?>,   //  
                    maxValue: <?php echo $max;?>,   //  
					threshold: <?php echo $threshold5;?>,  //  
                    titleString: "<?php echo $name5;?>",                                
                    unitString: "<?php echo $type5;?>",          
                    frameDesign: steelseries.FrameDesign.BLACK_METAL,
                  //  backgroundColor: steelseries.BackgroundColor.LIGHT_GRAY,
                    valueColor: steelseries.ColorDef.YELLOW,  //  
                    lcdColor: steelseries.LcdColor.BLUE,      //  
                    ledColor: steelseries.LedColor.YELLOW_LED,  //  
                    }); 
//=================================================================================			
						
// Let's set some values...   
  radial1.setValueAnimated(<?php echo $a; ?>);
  radial2.setValueAnimated(<?php echo $b; ?>);
  radial3.setValueAnimated(<?php echo $c; ?>); 
  radial4.setValueAnimated(<?php echo $d; ?>);
  radial5.setValueAnimated(<?php echo $e; ?>);
  setInterval(function() {
          $.getJSON('http://localhost/finaljs000/tmon.json', function (json) { 
            radial1.setValueAnimated(json.sensor1['Humi']);
            radial2.setValueAnimated(json.sensor1['Temp']);
            radial3.setValueAnimated(json.sensor2['Temp']); 
            radial4.setValueAnimated(json.sensor3['Temp']);
			radial5.setValueAnimated(json.sensor5['Temp']);
          });
          //g1.refresh(10);
          
        }, 1000);

 
//=================================================================================		
// Initializing gauge
 var linear6 = new steelseries.Linear('canvasLinear6', {
 							gaugeType: steelseries.GaugeType.TYPE6,
                            titleString: "<?php echo $name6;?>",
                            unitString: "<?php echo $type6;?>",
                            threshold: <?php echo $threshold6;?>,
							width: <?php echo $width;?>,
                            height: <?php echo $height;?>,
							minValue: <?php echo $min;?>,    
                   			maxValue: <?php echo $max;?>,
                            threshold: 50,
                            lcdVisible: true
                            });
//=================================================================================	
  var linear7;
// Initializing gauge
        linear7 = new steelseries.LinearBargraph('canvasLinear7', {
							gaugeType: steelseries.GaugeType.TYPE7,
                            width: <?php echo $width;?>,
                            height: <?php echo $height;?>,
							minValue: <?php echo $min;?>,    
                   			maxValue: <?php echo $max;?>, 
							valueGradient: valGrad,
                            useValueGradient: true,
                            titleString: "<?php echo $name7;?>",
                            unitString: "<?php echo $type7;?>",
                            threshold: <?php echo $threshold7;?>,
                            lcdVisible: true });

// Start the random update
		setInterval(function(){ setRandomValue6(linear6, <?php echo $max;?>); }, 800); 
        setInterval(function(){ setRandomValue7(linear7, <?php echo $max;?>); }, 1000); 

     function setRandomValue6(gauge, range) {
		gauge.setValueAnimated(<?php echo $f; ?>); }
        //gauge.setValueAnimated6(Math.random() * range); }
	 function setRandomValue7(gauge, range) {
		gauge.setValueAnimated(<?php echo $h; ?>); }
        //gauge.setValueAnimated7(Math.random() * range); }

    function setFrameDesign(sel) {
        switch(sel.options[sel.selectedIndex].value) {
            case "BLACK_METAL":
                linear7.setFrameDesign(steelseries.FrameDesign.BLACK_METAL);
 //               linear7.setFrameDesign(steelseries.FrameDesign.METAL);
 //               linear7.setFrameDesign(steelseries.FrameDesign.SHINY_METAL);
 //               linear7.setFrameDesign(steelseries.FrameDesign.BRASS);
 //               linear7.setFrameDesign(steelseries.FrameDesign.STEEL);
//                linear7.setFrameDesign(steelseries.FrameDesign.CHROME);
//                linear7.setFrameDesign(steelseries.FrameDesign.GOLD);
//                linear7.setFrameDesign(steelseries.FrameDesign.ANTHRACITE);
//                linear7.setFrameDesign(steelseries.FrameDesign.TILTED_GRAY);
//                linear7.setFrameDesign(steelseries.FrameDesign.TILTED_BLACK);
//                linear7.setFrameDesign(steelseries.FrameDesign.GLOSSY_METAL);
				} }

    function setBackgroundColor(sel) {
        switch(sel.options[sel.selectedIndex].value) {
            case "DARK_GRAY":
//                linear7.setBackgroundColor(steelseries.BackgroundColor.DARK_GRAY);
                linear7.setBackgroundColor(steelseries.BackgroundColor.SATIN_GRAY);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.LIGHT_GRAY);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.WHITE);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.BLACK);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.BEIGE);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.BROWN);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.RED);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.GREEN);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.BLUE);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.ANTHRACITE);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.MUD);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.PUNCHED_SHEET);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.CARBON);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.STAINLESS);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.BRUSHED_METAL);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.BRUSHED_STAINLESS);
//                linear7.setBackgroundColor(steelseries.BackgroundColor.TURNED);
				} }

    function setValueColor(sel) {
        switch(sel.options[sel.selectedIndex].value) {
            case "RED":
                linear7.setValueColor(steelseries.ColorDef.RED);
//                linear7.setValueColor(steelseries.ColorDef.GREEN);
//                linear7.setValueColor(steelseries.ColorDef.BLUE);
//                linear7.setValueColor(steelseries.ColorDef.ORANGE);
//                linear7.setValueColor(steelseries.ColorDef.YELLOW);
//                linear7.setValueColor(steelseries.ColorDef.CYAN);
//                linear7.setValueColor(steelseries.ColorDef.MAGENTA);
//                linear7.setValueColor(steelseries.ColorDef.WHITE);
//                linear7.setValueColor(steelseries.ColorDef.GRAY);
//                linear7.setValueColor(steelseries.ColorDef.BLACK);
//                linear7.setValueColor(steelseries.ColorDef.RAITH);
//                linear7.setValueColor(steelseries.ColorDef.GREEN_LCD);
//                linear7.setValueColor(steelseries.ColorDef.JUG_GREEN);
        } }

    function setLcdColor(sel) {
        switch(sel.options[sel.selectedIndex].value) {
            case "BEIGE":
                linear7.setLcdColor(steelseries.LcdColor.BEIGE);
//                linear7.setLcdColor(steelseries.LcdColor.BLUE);
//                linear7.setLcdColor(steelseries.LcdColor.ORANGE);
//                linear7.setLcdColor(steelseries.LcdColor.RED);
//                linear7.setLcdColor(steelseries.LcdColor.YELLOW);
//                linear7.setLcdColor(steelseries.LcdColor.WHITE);
//                linear7.setLcdColor(steelseries.LcdColor.GRAY);
//                linear7.setLcdColor(steelseries.LcdColor.BLACK);
//                linear7.setLcdColor(steelseries.LcdColor.GREEN);
//                linear7.setLcdColor(steelseries.LcdColor.BLUE2);
//                linear7.setLcdColor(steelseries.LcdColor.BLUE_BLACK);
//                linear7.setLcdColor(steelseries.LcdColor.BLUE_DARKBLUE);
//                linear7.setLcdColor(steelseries.LcdColor.BLUE_GRAY);
//                linear7.setLcdColor(steelseries.LcdColor.STANDARD);
//                linear7.setLcdColor(steelseries.LcdColor.STANDARD_GREEN);
//                linear7.setLcdColor(steelseries.LcdColor.BLUE_BLUE);
//                linear7.setLcdColor(steelseries.LcdColor.RED_DARKRED);
//                linear7.setLcdColor(steelseries.LcdColor.DARKBLUE);
//                linear7.setLcdColor(steelseries.LcdColor.LILA);
//                linear7.setLcdColor(steelseries.LcdColor.BLACKRED);
//                linear7.setLcdColor(steelseries.LcdColor.DARKGREEN);
//                linear7.setLcdColor(steelseries.LcdColor.AMBER);
//                linear7.setLcdColor(steelseries.LcdColor.LIGHTBLUE);
//                linear7.setLcdColor(steelseries.LcdColor.SECTIONS);
        } }

    function setLedColor(sel) {
        switch(sel.options[sel.selectedIndex].value) {
            case "RED_LED":
                linear7.setLedColor(steelseries.LedColor.RED_LED);
//                linear7.setLedColor(steelseries.LedColor.GREEN_LED);
//                linear7.setLedColor(steelseries.LedColor.BLUE_LED);
//                linear7.setLedColor(steelseries.LedColor.YELLOW_LED);
//                linear7.setLedColor(steelseries.LedColor.CYAN_LED);
//                linear7.setLedColor(steelseries.LedColor.MAGENTA_LED);
        } }



      }



</script>



</body>


<script src="<?php echo base_url('theme');?>/assets/steelseriescanvas/tween-min.js"></script>
<script src="<?php echo base_url('theme');?>/assets/steelseriescanvas/steelseries-min.js"></script>
<script src="<?php echo base_url('theme');?>/assets/steelseriescanvas/jquery-1.10.2.js"></script>



 