<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once SYSDIR . '/libraries/Driver.php';
require_once SYSDIR . '/libraries/Session/Session.php';

/*
    Change the following if you want to use a different driver.
*/
require_once SYSDIR . '/libraries/Session/drivers/Session_cookie.php';

class MY_Session extends CI_Session_cookie
{

    function __construct()
    {
        parent::__construct();
    }

    protected function _sess_update($force = false)
    {
        // Do NOT update an existing session on AJAX calls.
        if ($force || !$this->CI->input->is_ajax_request())
            return parent::_sess_update($force);
    }

}

/* End of file MY_Session.php */
/* Location: ./application/libraries/MY_Session.php */