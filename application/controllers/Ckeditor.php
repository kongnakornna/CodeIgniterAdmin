<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Ckeditor extends CI_Controller {

    public $data     =     array();

    public function __construct() {

        parent::__construct();

        $this->load->helper('url'); //You should autoload this one ;)
        $this->load->helper('ckeditor');

			/*$Path_CKeditor = base_url('/plugins/ckeditor-integrated/ckeditor');
			$Path_CKfinder = base_url('/plugins/ckeditor-integrated/ckfinder');
			//Ckeditor's configuration
			$this->data['ckeditor'] = array(
				'id'     =>     'editorFull',
				'path'    =>    $Path_CKeditor,
				'config' => array(
					'toolbar'     =>     "Full",
					//'width'     =>     "800px",
					//'height'     =>     '200px',
					'filebrowserBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html',
					'filebrowserImageBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html?type=Images',
					'filebrowserFlashBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html?type=Flash',
					'filebrowserUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Files',
					'filebrowserImageUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Images',
					'filebrowserFlashUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Flash',
				),
			);*/

			//$this->load->view('ckeditor', $data);

		$Path_CKfinder = 'plugins/ckeditor-integrated/ckfinder';
        //Ckeditor's configuration
       $this->data['ckeditor'] = array(

            //ID of the textarea that will be replaced
            'id'     =>     'content',
            'path'    =>    'plugins/ckeditor-integrated/ckeditor',

            //Optionnal values
            'config' => array(
                'toolbar'     =>     "Full",     //Using the Full toolbar
                'width'     =>     "800px",    //Setting a custom width
                'height'     =>     '600px',    //Setting a custom height
					'filebrowserBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html',
					'filebrowserImageBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html?type=Images',
					'filebrowserFlashBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html?type=Flash',
					'filebrowserUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Files',
					'filebrowserImageUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Images',
					'filebrowserFlashUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Flash',

            ),

            //Replacing styles from the "Styles tool"
            /*'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array (
                    'name'         =>     'Blue Title',
                    'element'     =>     'h2',
                    'styles' => array(
                        'color'             =>     'Blue',
                        'font-weight'         =>     'bold'
                    )
                ),

                //Creating a new style named "style 2"
                'style 2' => array (
                    'name'         =>     'Red Title',
                    'element'     =>     'h2',
                    'styles' => array(
                        'color'             =>     'Red',
                        'font-weight'         =>     'bold',
                        'text-decoration'    =>     'underline'
                    )
                )                
            )*/
        );


    }

    public function index() {

			/*$data['ckeditor'] = array(
				//ID of the textarea that will be replaced
				'id'     =>     'content',
				'path'    =>    'theme/assets/ckeditor-upload',
				'config' => array(
					'toolbar'     =>     "Full",     //Using the Full toolbar
					'width'     =>     "800px",    //Setting a custom width
					'height'     =>     '200px',    //Setting a custom height
				),

				'styles' => array(
					'style 1' => array (
						'name'         =>     'Blue Title',
						'element'     =>     'h2',
						'styles' => array(
							'color'             =>     'Blue',
							'font-weight'         =>     'bold'
						)
					),             
				)*/

			$this->load->view('ckeditor', $this->data);

    }
}
?>