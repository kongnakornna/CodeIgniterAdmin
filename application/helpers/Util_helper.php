<?php
function doPagination($total_rows, $limit= 100, $segment = 3, $base_url) {
	// Pagination section
		$config = array();
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $segment;
		$config['base_url'] = $base_url;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 5;

		$config['next_link'] = '>> Next';
		$config['prev_link'] = 'Last <<';
		$config['first_link'] = "First";
		$config['last_link'] = "Last";

		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';
		
		//$config['full_tag_open'] = '<ul class="pagination"><div><ul class="pagination pagination-lg">';
		//$config['full_tag_close'] = '</ul></div></div>';

		$config['first_link'] = '« First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last »';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next →';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '← Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
	
	
	return $config;
}
?>