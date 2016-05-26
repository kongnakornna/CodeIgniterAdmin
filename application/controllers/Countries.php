<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/

class Countries extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        $this->load->model('Countries_model');
        $breadcrumb = array();
        
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){
		
		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
		$language = $this->lang->language;

		//$breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].'</a>';
		$breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].'</a>';			              
        $breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
        $breadcrumb[] =$language['province'];			
	    $breadcrumb[] = $language['amphur'];
	    $breadcrumb[] = $language['district'];

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					//die();

					if(isset($search_form['selectid'])){
							$selectid = $search_form['selectid'];
							$order = $search_form['order'];
							$maxsel = count($selectid);
							$tmp = 0;

							for($i=0;$i<$maxsel;$i++){

									$this->Countries_model->update_order($selectid[$i], $order[$i]);
									//Debug($this->db->last_query());
									if($tmp > $order[$i]){
											//Update ID ด้านหน้า
											//$this->Countries_model->update_orderid_to_down($order[$i]);
									}

									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
									//echo "<hr>$tmp > ".$order[$i]."<hr>";

							}
							$data['success'] = "Save success.";
					}
					//die();
			}

			//"admin_menu" => $this->menufactory->getMenu(),
			$data = array(				
					"countries" => $this->Countries_model->get_na_countries(),
					"content_view" => 'address/countries',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb
			);

			$this->load->view('template/template',$data);
	}
}