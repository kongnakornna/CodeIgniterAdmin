<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Api2 extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function get_sub_model()
	{
		$model_id = intval($_GET['model_id']);
		if ( ! $model_id) {
			exit;
		}

		echo json_encode($this->Api_model->get_sub_model($model_id));
	}

}

/* End of file api.php */
/* Location: ./application/controllers/api.php */