<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Session Class
 *
 * @package		MY_Session
 * @subpackage	Libraries
 * @category	Sessions
 * @author		Piers Karsenbarg
 * @link		https://github.com/killgt/codeigniter-session-memcached
 */
class MY_Session extends CI_Session {
   
    var $sess_encrypt_cookie = FALSE;
    var $sess_use_database = FALSE;
    var $sess_table_name = '';
    var $sess_expiration = 7200;
    var $sess_expire_on_close = FALSE;
    var $sess_match_ip = FALSE;
    var $sess_match_useragent = TRUE;
    var $sess_cookie_name = 'ci_session';
    var $cookie_prefix = '';
    var $cookie_path = '';
    var $cookie_domain = '';
    var $cookie_secure = FALSE;
    var $sess_time_to_update = 10;
    var $encryption_key = '';
    var $flashdata_key = 'flash';
    var $time_reference = 'time';
    var $gc_probability = 5;
    var $userdata = array();
    var $CI;
    var $now;
    var $session_storage = 'cookie';
    var $memcached_port = '';
    var $memcached_nodes = array();
    var $memcache;

    /**
     * Session Constructor
     *
     * The constructor runs the session routines automatically
     * whenever the class is instantiated.
     */
    public function __construct($params = array()) {
    	
        log_message('debug', "Session Class Initialized foo");

        // Set the super object to a local variable for use throughout the class
        $this->CI = & get_instance();
        $this->CI->load->config('memcached');

        // Set all the session preferences, which can either be set
        // manually via the $params array above or via the config file
        foreach (array('sess_encrypt_cookie', 'sess_use_database', 'sess_table_name', 'sess_expiration', 'sess_expire_on_close', 'sess_match_ip', 'sess_match_useragent', 'sess_cookie_name', 'cookie_path', 'cookie_domain', 'cookie_secure', 'sess_time_to_update', 'time_reference', 'cookie_prefix', 'encryption_key', 'session_storage', 'memcached_nodes', 'memcached_port') as $key) {
            $this->$key = (isset($params[$key])) ? $params[$key] : $this->CI->config->item($key);
        }

        if ($this->encryption_key == '') {
            show_error('In order to use the Session class you are required to set an encryption key in your config file.');
        }

        // Load the string helper so we can use the strip_slashes() function
        $this->CI->load->helper('string');

        // Do we need encryption? If so, load the encryption class
        if ($this->sess_encrypt_cookie == TRUE) {
            $this->CI->load->library('encrypt');
        }

        // Check what storage we're going to use for sessions
        switch ($this->session_storage) {
            case 'database':
                // Are we using a database?  If so, load it
                if ($this->sess_table_name != '') {
                    $this->CI->load->database();
                }
                break;
            case 'memcached':
                $this->memcached = new Memcache();
                foreach ($this->memcached_nodes as $node) {
                    $this->memcached->addServer($node, $this->memcached_port);
                }
                log_message('debug', 'memcache servers added');
                break;
            case 'cookie':

                break;
            default:

                break;
        }



        // Set the "now" time.  Can either be GMT or server time, based on the
        // config prefs.  We use this to set the "last activity" time
        $this->now = $this->_get_time();

        // Set the session length. If the session expiration is
        // set to zero we'll set the expiration two years from now.
        if ($this->sess_expiration == 0) {
            $this->sess_expiration = (60 * 60 * 24 * 365 * 2);
            // Memcache server uses unix Time when TTL is above 2592000 (1 month)
            if ($this->session_storage == 'memcached')
                $this->sess_expiration += time();
        }

        // Set the cookie name
        $this->sess_cookie_name = $this->cookie_prefix . $this->sess_cookie_name;

        // Run the Session routine. If a session doesn't exist we'll
        // create a new one.  If it does, we'll update it.
        if (!$this->sess_read()) {
            log_message('info','need to create session');
            $this->sess_create();
        } else {
            log_message('info','do we need to update session');
            $this->sess_update();
        }

        // Delete 'old' flashdata (from last request)
        $this->_flashdata_sweep();

        // Mark all new flashdata as old (data will be deleted before next request)
        $this->_flashdata_mark();

        // Delete expired sessions if necessary
        $this->_sess_gc();

        log_message('debug', "Session routines successfully run");
    }

    // --------------------------------------------------------------------

    /**
     * Get the "now" time
     *
     * @access	private
     * @return	string
     */
    function _get_time() {
        if (strtolower($this->time_reference) == 'gmt') {
            $now = time();
            $time = mktime(gmdate("H", $now), gmdate("i", $now), gmdate("s", $now), gmdate("m", $now), gmdate("d", $now), gmdate("Y", $now));
        } else {
            $time = time();
        }

        return $time;
    }

    // --------------------------------------------------------------------

    /**
     * Fetch the current session data if it exists
     *
     * @access	public
     * @return	bool
     */
    function sess_read() {
        // Fetch the cookie
        
        $session = $this->CI->input->cookie($this->sess_cookie_name);
        // No cookie?  Goodbye cruel world!...
        if ($session === FALSE) {
            log_message('debug', 'A session cookie was not found.');
            return FALSE;
        }

        // Decrypt the cookie data
        if ($this->sess_encrypt_cookie == TRUE) {
            $session = $this->CI->encrypt->decode($session);
        } else {
            // encryption was not used, so we need to check the md5 hash
            $hash = substr($session, strlen($session) - 32); // get last 32 chars
            $session = substr($session, 0, strlen($session) - 32);

            // Does the md5 hash match?  This is to prevent manipulation of session data in userspace
            if ($hash !== md5($session . $this->encryption_key)) {
                log_message('error', 'The session cookie data did not match what was expected. This could be a possible hacking attempt.');
                $this->sess_destroy();
                return FALSE;
            }
        }

        // Unserialize the session array
        $session = $this->_unserialize($session);

        // Is the session data we unserialized an array with the correct format?
        if (!is_array($session) OR !isset($session['session_id']) OR !isset($session['ip_address']) OR !isset($session['user_agent']) OR !isset($session['last_activity'])) {
            $this->sess_destroy();
            return FALSE;
        }

        // Is the session current?
        if (($session['last_activity'] + $this->sess_expiration) < $this->now) {
            $this->sess_destroy();
            return FALSE;
        }

        // Does the IP Match?
        if ($this->sess_match_ip == TRUE AND $session['ip_address'] != $this->CI->input->ip_address()) {
            $this->sess_destroy();
            return FALSE;
        }

        // Does the User Agent Match?
        if ($this->sess_match_useragent == TRUE AND trim($session['user_agent']) != trim(substr($this->CI->input->user_agent(), 0, 50))) {
            $this->sess_destroy();
            return FALSE;
        }

        // Is there a corresponding session in memcached?
        if ($this->session_storage === 'memcached') {
            $result = $this->memcached->get("user_session_data" . $session['session_id']);
            		//log_message('debug', 'MC ' .serialize($result));

            if ($result === FALSE) {
                $this->sess_destroy();
                log_message('debug', 'Session not found');
                return FALSE;
            }

            // Check for custom user data
            if (isset($result["user_data"]) && $result["user_data"] != '') {
                $custom_data = $this->_unserialize($result["user_data"]);
                if (is_array($custom_data)) {
                    log_message('debug', 'Memcached custom data found');
                    foreach ($custom_data as $key => $val) {
                        $session[$key] = $val;
                    }
                }
            }
        }

        // Is there a corresponding session in the DB?
        if ($this->session_storage === 'database') {
            $this->CI->db->where('session_id', $session['session_id']);

            if ($this->sess_match_ip == TRUE) {
                $this->CI->db->where('ip_address', $session['ip_address']);
            }

            if ($this->sess_match_useragent == TRUE) {
                $this->CI->db->where('user_agent', $session['user_agent']);
            }

            $query = $this->CI->db->get($this->sess_table_name);

            // No result?  Kill it!
            if ($query->num_rows() == 0) {
                $this->sess_destroy();
                return FALSE;
            }

            // Is there custom data?  If so, add it to the main session array
            $row = $query->row();
            if (isset($row->user_data) AND $row->user_data != '') {
                $custom_data = $this->_unserialize($row->user_data);

                if (is_array($custom_data)) {
                    foreach ($custom_data as $key => $val) {
                        $session[$key] = $val;
                    }
                }
            }
        }

        // Session is valid!
        $this->userdata = $session;
        unset($session);

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Destroy the current session
     *
     * @access	public
     * @return	void
     */
    function sess_destroy() {

        switch ($this->session_storage) {
            case 'database':
                // Kill the session DB row
                if (isset($this->userdata['session_id'])) {
                    $this->CI->db->where('session_id', $this->userdata['session_id']);
                    $this->CI->db->delete($this->sess_table_name);
                }
                break;
            case 'memcached':
                // Delete item from memcache
                if (isset($this->userdata['session_id'])) {
                    $this->memcached->delete('user_session_data' . $this->userdata['session_id']);
                    log_message('debug', 'session destroyed');
                }

                break;
        }

        // Kill the cookie
        setcookie(
                $this->sess_cookie_name, addslashes(serialize(array())), ($this->now - 31500000), $this->cookie_path, $this->cookie_domain, 0
        );
    }

    // --------------------------------------------------------------------

    /**
     * Unserialize
     *
     * This function unserializes a data string, then converts any
     * temporary slash markers back to actual slashes
     *
     * @access	private
     * @param	array
     * @return	string
     */
    function _unserialize($data) {
        $data = @unserialize(strip_slashes($data));

        if (is_array($data)) {
            foreach ($data as $key => $val) {
                if (is_string($val)) {
                    $data[$key] = str_replace('{{slash}}', '\\', $val);
                }
            }

            return $data;
        }

        return (is_string($data)) ? str_replace('{{slash}}', '\\', $data) : $data;
    }

    // --------------------------------------------------------------------

    /**
     * Create a new session
     *
     * @access	public
     * @return	void
     */
    function sess_create() {
        $sessid = '';
        while (strlen($sessid) < 32) {
            $sessid .= mt_rand(0, mt_getrandmax());
        }

        // To make the session ID even more secure we'll combine it with the user's IP
        $sessid .= $this->CI->input->ip_address();

        $this->userdata = array(
            'session_id' => md5(uniqid($sessid, TRUE)),
            'ip_address' => $this->CI->input->ip_address(),
            'user_agent' => substr($this->CI->input->user_agent(), 0, 50),
            'last_activity' => $this->now
        );

        // Check to see if either using memcached or DB and save if necessary


        switch ($this->session_storage) {
            case 'database':
                $this->CI->db->query($this->CI->db->insert_string($this->sess_table_name, $this->userdata));
                break;
            case 'memcached':
                $this->memcached->set('user_session_data' . $this->userdata['session_id'], $this->userdata, $this->sess_expiration);
                log_message('debug', 'session created in memcached');
                break;
            default:
                break;
        }

        // Write the cookie
        $this->_set_cookie();
    }

    // --------------------------------------------------------------------

    /**
     * Write the session cookie
     *
     * @access	public
     * @return	void
     */
    function _set_cookie($cookie_data = NULL) {
    	//log_message('debug', 'MC name' .  $this->sess_cookie_name);
        if (is_null($cookie_data)) {
            $cookie_data = $this->userdata;
        }

        // Serialize the userdata for the cookie
        $cookie_data = $this->_serialize($cookie_data);

        if ($this->sess_encrypt_cookie == TRUE) {
            $cookie_data = $this->CI->encrypt->encode($cookie_data);
        } else {
            // if encryption is not used, we provide an md5 hash to prevent userside tampering
            $cookie_data = $cookie_data . md5($cookie_data . $this->encryption_key);
        }

        $expire = ($this->sess_expire_on_close === TRUE) ? 0 : $this->sess_expiration + time();

        // Set the cookie
        setcookie(
                $this->sess_cookie_name, $cookie_data, $expire, $this->cookie_path, $this->cookie_domain, $this->cookie_secure
        );
    }

    // --------------------------------------------------------------------

    /**
     * Serialize an array
     *
     * This function first converts any slashes found in the array to a temporary
     * marker, so when it gets unserialized the slashes will be preserved
     *
     * @access	private
     * @param	array
     * @return	string
     */
    function _serialize($data) {
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                if (is_string($val)) {
                    $data[$key] = str_replace('\\', '{{slash}}', $val);
                }
            }
        } else {
            if (is_string($data)) {
                $data = str_replace('\\', '{{slash}}', $data);
            }
        }

        return serialize($data);
    }

    // --------------------------------------------------------------------

    /**
     * Update an existing session
     *
     * @access	public
     * @return	void
     */
    function sess_update() {
        // We only update the session every five minutes by default
        if (($this->userdata['last_activity'] + $this->sess_time_to_update) >= $this->now) {
            log_message('info','not enough time before update');
            return;
        }
        log_message('info','MC defo need to update session');
        
        // Save the old session id so we know which record to
        // update in the database if we need it
        $old_sessid = $this->userdata['session_id'];
        $new_sessid = '';
        while (strlen($new_sessid) < 32) {
            $new_sessid .= mt_rand(0, mt_getrandmax());
        }
        
        // To make the session ID even more secure we'll combine it with the user's IP
        $new_sessid .= $this->CI->input->ip_address();

        // Turn it into a hash
        $new_sessid = md5(uniqid($new_sessid, TRUE));
        log_message('info','session id generated');
        // Update the session data in the session data array
        $this->userdata['session_id'] = $new_sessid;
        $this->userdata['last_activity'] = $this->now;

        // _set_cookie() will handle this for us if we aren't using database sessions
        // by pushing all userdata to the cookie.
        $cookie_data = NULL;

        $cookie_data = array();
        $mem_data = array();
        $cookie_keys = array('session_id', 'ip_address', 'user_agent', 'last_activity');
        foreach ($cookie_keys as $key) {
            $cookie_data[$key] = $this->userdata[$key];
        }
        foreach ($this->userdata as $key => $value) {
            if (in_array($key, $cookie_keys))
                continue;
            $mem_data[$key] = $this->userdata[$key];
        }
        $save  = array(
            'session_id' => $cookie_data['session_id'],
            'ip_address' => $cookie_data['ip_address'],
            'user_agent' => $cookie_data['user_agent'],
            'last_activity' => $this->now,
            'user_data' => $this->_serialize($mem_data)
        );
        
        switch ($this->session_storage) {
            case 'database':
                // Update the session ID and last_activity field in the DB if needed
                // set cookie explicitly to only have our session data
                $this->CI->db->query($this->CI->db->update_string($this->sess_table_name, array('last_activity' => $this->now, 'session_id' => $new_sessid), array('session_id' => $old_sessid)));
                break;
            case 'memcached':                
                // Add item with new session_id and data to memcached
                // then delete old memcache item
                $this->memcached->set('user_session_data' . $new_sessid, $save, $this->sess_expiration);
                log_message('info', 'MC new session added' . $this->sess_expiration);
                $this->memcached->delete('user_session_data' . $old_sessid);
                log_message('info', 'MC old session deleted');

                break;
        }

        unset($mem_data);

        // Write the cookie
        $this->_set_cookie($cookie_data);
    }

    // --------------------------------------------------------------------

    /**
     * Removes all flashdata marked as 'old'
     *
     * @access	private
     * @return	void
     */
    function _flashdata_sweep() {
        $userdata = $this->all_userdata();
        foreach ($userdata as $key => $value) {
            if (strpos($key, ':old:')) {
                $this->unset_userdata($key);
            }
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Fetch all session data
     *
     * @access	public
     * @return	mixed
     */
    function all_userdata() {
        return (!isset($this->userdata)) ? FALSE : $this->userdata;
    }

    // ------------------------------------------------------------------------

    /**
     * Delete a session variable from the "userdata" array
     *
     * @access	array
     * @return	void
     */
    function unset_userdata($newdata = array()) {
        if (is_string($newdata)) {
            $newdata = array($newdata => '');
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                unset($this->userdata[$key]);
            }
        }

        $this->sess_write();
    }

    // ------------------------------------------------------------------------

    /**
     * Write the session data
     *
     * @access	public
     * @return	void
     */
    function sess_write() {

        // Are we saving custom data to the DB?  If not, all we do is update the cookie
        if ($this->session_storage === 'cookie') {
            $this->_set_cookie();
            return;
        }


        // set the custom userdata, the session data we will set in a second
        $custom_userdata = $this->userdata;
        $cookie_userdata = array();

        // Before continuing, we need to determine if there is any custom data to deal with.
        // Let's determine this by removing the default indexes to see if there's anything left in the array
        // and set the session data while we're at it
        foreach (array('session_id', 'ip_address', 'user_agent', 'last_activity') as $val) {
            unset($custom_userdata[$val]);
            $cookie_userdata[$val] = $this->userdata[$val];
        }

        // Did we find any custom data?  If not, we turn the empty array into a string
        // since there's no reason to serialize and store an empty array in the DB
        if (count($custom_userdata) === 0) {
            $custom_userdata = '';
        } else {
            // Serialize the custom data array so we can store it
            $custom_userdata = $this->_serialize($custom_userdata);
        }

        // check if we're using memcached or database

        switch ($this->session_storage) {
            case 'database':
                // Run the update query
                $this->CI->db->where('session_id', $this->userdata['session_id']);
                $this->CI->db->update($this->sess_table_name, array('last_activity' => $this->userdata['last_activity'], 'user_data' => $custom_userdata));
                break;
            case 'memcached':
                $this->memcached->replace("user_session_data" . $this->userdata['session_id'], array('last_activity' => $this->userdata['last_activity'], 'user_data' => $custom_userdata), $this->sess_expiration + 3600);
                log_message('debug', 'session written to memcache');
                break;
        }

        // Write the cookie.  Notice that we manually pass the cookie data array to the
        // _set_cookie() function. Normally that function will store $this->userdata, but
        // in this case that array contains custom data, which we do not want in the cookie.
        $this->_set_cookie($cookie_userdata);
    }

    // ------------------------------------------------------------------------

    /**
     * Identifies flashdata as 'old' for removal
     * when _flashdata_sweep() runs.
     *
     * @access	private
     * @return	void
     */
    function _flashdata_mark() {
        $userdata = $this->all_userdata();
        foreach ($userdata as $name => $value) {
            $parts = explode(':new:', $name);
            if (is_array($parts) && count($parts) === 2) {
                $new_name = $this->flashdata_key . ':old:' . $parts[1];
                $this->set_userdata($new_name, $value);
                $this->unset_userdata($name);
            }
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Add or change data in the "userdata" array
     *
     * @access	public
     * @param	mixed
     * @param	string
     * @return	void
     */
    function set_userdata($newdata = array(), $newval = '') {
        if (is_string($newdata)) {
            $newdata = array($newdata => $newval);
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                $this->userdata[$key] = $val;
            }
        }

        $this->sess_write();
    }

    // --------------------------------------------------------------------

    /**
     * Garbage collection
     *
     * This deletes expired session rows from database
     * if the probability percentage is met
     *
     * @access	public
     * @return	void
     */
    function _sess_gc() {
        if ($this->sess_use_database != TRUE) {
            return;
        }

        srand(time());
        if ((rand() % 100) < $this->gc_probability) {
            $expire = $this->now - $this->sess_expiration;
            switch ($this->session_storage) {
                // Only have database here as memcached will remove the
                // item automatically
                case 'database':
                    $this->CI->db->where("last_activity < {$expire}");
                    $this->CI->db->delete($this->sess_table_name);
                    break;
            }

            log_message('debug', 'Session garbage collection performed.');
        }
    }

    // --------------------------------------------------------------------

    /**
     * Add or change flashdata, only available
     * until the next request
     *
     * @access	public
     * @param	mixed
     * @param	string
     * @return	void
     */
    function set_flashdata($newdata = array(), $newval = '') {
        if (is_string($newdata)) {
            $newdata = array($newdata => $newval);
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                $flashdata_key = $this->flashdata_key . ':new:' . $key;
                $this->set_userdata($flashdata_key, $val);
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Keeps existing flashdata available to next request.
     *
     * @access	public
     * @param	string
     * @return	void
     */
    function keep_flashdata($key) {
        // 'old' flashdata gets removed.  Here we mark all
        // flashdata as 'new' to preserve it from _flashdata_sweep()
        // Note the function will return FALSE if the $key
        // provided cannot be found
        $old_flashdata_key = $this->flashdata_key . ':old:' . $key;
        $value = $this->userdata($old_flashdata_key);

        $new_flashdata_key = $this->flashdata_key . ':new:' . $key;
        $this->set_userdata($new_flashdata_key, $value);
    }

    // --------------------------------------------------------------------

    /**
     * Fetch a specific item from the session array
     *
     * @access	public
     * @param	string
     * @return	string
     */
    function userdata($item) {
        return (!isset($this->userdata[$item])) ? FALSE : $this->userdata[$item];
    }

    // --------------------------------------------------------------------

    /**
     * Fetch a specific flashdata item from the session array
     *
     * @access	public
     * @param	string
     * @return	string
     */
    function flashdata($key) {
        $flashdata_key = $this->flashdata_key . ':old:' . $key;
        return $this->userdata($flashdata_key);
    }

}

// END MY_Session Class

/* End of file MY_Session.php */
/* Location: ./application/libraries/MY_Session.php */