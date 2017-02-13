<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-9-27
 * Time: 上午9:31
 * 这是一个公共的控制器，继承CI_Controller
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Common extends CI_Controller
{
    //获取access_toke
    public function get_access_token(){
        $appID=appID;
        $appsecret=appsecret;
        $access_token = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appID&secret=$appsecret");
        $TOKEN=json_decode($access_token,true);
        return  $TOKEN['access_token'];
    }
    //curl请求
    function http($url, $postfields, $method = 'POST', array $headers = array()){
        $ci = curl_init();
        /* Curl settings */
        curl_setopt( $ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
        curl_setopt( $ci, CURLOPT_CONNECTTIMEOUT, 30 );
        curl_setopt( $ci, CURLOPT_TIMEOUT, 30 );
        curl_setopt( $ci, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ci, CURLOPT_ENCODING, 'gzip' );
        curl_setopt( $ci, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $ci, CURLOPT_MAXREDIRS, 5 );
        curl_setopt( $ci, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ci, CURLOPT_HEADER, false );

        switch( strtoupper( $method ) )
        {
            case 'POST':
                curl_setopt( $ci, CURLOPT_POST, true );
                if ( !empty( $postfields ) )
                {
                    if(is_array($postfields)){
                        curl_setopt($ci, CURLOPT_POSTFIELDS, http_build_query($postfields));
                    }else {
                        curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                    }
                }
                break;
            case 'DELETE':
                curl_setopt( $ci, CURLOPT_CUSTOMREQUEST, 'DELETE' );
                if ( !empty( $postfields ) )
                {
                    $url = "{$url}?" . http_build_query( $postfields );
                }
                break;
            case 'GET':
                if ( !empty( $postfields ) )
                {
                    $url = "{$url}?" . http_build_query( $postfields );
                }
                break;
        }

        curl_setopt($ci, CURLOPT_URL, $url );
        curl_setopt($ci, CURLOPT_HTTPHEADER, $headers );
        curl_setopt($ci, CURLINFO_HEADER_OUT, true );

        $response = curl_exec( $ci );
        curl_close ($ci);
        return $response;
    }
}