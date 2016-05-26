<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Na_model extends CI_Model 
{

	public $notification=1;
	public $num_rows;
	public $thispage;
	private $message='';
	private $num_exe=0;
	private $config=array();
	private $page;
	private $gen_pages;

	public function __construct()
	{
		parent::__construct();
		$this->config();
	}
	private function config()
	{
		$this->page['per_page'] = 10;
		$this->page['num_links'] = 3;
		$this->page['first_link']	= 'First';
		$this->page['next_link'] = 'Next';
		$this->page['prev_link'] = 'Prev';
		$this->page['last_link']	= 'Last';
		$this->page['cur_tag_open'] = '<li><a href="#" class="current">';
		$this->page['cur_tag_close']	= '</a></li>';
		$this->page['full_tag_open']	= '<nav class="pagination">
													<ul>';
		$this->page['full_tag_close']	= '</ul>
													</nav>';
		$this->page['next_tag_open'] = '<li>';
		$this->page['next_tag_close'] = '</li>';
		$this->page['prev_tag_open'] = '<li>';
		$this->page['prev_tag_close'] = '</li>';
		$this->page['num_tag_open'] = '<li>';
		$this->page['num_tag_close'] = '</li>';
		$this->page['first_tag_open'] = '<li>';
		$this->page['first_tag_close'] = '</li>';
		$this->page['last_tag_open'] = '<li>';
		$this->page['last_tag_close'] = '</li>';
		$this->page['uri_segment'] = 3;
	}

	public function pages($numtable, $link)
	{
		$this->page['base_url']	 = na($link);
		$this->page['total_rows'] = $numtable;
        $this->pagination->initialize($this->page);
        $this->thispage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	}
	public function pagination()
	{
		return $this->pagination->create_links();
	}

	public function setpage($n)
	{
		$this->page['per_page'] = $n;
	}
	
	public function perpage()
	{
		return $this->page['per_page'];
	}

	public function delete($table, $id, $input)
	{

		try {
			$n=0;
			$this->db->trans_begin();
			foreach($input as $val)
			{
				$this->db->delete($table, array($id => $val));
				++$n;
			}
			$this->db->trans_commit();
			$this->notification=1;
			$this->message('Delete has been executed successfully # '.$n.' '.$this->unit($n));
		} 
		catch(PDOException $ex) 
		{
			$this->db->trans_rollback();
			die($this->message($ex->getMessage()));
			$this->notification=0;
		}

	}

	private function message($message)
	{
		$this->message=$message;
	}

	private function unit($n, $str='')
	{
		$string='row';
		if( !empty($str) )
			$string=$str;
		if( $n>1 )
			$string.='s';
		return $string;
	}

	public function get_message($notification=TRUE)
	{
		$msg=$this->message;
		if( $notification==TRUE )
			$msg=$this->notification.$this->message;
		return $msg;
	}
	
	public function chklink($link='', $total=0, $perpage=10, $n=3)
	{
		$redirect=$link.'/';

		if( $this->uri->segment($n) )
		{
			$segment=$this->uri->segment($n);

			if( $segment == $total)
				$page=$segment - $perpage;
			else
				$page=$segment;
				
			if( $total > $perpage )
			{
				$redirect.=$page;
			}
		}
		return redirect(admin($redirect));
	}

	public function settings()
	{
		return $this->db->get('settings')->result_array();
	}

	public function __destruction()
	{
		$this->db->close();
	}

}


/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */
