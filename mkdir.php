<?php
// Report all errors
error_reporting(E_ALL);
//$basepath = '/var/www/html/m_siamsport/dara_backend';
$basepath = '.';

if ( ! function_exists('ConvertDate8toFormat')){
	function ConvertDate8toFormat($date, $tag = '-') {

		if(strlen($date) == 8){
			$newdate = substr($date, 0, 4).$tag.substr($date, 4, 2).$tag.substr($date, 6, 4);
		}else $newdate = $date;
		return $newdate;
	}
}

	function chkfolder_exists($folder, $type='news'){

				$upload_path = './uploads/'.$type.'/'.$folder;
				if(!is_dir($upload_path)){
					$result = mkdir($upload_path, 0777);
					if ($result == 1) {
						echo "<br>Create Folder <b>".$upload_path ."</b>";
						echo " Success creating directory!";
					} else {
						echo "<p>Error creating <b>".$upload_path ."</b> directory!<p>";
					}
				}

				$upload_path = './uploads/tmp/'.$folder;
				if(!is_dir($upload_path)){
					$result = mkdir($upload_path, 0777);
					if ($result == 1) {
						echo "<br>Create Folder <b>".$upload_path ."</b>";
						echo " Success creating directory!";
					} else {
						echo "<p>Error creating <b>".$upload_path ."</b> directory!<p>";
					}
				}

				$upload_path = './uploads/tmp2/'.$folder;
				if(!is_dir($upload_path)){
					$result = mkdir($upload_path, 0777);
					if ($result == 1) {
						echo "<br>Create Folder <b>".$upload_path ."</b>";
						echo " Success creating directory!";
					} else {
						echo "<p>Error creating <b>".$upload_path ."</b> directory!<p>";
					}
				}

				$upload_path = './uploads/thumb/'.$folder;
				if(!is_dir($upload_path)){
					$result = mkdir($upload_path, 0777);
					if ($result == 1) {
						echo "<br>Create Folder <b>".$upload_path ."</b>";
						echo " Success creating directory!";
					} else {
						echo "<p>Error creating <b>".$upload_path ."</b> directory!<p>";
					}
				}

				$upload_path = './uploads/thumb2/'.$folder;
				if(!is_dir($upload_path)){
					$result = mkdir($upload_path, 0777);
					if ($result == 1) {
						echo "<br>Create Folder <b>".$upload_path ."</b>";
						echo " Success creating directory!";
					} else {
						echo "<p>Error creating <b>".$upload_path ."</b> directory!<p>";
					}
				}

				$upload_path = './uploads/thumb3/'.$folder;
				if(!is_dir($upload_path)){
					$result = mkdir($upload_path, 0777);
					if ($result == 1) {
						echo "<br>Create Folder <b>".$upload_path ."</b>";
						echo " Success creating directory!";
					} else {
						echo "<p>Error creating <b>".$upload_path ."</b> directory!<p>";
					}
				}

				$upload_path = './uploads/thumb4/'.$folder;
				if(!is_dir($upload_path)){
					$result = mkdir($upload_path, 0777);
					if ($result == 1) {
						echo "<br>Create Folder <b>".$upload_path ."</b>";
						echo " Success creating directory!";
					} else {
						echo "<p>Error creating <b>".$upload_path ."</b> directory!<p>";
					}
				}

				$upload_path = './uploads/headnews/'.$folder;
				if(!is_dir($upload_path)){
					$result = mkdir($upload_path, 0777);
					if ($result == 1) {
						echo "<br>Create Folder <b>".$upload_path ."</b>";
						echo " Success creating directory!";
					} else {
						echo "<p>Error creating <b>".$upload_path ."</b> directory!<p>";
					}
				}

				$upload_path = './uploads/menu/'.$folder;
				if(!is_dir($upload_path)){
					$result = mkdir($upload_path, 0777);
					if ($result == 1) {
						echo "<br>Create Folder <b>".$upload_path ."</b>";
						echo " Success creating directory!";
					} else {
						echo "<p>Error creating <b>".$upload_path ."</b> directory!<p>";
					}
				}

	}

echo "<br>Create Folder" ;	

//$type = 'news';
//$type='column';
$type = 'gallery';
$folder = '2015/01/16';

		$folder_img = explode("/", ConvertDate8toFormat($folder));
		$tmp_folder = '';
			if(isset($folder_img)){
					foreach($folder_img as $val){
							$tmp_folder .= $val.'/';
							echo "<hr><b>tmp_folder = $tmp_folder ($type)</b>";
							//$upload_path = $basepath.'/uploads/'.$type.'/'.$tmp_folder;
							chkfolder_exists($tmp_folder, $type);
					}
			}


?>