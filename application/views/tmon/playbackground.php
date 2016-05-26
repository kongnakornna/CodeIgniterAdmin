<?php
// * * * * * wget -O /dev/null http://www.example.com/spooler.php 
function get_web_page( $url )
{
    $options = array(
    CURLOPT_RETURNTRANSFER => true,     // return web page
    CURLOPT_HEADER         => false,    // don't return headers
    CURLOPT_FOLLOWLOCATION => true,     // follow redirects
    CURLOPT_ENCODING       => "",       // handle compressed
    CURLOPT_USERAGENT      => "tmon", // who am i
    CURLOPT_AUTOREFERER    => true,     // set referer on redirect
    CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
    CURLOPT_TIMEOUT        => 120,      // timeout on response
    CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}
?>


<?php
function curl_post_async($url, $params)
{
    $post_string = http_build_query($params);
    $parts=parse_url($url);

    $fp = fsockopen($parts['host'],
        isset($parts['port'])?$parts['port']:80,
        $errno, $errstr, 30);

    if(!$fp)
    {
        //Perform whatever logging you want to have happen b/c this call failed!    
    }
    $out = "POST ".$parts['path']." HTTP/1.1\r\n";
    $out.= "Host: ".$parts['host']."\r\n";
    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out.= "Content-Length: ".strlen($post_string)."\r\n";
    $out.= "Connection: Close\r\n\r\n";
    if (isset($post_string)) $out.= $post_string;

    fwrite($fp, $out);
    fclose($fp);
}
?>

<!---



I ended up using this method: http://w-shadow.com/blog/2007/10/16/how-to-run-a-php-script-in-the-background/

function backgroundPost($url){
    $parts=parse_url($url);
    $fp = fsockopen($parts['host'], 
        isset($parts['port'])?$parts['port']:80, 
        $errno, $errstr, 30);
    if (!$fp) {
        return false;
    } else {
        $out = "POST ".$parts['path']." HTTP/1.1\r\n";
        $out.= "Host: ".$parts['host']."\r\n";
        $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out.= "Content-Length: ".strlen($parts['query'])."\r\n";
        $out.= "Connection: Close\r\n\r\n";
        if (isset($parts['query'])) $out.= $parts['query'];
        fwrite($fp, $out);
        fclose($fp);
        return true;
    }
}

//Example of use
backgroundPost('http://example.com/slow.php?file='.urlencode('some file.dat'));

Rachael, thanks for the help.

--->