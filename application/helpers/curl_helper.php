<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    function get_page($url)
    {
        $login = curl_init();
        curl_setopt($login, CURLOPT_URL, $url);
        curl_setopt($login, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0');
        curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($login, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($login, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($login, CURLOPT_TIMEOUT, 40000);
        $html = curl_exec ($login);
        sleep(rand(5,7));
        if($html=== false)
        {
            echo 'Curl error: ' . curl_error($login);
        }
        return $html;
    }
    function get_subhtml($org_string, $start_string, $end_string, $add, $sub)
    {
        $index=strpos($org_string, $start_string);
        $to_ret=substr($org_string, $index+$add);
        $index=strpos($to_ret, $end_string);
        $to_ret=substr($to_ret, 0, $index-$sub);
        return $to_ret;
    }
    function get_html_after($org_string, $sub_string, $add)
    {
        $index=strpos($org_string, $sub_string);
        $to_ret=substr($org_string, $index+$add);
        return $to_ret;
    }
    function get_html_before($org_string, $sub_string, $sub)
    {
        $index=strpos($org_string, $sub_string);
        $to_ret=substr($org_string, 0, $index-$sub);
        return $to_ret;
    }
?>