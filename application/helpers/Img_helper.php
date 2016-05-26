<?php
/**
 * Copy a whole Directory
 *
 * Copy a directory recrusively ( all file and directories inside it )
 *
 * @access    public
 * @param    string    path to source dir
 * @param    string    path to destination dir
 * @return    array
 */ 

if(!function_exists('img_src')){
    function img_src($images, $width = 100, $height = 57, $title=''){
			return '<img src="'.base_url($images).'" width="'.$width.'" height="'.$height.'" border="0" alt="'.$title.'">';
    }
}

if(!function_exists('resize_img')){
    function resize_img($images, $new_images, $width = 620, $jpegQuality = 60){

			$size=GetimageSize($images);
			$height=round($width*$size[1]/$size[0]);
			$images_orig = ImageCreateFromJPEG($images);

			$photoX = ImagesX($images_orig);
			$photoY = ImagesY($images_orig);

			$images_fin = ImageCreateTrueColor($width, $height);
			ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
			ImageJPEG($images_fin,$new_images, $jpegQuality);
			ImageDestroy($images_orig);
			ImageDestroy($images_fin);

    }
}

if(!function_exists('ss_watermark')){

    function ss_watermark($source, $folder = '', $picx = 1){

			if ($picx == 1){//รูปแนวนอน
				$ImageWatermark = "./images/siamdara_watermark1.png";
			}elseif ($picx == 2){//รูปแนวตั้ง
				$ImageWatermark = "./images/siamdara_watermark2.png";
			}else{//ให้เป็นรูปแนวนอน
				$ImageWatermark = "./images/siamdara_watermark1.png";
			}
			$source_file = "./uploads/news/".$folder."/".$source;

			$watermark = imagecreatefrompng($ImageWatermark);
			$imageURL = imagecreatefromjpeg($source_file);

			$sizeXY = getimagesize($ImageWatermark);
			$sourceXY = getimagesize($source_file);

			$watermarkX = $sizeXY[0];
			$watermarkY = $sizeXY[1];

			//$watermarkX = imagesx($watermark);
			//$watermarkY = imagesy($watermark);

			//imagecopy($imageURL, $watermark, imagesx($imageURL)/5, imagesy($imageURL)/5, 0, 0, $watermarkX, $watermarkY);
			//echo "imagecopy($imageURL, $watermark, ($sourceXY[0]/5), ($sourceXY[1]/5), 0, 0, $watermarkX, $watermarkY)";
			//die();

			//imagecopy($imageURL, $watermark, $sourceXY[0]/5, $sourceXY[1]/5, 0, 0, $watermarkX, $watermarkY);
			imagecopy($imageURL, $watermark, imagesx($imageURL)/5, imagesy($imageURL)/5, 0, 0, $watermarkX, $watermarkY);

			//imagejpeg($source_file, $source_file, 50); 
			header('Content-type: image/jpeg');

			imagejpeg($imageURL); 
			//imagepng($imageURL);
			imagedestroy($imageURL);

    }
}
/***********************************************************************/

if(!function_exists('waterMark')){

	function waterMark($thumb_name, $fileInHD, $WmLogo = 0, $stytext, $width = 0, $transparency = 75, $jpegQuality = 100, $margin = 140){
		//Note: This function was added in PHP 4.0.6 and requires GD 2.0.1 or later

				//if($wmFile=="")  $wmFile="img/Logo.gif";//140x140
				//if($wmFile == 1)  $wmFile="./images/siamdara_watermark1.gif"; else $wmFile="./images/siamdara_watermark2.gif";
				//if($wmFile == 1)  $wmFile="./images/siamdara_watermark1.png"; else $wmFile="./images/siamdara_watermark2.png";
				//500x300 300x500
				
				if($WmLogo == 0){
					$wmFile="./images/nowatermark.gif";		//nowatermark
					$transparency = 0;
				}else if($WmLogo == 1)
					$wmFile="./images/horizon-pattern.gif";			//horizon
				else if($WmLogo == 2)
					$wmFile="./images/vertical-pattern.gif";			//vertical
				else
					$wmFile="./images/gd-logo.gif";	

				$address ='';
				$wmImg   = imageCreateFromGIF($wmFile);
				//$wmImg   = imageCreateFromPNG($wmFile);
				@$jpegImg = imageCreateFromJPEG($thumb_name);

				// Water mark random position
				//$wmX = (bool)rand(0,1) ? $margin : (imageSX($jpegImg) - imageSX($wmImg)) - $margin;
				//$wmY = (bool)rand(0,1) ? $margin : (imageSY($jpegImg) - imageSY($wmImg)) - $margin;

				if($WmLogo == 4){ // จัดกลาง ขนาดเล็ก   waterMark234x96 px

						$wmX = (imageSX($jpegImg))-(imageSX($jpegImg)/2)-100;
						$wmY = (imageSY($jpegImg))-(imageSY($jpegImg)/2)-24;

				}else if($WmLogo == 3){ // จัดกลาง ขนาดใหญ่

						$wmX = (imageSX($jpegImg))-(imageSX($jpegImg)/2)-140;
						$wmY = (imageSY($jpegImg))-(imageSY($jpegImg)/2)-34;

				}else if($WmLogo == 6){ // จัดล่างขวา ขนาดเล็ก

						$wmX = (imageSX($jpegImg))-244;
						$wmY = (imageSY($jpegImg))-106;

				}else{  //if($WmLogo == 5) // จัดบนซ้าย ขนาดเล็ก
						$wmX = 10;
						$wmY = 10;				
				}

				/*echo "wmFile = $wmFile<br>";
				echo "wmX = $wmX : wmY = $wmY : imageSX = ".imageSX($wmImg)." : imageSY = ".imageSY($wmImg);
				die();*/

				/*if($width > 800){
						//BIG SIZE 1128x200
						$wmX = (imageSX($jpegImg))-(imageSX($jpegImg)/2)-75;
						$wmY = (imageSY($jpegImg))-(imageSY($jpegImg)/2)-15;
				}else{
						$wmX = (imageSX($jpegImg))-80;
						$wmY = (imageSY($jpegImg))-80;
				}*/

				//if($wmX<100) $wmX=100;
				//if($wmY<22) $wmY=22;

				// Water mark process
				imageCopyMerge($jpegImg, $wmImg, $wmX, $wmY, 0, 0, imageSX($wmImg), imageSY($wmImg), $transparency);

				if($address == "") 
					$string = $stytext;
				else
					$string = $address;

				//$orange = imagecolorallocate($jpegImg, 204, 204, 204);
				$txtcolor = imagecolorallocate($jpegImg, 255, 0, 200);#ff00cc

				//$px     = (imagesx($jpegImg) - 7.5 * strlen($string)) / 2;
				//imagestring($jpegImg, 5, 4, 10, $string, $txtcolor);

				// Overwriting image
				@ImageJPEG($jpegImg, $fileInHD, $jpegQuality);

				// The function will get as parameters the image name, the thumbnail name and the width and height desired for the thumbnail
				//$thumb=markThumb($fileInHD,$thumb_name,"240","136");
	}
}

if(!function_exists('Webtxt')){

	function Webtxt($fileInHD, $wmFile = 1, $stytext, $width = 0, $transparency = 70, $jpegQuality = 60, $margin = 140){
		//Note: This function was added in PHP 4.0.6 and requires GD 2.0.1 or later

				//if($wmFile=="")  $wmFile="img/logo-text.gif";
				if($wmFile == 1)  $wmFile="./images/siamdara_watermark1.gif"; else $wmFile="./images/siamdara_watermark2.gif";

				$wmImg   = imageCreateFromGIF($wmFile);
				@$jpegImg = imageCreateFromJPEG($fileInHD);

				$address ='';
				$wmX = 20;
				$wmY = 20;		

				// Water mark process
				@imageCopyMerge($jpegImg, $wmImg, $wmX, $wmY, 0, 0, imageSX($wmImg), imageSY($wmImg), $transparency);

				if($address=="") 
					$string = $stytext;
				else
					$string = $address;

				// Overwriting image
				@ImageJPEG($jpegImg, $fileInHD, $jpegQuality);
				// call the function that will create the thumbnail. The function will get as parameters the image name, the thumbnail name and the width and height desired for the thumbnail
	}
}

if(!function_exists('markThumb')){

	function markThumb($img_name,$filename,$new_w,$new_h){

				//get image extension.
				$ext=getExtension($img_name);
				//creates the new image using the appropriate function from gd library
				if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
				$src_img=imagecreatefromjpeg($img_name);

				if(!strcmp("png",$ext))
				$src_img=imagecreatefrompng($img_name);

				//gets the dimmensions of the image
				$old_x=imageSX($src_img);
				$old_y=imageSY($src_img);

				// next we will calculate the new dimmensions for the thumbnail image
				// the next steps will be taken: 
				// 1. calculate the ratio by dividing the old dimmensions with the new ones
				// 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
				// and the height will be calculated so the image ratio will not change
				// 3. otherwise we will use the height ratio for the image
				// as a result, only one of the dimmensions will be from the fixed ones

				$ratio1=@$old_x/$new_w;
				$ratio2=@$old_y/$new_h;

				if($ratio1>$ratio2) {
					$thumb_w=$new_w;
					$thumb_h=@$old_y/$ratio1;
				}else{
					$thumb_h=$new_h;
					$thumb_w=@$old_x/$ratio2;
				}

				// we create a new image with the new dimmensions
				$dst_img=@ImageCreateTrueColor($thumb_w,$thumb_h);

				// resize the big image to the new created one
				@imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 

				// output the created image to the file. Now we will have the thumbnail into the file named by $filename
				if(!strcmp("png",$ext))
				@imagepng($dst_img,$filename); 
				else
				imagejpeg($dst_img,$filename); 

				//destroys source and destination images. 
				@imagedestroy($dst_img); 
				imagedestroy($src_img); 
	}
}

if(!function_exists('getExtension')){

	function getExtension($str) {

			$fn=explode(".", $str);
			$maxs=sizeof($fn);
			$ext = $fn[$maxs-1];
			return $ext;

	}
}

if(!function_exists('ren_name')){
	function ren_name() {

			$Y = date("Y");
			$YY = date("y");
			$M = date("m");
			$D = date("d");
			$H = date("H");
			$I = date("i");
			$S = date("s");
			$SS = substr((string)microtime(), 2, 2);
			$datetime = $Y.'-'.$M.'-'.$D.' '.$H.':'.$I.':'.$S;
			$new_name = $YY.$M.$D.$H.$I.$S.$SS;
			
			return $new_name;
	}
}

if(!function_exists('rotateImage')){
	function rotateImage($sourceFile,$destImageName,$degreeOfRotation){
		  //function to rotate an image in PHP
		  //developed by Roshan Bhattara (http://roshanbh.com.np)

		  //get the detail of the image
		  $imageinfo=getimagesize($sourceFile);
			//create the image according to the content type
			switch($imageinfo['mime']){
				case "image/jpg":
				case "image/jpeg":
				case "image/pjpeg": //for IE
						$src_img=imagecreatefromjpeg("$sourceFile");
				break;
				case "image/gif":
						$src_img = imagecreatefromgif("$sourceFile");
				break;
				case "image/png":
				case "image/x-png": //for IE
						$src_img = imagecreatefrompng("$sourceFile");
				break;
		  }
		  //rotate the image according to the spcified degree
		  $src_img = imagerotate($src_img, $degreeOfRotation, 0);
		  //output the image to a file
		  imagejpeg ($src_img,$destImageName,99);
	}
}
