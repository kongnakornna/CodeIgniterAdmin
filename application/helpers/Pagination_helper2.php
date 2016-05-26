<?php
function doPagination($total_rows, $limit= 50, $segment = 3,$startdate=NULL,$enddate=NULL,$base_url) {
	// Pagination section
		$config = array();
		$config['total_rows'] = $total_rows;
		$config['startdate'] = $startdate;
		$config['enddate'] = $enddate;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $segment;
		$config['base_url'] = $base_url;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 5;
		//$config['full_tag_open'] = '<ul class="pagination pagination-lg">';
		//$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		//$config['full_tag_open'] = '<ul class="pagination pagination-teal">';
		//$config['full_tag_open'] = '<ul class="pagination pagination-green">';
		$config['full_tag_open'] = '<ul class="pagination pagination-green-lg">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = '« First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last »';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = ' »';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '« ';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
	return $config;
}
?>