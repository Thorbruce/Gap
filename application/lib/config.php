<?php
/**
 * Created by PhpStorm.
 * User: etocrm
 * Date: 2015/10/19
 * Time: 9:58
 */
//ini_set("display_errors", "On");
const DOMAIN = 'http://mcd-26th-test.woaap.com';

const DB_HOST = '10.10.96.10';
const DB_NAME = '26th';
const DB_USER = 'etoappconnector';
const DB_PWD = 'fgmn88.1706';

const T_ORDER = 'order';
const T_INFO = 'info';

const APP_ID = 'wx4ed9e1f4e0f3eeb0';
const APP_KEY = 'test';
const MCH_ID = '1216499501';
const MCH_KEY = 'maidanglao2015weixinshoujizhifu9';

const WOAAP_API_URL = 'http://woaapapi.etocrm.com';

const PRICE = 1;
const P_NUM_MAX = 5;

session_start();

function check_openid()
{
    if(isset($_GET['openid_test'])) {
        return $_SESSION['openid'] = $_GET['openid_test'];
    }

    if(isset($_SESSION['openid']))
        return $_SESSION['openid'];

    require_once 'wechat.class.php';
    $wechat = new Wechat();
    if(!$userInfo = $wechat->getOauthAccessToken()) {
        header("Location:" . $wechat->getOauthRedirect(DOMAIN, 'mcd', 'snsapi_base'));
        exit;
    }

    return $_SESSION['openid'] = $userInfo['openid'];
}

