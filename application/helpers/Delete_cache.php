<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('delete_cache'))
{
    function delete_cache($uri_string)
    {
        $CI =& get_instance();
        $path = $CI->config->item('cache_path');
        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

        $uri =  $CI->config->item('base_url').
            $CI->config->item('index_page').
            $uri_string;

        $cache_path .= md5($uri);

        if (file_exists($cache_path))
        {
            return unlink($cache_path);
        }
        else
        {
            return TRUE;
        }
    }
}