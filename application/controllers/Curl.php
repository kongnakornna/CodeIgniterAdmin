<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curl extends CI_Controller {
	 public function __construct() {
        parent::__construct();
        }
    
        public function index(){
        $this->load->library('curl');
        $this->curl->create('https://www.formget.com/');
        $this->curl->option('buffersize', 10); 
        $this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');      
        $this->curl->option('returntransfer', 1);
        $this->curl->option('followlocation', 1);
        $this->curl->option('HEADER', true);
        $this->curl->option('connecttimeout', 600);
        $this->curl->option('SSL_VERIFYPEER', false); // for ssl
        $this->curl->option('SSL_VERIFYHOST', false);
        $this->curl->option('SSLVERSION', 3);        // end ssl
        $data = $this->curl->execute();
  
        echo $data; 
        
        }
}
?>

