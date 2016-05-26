<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('CompareID')){
		function CompareID($id, $obj, $obj_name){
				
			if($obj){
					$maxnumber = count($obj);
					for($i=0;$i<$maxnumber;$i++){
							if($id == $obj[$i]->$obj_name){
								return true;
							}
					}
			}
			return false;
		}
}

if ( ! function_exists('Alert')){
	function Alert($msg, $url = ''){
		if($url == '')
			echo '<script type="text/javascript">alert(\''.$msg.'\');</script>';
		else
			echo '<script type="text/javascript">alert(\''.$msg.'\');window.location=\''.$url.'\'</script>';
	}
}

if ( ! function_exists('StripTxt')){
		function StripTxt($content){ //Rename Title

					$text = strip_tags($content);
					$text=str_replace("\"","&#34;",$text);
					$text=str_replace("'","&#39;",$text);
					$text=str_replace("!","&#33;",$text);
					$text=str_replace("!","&#33;",$text);
					$text=str_replace("?","&#63;",$text);

					/*$pattern = '|[[\/\!]*?[^\[\]]*?]|si';
					$replace = '';
					$text = preg_replace($pattern, $replace, $text);*/

				return $text;
		}
}

if ( ! function_exists('URLTitle')){
		function URLTitle($content){ //Rename Title

					$text = strip_tags($content);
					$text=str_replace("\"","",$text);
					$text=str_replace("'","",$text);
					$text=str_replace("!","",$text);
					$text=str_replace("!","",$text);
					$text=str_replace("?","",$text);
					$text=str_replace("' ","-",$text);

					/*$pattern = '|[[\/\!]*?[^\[\]]*?]|si';
					$replace = '';
					$text = preg_replace($pattern, $replace, $text);*/

				return $text;
		}
}

if ( ! function_exists('Qtitle')){
		function Qtitle($text){
					$text=str_replace("\"","",$text);
					$text=str_replace("'","",$text);
				return trim($text);
		}
}

if ( ! function_exists('ClearTxt')){
		function ClearTxt($content){ //Rename Title

					$patterns = array();
					$patterns[0] = '/ /';
					$patterns[1] = '/\'/';
					$patterns[2] = '/"/';
					$patterns[3] = '/\./';
					$patterns[4] = '/\?/';
					$patterns[5] = '/\!/';
					$patterns[6] = '/\#33;/';
					$patterns[7] = '/\#34;/';
					$patterns[8] = '/\#39;/';
					$patterns[9] = '/\#44;/';
					$patterns[10] = '/\&/';
					$replacements = '-';
					$text = preg_replace($patterns, $replacements, $content);

					return $text;
		}
}

if ( ! function_exists('RewriteTitle')){
		function RewriteTitle($content){ //Rename Title

					$text = ClearTxt($content);

					$text=str_replace("-----","-",$text);
					$text=str_replace("----","-",$text);
					$text=str_replace("---","-",$text);
					$text=str_replace("--","-",$text);

					$text=str_replace("-","",$text);	//ตัว - ออก

					$text = strip_tags($text);

					return $text;
		}
}

if ( ! function_exists('JsonContent')){
		function JsonContent($text){
					$text=str_replace("\"","&#34;",$text);
					$text=str_replace("'","&#39;",$text);
					/*$pattern = '|[[\/\!]*?[^\[\]]*?]|si';
					$replace = '';
					$text = preg_replace($pattern, $replace, $text);*/
				return $text;
		}
}

if ( ! function_exists('DisplayTxt')){
		function DisplayTxt($Text, $number = 100){
				if (strlen($Text) > $number){
							if(strpos($Text," ",$number)!==false){
									$Text=mb_substr($Text,0,$number,'UTF-8');
									$Text.="...";	
							}else{
									$Text=mb_substr($Text,0,$number,'UTF-8');
									$Text.="...";	
							}
				}
				return $Text;
		}
}

if ( ! function_exists('chkAscii')){
	function chkAscii($text){
		//$text=str_replace("&#34;",chr(34),$text);
		$text=str_replace("&#34",chr(34),$text);
		//$text=str_replace("&#39;",chr(39),$text);
		$text=str_replace("&#39",chr(39),$text);
		$text=str_replace("&quot",chr(34),$text);
		$text=str_replace("&#44",chr(44),$text);
		$text=str_replace("&#60",chr(60),$text);
		$text=str_replace("&#62",chr(62),$text);
		$text=str_replace("<dd>","<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$text);
		$text=str_replace("<DD>","<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$text);
		$text=str_replace("</dd>","",$text);
		$text=str_replace("</DD>","",$text);
		return $text;
	}
}

if ( ! function_exists('ShowTopic')){
		function ShowTopic($text){
			$text = str_replace(array("&quot;","&#34;"), "", $text);
			$text = str_replace('&#34','"',str_replace('<dd>','',str_replace('&#39',"'",str_replace('&#44',",",str_replace('&#39;',"'", $text)))));
			$textN=@iconv("tis620","utf-8",$text);
			//$textN=@iconv("tis620","utf-8",chkAscii($text));
			$textN=strip_tags($textN);
			return $textN;
		}
}

if ( ! function_exists('ShowContent')){
		function ShowContent($text){
			
			//$textN=@iconv("tis620","utf-8",chkAscii($text));
			$textN=chkAscii($text);
			$textN=strip_tags($textN);
			return $textN;
		}
}

if ( ! function_exists('DateTH')){

		function DateTH($chkdate) {
				//YYYYMMDD
				if($chkdate != '' && $chkdate != "0000-00-00"){

						$thai_month_arr=array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
			
						$arrdate = explode("-", $chkdate);
						if(count($arrdate) > 1){
							$year=$arrdate[0];
							$month=$arrdate[1];
							$day=$arrdate[2];
						}else{
							$year=substr($chkdate, 0, 4);
							$month=substr($chkdate, 4, 2);
							$day=substr($chkdate, -2);
						}

						if($year < 2500) $year += 543;
						$newDate = $day." ".$thai_month_arr[$month]." ".$year;
				}else{
						$newDate = '-';
				}
				return $newDate;
		}
}

if ( ! function_exists('RenDateTime')){
	function RenDateTime($date) {
		if ($date == "0000-00-00 00:00:00") {
			return "Undefined";
		} else {
			
			$_results = array();
	
			$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
			$thai_month_arr=array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
	
			$_results = explode(" ", $date);
			//list($date, $time) = strtok($date, " ");
			
			$listdatetime = explode("/", $_results[0]);
			//Debug($listdatetime);
			//echo $date;
			if(sizeof($listdatetime) == 1)
				@list($y, $m, $d) = explode("-", $_results[0]);
				//list($y, $m, $d) = strtok($date, "-");
			else
				list($d, $m, $y) = explode("/", $_results[0]);
				//list($d, $m, $y) = strtok($date, "/");
				
			if($y < 2500) $y += 543;
			
			@$newDate = $d." ".$thai_month_arr[$m]." ".$y." ".$_results[1];
			//$newDate = date("d m Y H:i:s", strtotime($date));
			return $newDate;
		}
	}
}

if ( ! function_exists('DateDB')){
	function DateDB($date) {
			//Convert into DB

			$objchk = explode("/", $date);
			if(count($objchk)<=1){
					//list($date, $time) = explode(" ", $date); //0000-00-00 00:00:00
					if($date != ''){
							@list($dd, $mm, $yy) = explode("-", $date); //d-m-Y
							return "$yy-$mm-$dd";
					}else
							return $date;
			
			}else{
					//list($date, $time) = explode(" ", $date); //0000-00-00 00:00:00
					if($date != ''){
							@list($mm, $dd, $yy) = explode("/", $date); //m/d/Y
							return "$yy-$mm-$dd";
					}else
							return $date;
			}
	}
}

if ( ! function_exists('DateTimeDB')){
	function DateTimeDB($inputdate) {
			
			$date = $time = $time2 = "";
			//$arr = explode(" ", $inputdate);
			//echo "<p>$inputdate</p>";
			//Debug($arr);

			//list($date, $time) = explode(" ", $date); //0000-00-00 00:00:00
			@list($date, $time, $time2) = explode(" ", $inputdate);
			@list($hr, $min) = explode(":", $time); 

			//echo "<hr>$time  $time2<hr>";

			if($time2 == "PM"){
				$hr = $hr +12;
				if($hr == 24) $hr = 0;
				$time = "$hr:$min:00";
			}else
				$time = "$hr:$min:00";

			if($date != ''){
					@list($mm, $dd, $yy) = explode("/", $date); //Y-m-d => d-m-Y
					return "$yy-$mm-$dd $time";
			}else
					return $inputdate;
	}
}

if ( ! function_exists('DisplayDate')){
	function DisplayDate($date) {
			@list($yy, $mm, $dd) = explode("-", $date);
			return "$dd-$mm-$yy";			
	}
}

if ( ! function_exists('ConvertDate8toFormat')){
	function ConvertDate8toFormat($date, $tag = '-') {

		if(strlen($date) == 8){
			$newdate = substr($date, 0, 4).$tag.substr($date, 4, 2).$tag.substr($date, 6, 4);
		}else $newdate = $date;
		return $newdate;
	}
}

if ( ! function_exists('DisplayDateRange')){
	function DisplayDateRange($date, $format = 1) {

		if($format == 1){ //0000-00-00 00:00:00
			list($date, $time) = explode(" ", $date); 
			list($yy, $mm, $dd) = explode("-", $date);
			return "$mm/$dd/$yy $time";
		}else{	//0000-00-00
			list($yy, $mm, $dd) = explode("-", $date);
			//return "$mm/$dd/$yy";
			return "$dd-$mm-$yy";
		
		}
	}
}

if ( ! function_exists('numbershort')){
	function numbershort($number) {
			
			$len = strlen($number);
			if($len > 6){
					$newnumber  = substr($number, 0, $len - 6).'M';
			}else if($len > 3){
					$newnumber  = substr($number, 0, $len - 3).'K';
			}else
					$newnumber = $number;
			return $newnumber;
	}
}

if ( ! function_exists('ReadXML')){
		function ReadXML($xml, $folder = "", $return = ""){
			$list = str_split($xml,2);
			$folder = $list[0].'/'.$list[1];
			if(file_exists("../news_contents/".$folder."/".$xml.".xml")){
					$xml=simplexml_load_file("../news_contents/".$folder."/".$xml.".xml");
					$content = array();
					$content_name = array();
					foreach($xml->children() as $child){
							$content[$child->getName()] = $child;
					}
					//Debug($content);
					//echo $content['TypeSportSub'];
					return $content;
			}else{
					return false;
			}
			//echo $content;
		}
}

if ( ! function_exists('slip_page')){
		function slip_page($display, $all){
				return ceil($all/$display);
		}
}

if ( ! function_exists('replace_url')){
		function replace_url($redirect_uri){
				$redirect_uri = str_replace(":", "%3A", $redirect_uri);
				$redirect_uri = str_replace("/", "%2F", $redirect_uri);
				$redirect_uri = str_replace("?", "%3F", $redirect_uri);
				$redirect_uri = str_replace("=", "%3D", $redirect_uri);
				$redirect_uri = str_replace("-", "%2D", $redirect_uri);
				return $redirect_uri;
		}
}

if ( ! function_exists('button_share')){
		function button_share($url = '', $url_org = '', $mode='thai'){

			$shear = $fbshear = '';
			$fbshear = str_replace("&", "&amp;", $url);
			
			/*$shear = '<ul>
			<li><div class="fb-like" data-href="'.$fbshear.'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div></li>
			<li><div class="g-plus" data-action="share" data-annotation="bubble"></div></li>
			<li><a href="'.$url.'" class="twitter-share-button" data-url="'.$url.'" data-lang="en">Tweet</a></li>
			</ul>';*/
			$shear = '<ul>
			<li><a href="'.$url.'" class="twitter-share-button" data-url="'.$url.'" data-lang="en">Tweet</a></li>
			</ul>';

			return $shear;
		}
}

if ( ! function_exists('shear_title')){
		function shear_title($text){

			$shear_title = str_replace("&#34;", "", $text);
			$shear_title = str_replace("&#33;", "", $shear_title);
			$shear_title = chkAscii($shear_title);

			$shear_title = str_replace("\"", "", $shear_title);
			$shear_title = str_replace("&", "&amp;", $shear_title);
			$shear_title = str_replace("<", "&lt;", $shear_title);
			$shear_title = str_replace(">", "&gt;", $shear_title);
			$shear_title = str_replace("!", "", $shear_title);
			$shear_title = str_replace("'", "", $shear_title);
			$shear_title = str_replace(";", "", $shear_title);

			return $shear_title;
		}
}

if ( ! function_exists('isValidEmail')){
		function isValidEmail($email){
			return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
		}
}

if ( ! function_exists('MultiSelectList')){
	function MultiSelectList(& $arr, $tag_name, $tag_attribs, $key, $text, $selected = NULL) {
		reset($arr);
		
		//echo "(& ".var_dump($arr).", $tag_name, $tag_attribs, $key, $text, $selected = NULL) ";
		$id = '';
		//$html = "\n<select name=\"$tag_name\" $tag_attribs id=\"$tag_name\">";
		$html = "\n<select name=\"".$tag_name."[]\" $tag_attribs id=\"$tag_name\" data-placeholder=\"Choose a item...\" multiple>";
		for ($i = 0, $n = count($arr); $i < $n; $i++) {

			$k = @$arr[$i]->$key;
			$t = $arr[$i]->text;
			$c = @$arr[$i]->clss;
			$id =  @$arr[$i]->id;

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array($selected)) {
				foreach ($selected as $obj) {
					//echo "($k == $k2) $k2 = $obj->$key == ".$obj->$key."<br>";
					if(isset($obj->$key))$k2 = $obj->$key; else  $k2 = $obj;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " selected=\"selected\"" : '');
			}
			$html .= "\n\t<option value=\"" . $k . "\"$extra $c>" . $t . "</option>";
		}
		$html .= "\n</select>\n";
		
		//echo $html;
		return $html;
	}
}

if ( ! function_exists('selectList')){
	function selectList(& $arr, $tag_name, $tag_attribs, $key, $text, $selected = NULL) {
		reset($arr);
		$id = '';
		$html = "\n<select name=\"$tag_name\" $tag_attribs id=\"$tag_name\">";
		for ($i = 0, $n = count($arr); $i < $n; $i++) {

			$k = @$arr[$i]->$key;
			$t = $arr[$i]->text;
			$c = @$arr[$i]->clss;
			$id =  @$arr[$i]->id;

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array($selected)) {
				foreach ($selected as $obj) {
					$k2 = $obj-> $key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " selected=\"selected\"" : '');
			}
			$html .= "\n\t<option value=\"" . $k . "\"$extra $c>" . $t . "</option>";
		}
		$html .= "\n</select>\n";
		return $html;
	}
}

if ( ! function_exists('selectListOrder')){
	function selectListOrder(& $arr, $tag_name, $tag_id, $tag_attribs, $key, $text, $selected = NULL, &$pin_list = array()) {
		reset($arr);

		$count_pin = count($pin_list);
		$id = '';
		$html = "\n<select name=\"$tag_name\" $tag_attribs id=\"$tag_id\">";
		for ($i = 0, $n = count($arr); $i < $n; $i++) {

			$k = @$arr[$i]->$key;
			$t = $arr[$i]->text;
			$c = @$arr[$i]->clss;
			$id =  @$arr[$i]->id;

			$pin_disp = 1;
			if($count_pin > 0){
					for($p=0;$p<$count_pin;$p++){
							if($k == $pin_list[$p]->pin){
								$pin_disp = 0;
							}
					}
			}

			if($pin_disp == 1){
					$extra = '';
					$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
					if (is_array($selected)) {
						foreach ($selected as $obj) {
							$k2 = $obj-> $key;
							if ($k == $k2) {
								$extra .= " selected=\"selected\"";
								break;
							}
						}
					} else {
						$extra .= ($k == $selected ? " selected=\"selected\"" : '');
					}
					$html .= "\n\t<option value=\"" . $k . "\"$extra $c>" . $t . "</option>";
			}
		}
		$html .= "\n</select>\n";
		return $html;
	}
}

if ( ! function_exists('action_view_logs')){
	function action_view_logs($action_view_logs) {

		switch($action_view_logs){
					case 1 : $result = 'Create'; break;
					case 2 : $result = 'Edit'; break;
					case 3 : $result = 'Delete'; break;
					default : $result = 'Create'; break;
		}
		return $result;
	}
}

if ( ! function_exists('makeOption')){
	function makeOption($value, $text = '', $clss="") {
		$obj = new stdClass;
		$obj->value = $value;
		$obj->text = trim($text) ? $text : $value;
		if($clss){
			$obj->clss = " $clss ";
		}
		return $obj;
	}
}

if ( ! function_exists('GenPage')){
	function GenPage($curpage, $this_page = 1, $list_page, $total) {
		
		$html = '';

		$displayed_pages = 10;
		$display2 = 5;
		$disabled = '';

		//echo "GenPage($curpage, $this_page, $list_page, $total)";
		$total_pages = ceil( $total / $list_page );

		$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}
		
		//$list_page = $list_page;

		if($this_page > $displayed_pages){
				if(($total_pages - $displayed_pages) < $this_page)
					$maxpage = $total_pages;
				else
					$maxpage = $this_page + $display2;
		}else if($this_page == $displayed_pages){
				$maxpage = $this_page + $display2;
		}else{
				$maxpage = ($total_pages > $displayed_pages) ? $displayed_pages : $total_pages;
		}

		if($this_page > $displayed_pages){
			if(($total_pages - $displayed_pages) >= $this_page)
				$startpage = $this_page - $display2;
			else
				$startpage = $total_pages - $displayed_pages;
		}else if($this_page == $displayed_pages){
			$startpage = $this_page - $display2;
		}else
			$startpage = 1;

		if($this_page == 1) $disabled =  'class="disabled"';
		$html .= '<ul class="pagination pagination-sm"><li '.$disabled.' ><a href="'.$curpage.'&p=1">«</a></li>';


		for($i=$startpage;$i<=$maxpage;$i++){
				if($this_page == $i){
						$html .= '<li class="active"><a href="'.$curpage.'&p='.$i.'">'.$i.'</a></li>';
				}else{
						$html .= '<li><a href="'.$curpage.'&p='.$i.'">'.$i.'</a></li>';
				}
		}
		$disabled = '';
		if($this_page == $total_pages) $disabled =  'class="disabled"';
		$html .= '<li '.$disabled.'><a href="'.$curpage.'&p='.$total_pages.'">»</a></li>
              </ul>';

		return $html;
	}
}
