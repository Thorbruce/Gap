<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-9-27
 * Time: 下午2:58
 * 这是一个关于客服的控制器
 */
require_once  'Common.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class Kefu extends Common
{   const Kflist='https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=';

    //获取客服列表
    public function getkflist(){
        $token=$this->get_access_token();
        $list=file_get_contents(self::Kflist.$token);
        echo $list;
    }
    //添加客服
    public function addKf(){
        $data=['kf_account'=>'zeng@gh_221723d934dc',
                'nickname'=>'zeng2',
                'password'=>md5('123456')];
        $token=$this->get_access_token();
        $result=$this->http('https://api.weixin.qq.com/customservice/kfaccount/add?access_token='.$token,json_encode($data));
        echo $result;
    }
}