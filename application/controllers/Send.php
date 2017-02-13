<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-9-23
 * Time: 下午2:18
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Send extends CI_Controller
{

    function sendSms($mobile, $content,$SpCode='234647',$LoginName='麦当劳2',$Password='m07#d06')
    {
        if( ! $mobile)
            return false;
        if( ! trim($content))
            return false;
        $params=array("SpCode" => $SpCode,
            "LoginName" => iconv("UTF-8", "GB2312//IGNORE",$LoginName),
            "Password" => $Password,
            "MessageContent" => iconv("UTF-8", "GB2312//IGNORE",$content),
            "UserNumber" => $mobile,
            "SerialNumber" => time().rand(1000000000,9999999999),
            "ScheduleTime" => '',
            "ExtendAccessNum" => '',
            "f" => '');
        // var_dump($params);die();
        $data=http_build_query($params);
        //$re=$this->_httpClient($params,'https://api.ums86.com:9600/sms/Api/Send.do');
        $re=$this->http_post('https://api.ums86.com:9600/sms/Api/Send.do?',$data);
        $re=iconv('GB2312', 'UTF-8//IGNORE',$re);
        $resArr = array();
        parse_str($re, $resArr);
        return $resArr;

    }
    private function _httpClient($data,$url) {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $res = curl_exec($ch);
            curl_close($ch);
            return $res;
        } catch (Exception $e) {
            $this->errorMsg = $e->getMessage();
            return false;
        }
    }
    private function http_post($url,$param,$post_file=false){
        $oCurl = curl_init();
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (is_string($param) || $post_file) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach($param as $key=>$val){
                $aPOST[] = $key."=".urlencode($val);
            }
            $strPOST =  join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($oCurl, CURLOPT_POST,true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200){
            return $sContent;
        }else{
            return false;
        }
    }
    public function aa(){
        $a=$this->sendSms('18889870203','你好');
        var_dump($a);
    }

}