<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model 
{
	private $table='email_reciever';
	private $view='email';
	private $perpage;

	public function __construct()
	{
		parent::__construct();
		$this->perpage=$this->db1->perpage();
	}

	public function add()
	{
		if ( isset($_POST['submit']) )
		{
			$query = $this->db->get_where($this->table, array('email' => $this->input->post('email')));
			if( $query->num_rows() > 0 )
			{
				$this->session->set_flashdata('message', '0มีข้อมูล '.$this->input->post('email').' อยู่ในระบบอยู่แล้ว...');
				redirect(admin('email/'));
			}
			else
			{
				$data = array(
						'account' => $this->input->post('account') ,
						'email' => $this->input->post('email') ,
						'active' => 'Y'
				);
				$this->db->set('created', 'NOW()', FALSE);//$this->db->set('time', 'NOW() + INTERVAL 1 DAY', FALSE);
				$this->db->insert($this->table, $data); 
				$this->session->set_flashdata('message', '1Inserted # 1 row ('.$this->input->post('email').')');
				redirect(admin($this->view.'/'.$this->chk_zero(( ceil($this->db->count_all($this->table) / $this->db1->perpage()) - 1 ) * $this->db1->perpage())));

			}
		}
	}

	private function chk_zero($num)
	{
		if( $num==0 )
			$num='';
		return $num;
	}

	public function delete()
	{
		if ( isset($_POST['btnDelete']) )
		{
			$this->db1->delete($this->table, 'id', $this->input->post('del'));
			$this->session->set_flashdata('message', $this->db1->get_message());
			sleep(1);
			$this->db1->chklink($this->view, $this->db->count_all($this->table), $this->db1->perpage());
			exit();
		}
	}

	public function pages()
	{
		$this->db1->pages($this->num_rows(), $this->view);
		return $this->db->get($this->table, $this->db1->perpage(), $this->db1->thispage)->result_array();
	}
	
	public function num_rows()
	{
		return $this->db->count_all($this->table);
	}

	public function __destruction()
	{
		$this->db->close();
	}


}


/* End of file email_model.php */
/* Location: ./application/models/email_model.php */


