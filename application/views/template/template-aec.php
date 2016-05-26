<?php $this->load->view('template/header'); ?>
<?php
################################## Body Content ################################
		/*echo "<pre>";
		print_r($this->uri->segments);
		echo "</pre>";*/		
		//if(isset($content_text)){echo $content_text;}
		if(isset($content_view) && !isset($content_data)){ $this->load->view($content_view); }
		if(isset($content_view) && isset($content_data)){
				foreach($content_data as $key => $value){ $data[$key] = $value; }
				$this->load->view($content_view,$data);
		} 
################################## Body Content ################################
?>
<?php $this->load->view('template/footer'); ?>