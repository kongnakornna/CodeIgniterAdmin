<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('Img_Youtube')){
		function Img_Youtube($url_youtube){
				
				$img_youtube = explode("=", $url_youtube);
				if(count($img_youtube) > 1){
						//echo "<br>Long";
						$alink = $thumb_youtube = 'http://img.youtube.com/vi/'.$img_youtube[1].'/0.jpg';
				}else{
						//echo "<br>Short";
						$img_youtube = explode("youtu.be/", $url_youtube);
						$alink = $thumb_youtube = 'http://img.youtube.com/vi/'.$img_youtube[1].'/0.jpg';
				}
				return $thumb_youtube;
		}
}
