<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @author ToiYeuCNTT.Blogspot.com
 * @copyright kongnakorn  jantakun 2015
 */

 //Start**************Log activity
 $action = 1;
 $ref_id='0';
 $language = $this->lang->language;
 $amin_menu = $language['admin_menu'];
 $add_typett = $language['add'];
 $edie_typett = $language['edit'];
 $savedata = $language['savedata'];
 //**************Log activity  	
	$log_activity = array(
						"admin_id" => $this->session->userdata('admin_id'),
						"ref_id" => $ref_id,
						"ref_type" => 0,
						"ref_title" => $edie_typett." : ".$obj_en['title'].':'.$obj_th['title'],
						"action" => $action
		                );			
		$this->admin_log_activity_model->store($log_activity);
//**************Log activity
		if($this->admin_log_activity_model->store($log_activity)){
			 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			    echo "alert('$savedata');
				window.location='" . base_url() . "admin_menu'";
				echo "</script>";
				exit();
 #redirect('admin_menu');
			}
//End**************Log activity
?>