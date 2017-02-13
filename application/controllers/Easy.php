<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-10-17
 * Time: 上午10:02
 */
require_once  'Common.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class Easy extends  Common
{   public function index(){
    $token=new AccessToken(appID,appsecret);
    $t=$token->getToken();
    print_r($t);

}

}