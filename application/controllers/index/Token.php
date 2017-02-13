<?php
/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-9-9
 * Time: 下午1:41
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Token extends CI_Controller {
    const appID     ='wx7202110492a52628';
    const appsecret ='86dc06b4ba023f69d1d8af1078015949';
    const url       ='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=';

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
                    curl_setopt( $ci, CURLOPT_POSTFIELDS, $postfields );
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


    public function get_access_token(){
        $access_token = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".self::appID . "&secret=" . self::appsecret);
        $TOKEN=json_decode($access_token,true);
        return $TOKEN['access_token'];
    }
    //通过access_token生成二维码
    public function get_code(){
        $TOKEN=$this->get_access_token();
        $data=array('action_name'=>'QR_LIMIT_SCENE','action_info'=>array('scene'=>array('scene_id'=>'123')));
        $code_info=$this->http(self::url.$TOKEN,json_encode($data),'POST');

        $code=json_decode($code_info,true);
        $code=file_get_contents('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($code['ticket']));
        file_put_contents('test6.jpg', $code);
    }
    //获取微信服务器ip地址
    public function get_ip(){
        $TOKEN=$this->get_access_token();
        $ips=file_get_contents('https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token='.$TOKEN);
        $ip=json_decode($ips,true);
        var_dump($ip);
    }
    //长url转短url
    public function get_short_url(){
        $access_token=$this->get_access_token();
        $data=array('access_token ' =>$access_token,
                    'action'        =>'long2short',
                    'long_url'      =>'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx7202110492a52628&redirect_uri=http%3A%2F%2Fwww.hxlrmars.cn%3A8081%2FScope%2Findex&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
        $response=$this->http("https://api.weixin.qq.com/cgi-bin/shorturl?access_token=$access_token",json_encode($data),'POST');
        //var_dump(json_decode($response,true));
        echo $response;
    }
    //菜单事件
    public function menu_action(){
        $access_token=$this->get_access_token();
        $data=array('button'=>array(array('type'=>'click',
                                          'name'=>'hh',
                                          'key'=>'hhe'),
                                    array('name'=>'菜单',
                                           'sub_button'=>array(array(  'type'=>'view',
                                                                       'name'=>'百度',
                                                                       'url'=>'www.soso.com'),
                                                               array(   'type'=>'view',
                                                                        'name'=>'视频',
                                                                        'url'=>'ttp://v.qq.com/' ),
                                                               array(   'type'=>'click',
                                                                        'name'=>'赞',
                                                                        'url'=>'ttp://v.qq.com/'))
                                    )));
       $data=json_encode($data,JSON_UNESCAPED_UNICODE);
       $data=urldecode($data);
       $response=$this->http("https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token",$data,'POST');
       echo $response;
  }
  //创建分组
    public function create_group(){
        $access_token=$this->get_access_token();
        $data=array('group'=>array('name'=>'xiaozeng'));
        $data=json_encode($data);
        //echo $data;die;
        $url='https://api.weixin.qq.com/cgi-bin/groups/create?access_token='.$access_token;
        $response=$this->http($url,$data);
        echo $response;
    }
    public function get_all_group(){
        $access_token=$this->get_access_token();
        //echo $access_token;die();
        $result=file_get_contents('https://api.weixin.qq.com/cgi-bin/groups/get?access_token='.$access_token);
        echo $result;
    }
    public function aa(){
        echo phpinfo();
    }
}