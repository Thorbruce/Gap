<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-9-28
 * Time: 上午9:36
 */
require_once 'Common.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class Message extends Common
{
    const PUSH='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=';
    public function push(){
        $token=$this->get_access_token();
        $openid='o3HPgvtuETUwXTNMCfG8SsLF9LRA';
        $template_id='1ZtZKr-LUXJOGhEx1jIPWo141myLtwvzGrrcpgPn2UU';
        $data=['touser'=>$openid,'template_id'=>$template_id,'url'=>'www.baidu.com','data'=>['key'=>['value'=>'卢总,该起床了','color'=>'red'],'a'=>['value'=>'该起床了','color'=>'red'],'a2'=>['value'=>'该起床了','color'=>'red'],'end'=>['value'=>'重要的事情说三遍','color'=>'red']]];
        $data=json_encode($data);
        $result=$this->http(self::PUSH.$token,$data);
        echo $result;
    }
    //设置所属行业
    public function setTMIndustry(){
        $data=array('industry_id1'=>'1','industry_id2'=>'2');
        $token=$this->get_access_token();
        $data=$this->http('https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token='.$token,json_encode($data));
        echo $data;
    }

    //上传图文
    public function pushImge(){
        $token=$this->get_access_token();
        $data=array('media'=>'@'.base_url().'style/image/1.jpg\r\n'.'https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token='.$token);
        //var_dump($data);die();
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token='.$token,$data);
        echo $result;
    }
    public function getTemple(){
        $result='{	
 "template_list": [{
      "template_id": "iPk5sOIt5X_flOVKn5GrTFpncEYTojx6ddbt8WYoV5s",
      "title": "领取奖金提醒",
      "primary_industry": "IT科技",
      "deputy_industry": "互联网|电子商务",
      "content": "{ {result.DATA} }\n\n领奖金额:{ {withdrawMoney.DATA} }\n领奖  时间:{ {withdrawTime.DATA} }\n银行信息:{ {cardInfo.DATA} }\n到账时间:  { {arrivedTime.DATA} }\n{ {remark.DATA} }",
      "example": "您已提交领奖申请\n\n领奖金额：xxxx元\n领奖时间：2013-10-10 12:22:22\n银行信息：xx银行(尾号xxxx)\n到账时间：预计xxxxxxx\n\n预计将于xxxx到达您的银行卡"
   }]
}';
        $result=json_decode($result,true);
        print_r($result);
        //$this->formatTemmple($result);
        $tpl=$result['template_list']['0']['content'];
        $c=explode('',$tpl);
        print_r($c);
    }


 //获取７天内用户增减数量
    public function get_user(){
        $token=$this->get_access_token();
        $data=["begin_date"=>'2016-9-10',"end_date"=>'2016-9-16'];
        $result=$this->http('https://api.weixin.qq.com/datacube/getusersummary?access_token='.$token,json_encode($data),'POST');
        echo $result;
    }
    //获取７天内获取累计用户数据
    public function getusercumulate(){
        $token=$this->get_access_token();
        $data=["begin_date"=>'2016-9-10',"end_date"=>'2016-9-16'];
        $result=$this->http('https://api.weixin.qq.com/datacube/getusercumulate?access_token='.$token,json_encode($data),'POST');
        echo $result;
    }
    //获取每日图文群发每日数据
    public function getarticlesummary(){
        $token=$this->get_access_token();
        $data=["begin_date"=>'2016-9-17',"end_date"=>'2016-9-17'];
        $result=$this->http('https://api.weixin.qq.com/datacube/getarticlesummary?access_token='.$token,json_encode($data),'POST');
        echo $result;
    }
    Public function getarticletotal(){
        $token=$this->get_access_token();
        $data=["begin_date"=>'2016-9-17',"end_date"=>'2016-9-17'];
        $result=$this->http('https://api.weixin.qq.com/datacube/getarticletotal?access_token='.$token,json_encode($data),'POST');
        echo $result;
    }
    //修改分组别名
    public function editGroupName(){
        $token=$this->get_access_token();
        $data=['group'=>['id'=>'2','name'=>'曾２组']];
        $data=json_encode($data);
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/groups/update?access_token='.$token,$data);
        echo $result;
    }
    //设置用户别名
    public function updateRemark(){
        $token=$this->get_access_token();
        $data=['openid'=>'o3HPgvlGlX6qXBAFhPy_fkFFq-Kw','remark'=>'卢老板'];
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token='.$token,json_encode($data),'POST');
        echo $result;
    }
    //获取用户所有信息
    public function getUserData(){
        $token=$this->get_access_token();
        $result=file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.'o3HPgvtuETUwXTNMCfG8SsLF9LRA'.'&lang=zh_CN');
        print_r(json_decode($result,true));
    }
    //客服接口
    public function kefu(){
        $token=$this->get_access_token();
        echo $token;die;
        $data=['touser'=>'o3HPgvtuETUwXTNMCfG8SsLF9LRA','msgtype'=>'text','text'=>['conetent'=>'sb']];
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$token,json_encode($data),'POST');
        echo $result;
    }
    //菜单
    public function menu(){
        $token=$this->get_access_token();
        $data=['button'=>[
                            ['type'=>'view',
                             'name'=>'我的主页' ,
                             'url'=>'http://www.hxlrmars.cn:8081/getJssdk/home'
                            ],
                            ['name'=>'门户网站',
                                'sub_button'=>[
                                    ['type'=>'view',
                                      'name'=>'网页授权',
                                        'url'=>'http://w.url.cn/s/AXPgl8v'],

                                    ['type'=>'view',
                                        'name'=>'动物世界',
                                        'url'=>'http://www.hxlrmars.cn:8081/GetJssdk/animal'],
                                    ['type'=>'view',
                                        'name'=>'橄榄球',
                                        'url'=>'http://www.hxlrmars.cn:8081/GetJssdk/foot'],
                                    ['type'=>'view',
                                        'name'=>'健身',
                                        'url'=>'http://www.hxlrmars.cn:8081/GetJssdk/jianshen/'],
                                    ['type'=>'view',
                                        'name'=>'后盾网',
                                        'url'=>'http://www.houdunwang.com/'],
                                ]

                            ],
                            ['name'=>'扫码',
                                'sub_button'=>[
                                    ['type'=>'scancode_push',
                                      'name'=>'扫码推事件',
                                       'key'=>'http://www.baidu.com/',
                                        'sub_button'=>[]
                                    ],
                                    [
                                        'type'=>'pic_sysphoto',
                                        'name'=>'系统拍照发图',
                                        'key'=>'http://www.baidu.com/',
                                        'sub_button'=>[]
                                    ],
                                    [
                                        'type'=>'pic_photo_or_album',
                                        'name'=>'拍照或者相册发图',
                                        'key'=>'http://www.baidu.com/',
                                        'sub_button'=>[]
                                    ],
                                    [
                                        'type'=>'location_select',
                                        'name'=>'发送位置',
                                        'key'=>'http://www.baidu.com/',

                                    ]
                                ]

                            ]
        ]];
//
//       防止中文被转义,转义不能成功
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$token,$data,'POST');
        echo $result;
    }
    //查询自定义菜单
    public function get_menu(){
        $token=$this->get_access_token();
        $result=file_get_contents('https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$token);
        echo $result;
    }
    //删除自定义菜单
    public function delete_menu(){
        $token=$this->get_access_token();
        $result=file_get_contents('https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$token);
        echo  $result;
    }
    //永久图片素材上传
    public function upload(){
        $token=$this->get_access_token();
        $path='storage/31.jpg';
        if (class_exists('\CURLFile')) {
            $data = array('media' => new \CURLFile(realpath($path)));
        } else {
            $data = array('media' => '@' . realpath($path));
        }
        //var_dump($data);die;
        $response=$this->http_post('https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$token.'&type=image',$data,true);
//        $result=json_decode($response,true);
//        $this->load->model('media_model','media');
//        $data=['type'=>'image','media_id'=>$result['media_id'],'title'=>'新增永久素材','create_at'=>date('Y-m-d H:i:s',time())];
//        $a=$this->media->add($data);
        echo $response;

    }
    //临时图片素材上传
    public function uploadImage(){
        $token=$this->get_access_token();
        $path='31.jpg';
        if (class_exists('\CURLFile')) {
            $data = array('media' => new \CURLFile(realpath($path)));
        } else {
            $data = array('media' => '@' . realpath($path));
        }
        $data['type']='image';
        $response=$this->http_post('https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$token.'&type=image',$data,true);
        $result=json_decode($response,true);
        $this->load->model('media_model','media');
        $data=['type'=>$result['type'],'media_id'=>$result['media_id'],'title'=>'新增临时素材','create_at'=>date('Y-m-d H:i:s',$result['created_at'])];
        $a=$this->media->add($data);
        echo $response;
    }

    public function getMedia(){
        $token=$this->get_access_token();
        $media_id='fu-UwX0U67MthQXzxhd2ElGitsO5X4hjGob17zwb50BaR6dJINgye-m7PMnOq1BS';
        $data=file_get_contents('https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$token.'&media_id='.$media_id);
        file_put_contents('test7.jpg', $data);
    }
    //新增永久图文素材
    public function addNews(){

        $token=$this->get_access_token();
        //注意一点，就是articles指向的必须还得加个数组，不然会报errcode":44003,"errmsg":"empty news data
        $data=['articles'=>[['title'             =>'2B的世界你永远不懂',
                            'thumb_media_id'    =>'KBi9i91fi0Kpb4O4qZEiQHb9u0B0-D9hd3-8EmZID4Z0USlyVoFuAUtmyw2WGoe7',//这里的thumb_media_id靠的是上传临时图片素材的接口
                            'author'            =>'bruce.zeng',
                            'digest'            =>'呵呵',
                            'show_cover_pic'    =>'1',
                            'content'           =>'aaaasasahsii是哈哈哈好看好看啥客户刷卡号考试考核好看啥客户',
                            'content_source_url'=>'http://xuan.3g.cn/?fr=sm1/'],
                            ['title'             =>'带你装逼带你飞',
                                'thumb_media_id'    =>'G-TYW814z-0uuP0Tpv9OPmrWZ6Ts9bdVYOQqLHrU0jmenxJF9wUCoGdjMLvBRAkz',
                                'author'            =>'bruce.zeng',
                                'digest'            =>'呵呵',
                                'show_cover_pic'    =>'1',
                                'content'           =>'fuck　you men',
                                'content_source_url' =>'http://xuan.3g.cn/?fr=sm1/']
        ]];
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        $response=$this->http('https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token='.$token,$data);
        $result=json_decode($response,true);
        $this->load->model('media_model','media');
        $data=['type'=>$result['type'],'media_id'=>$result['media_id'],'title'=>'新增永久图文素材','create_at'=>date('Y-m-d H:i:s',$result['created_at'])];
        $a=$this->media->add($data);
        echo  $response;//QuNoEDnMgxEMPGVoxaxSyohuFIrJgFRYudQQDtdSKsY6Hg2iRWauXCFPruvW9lwu
    }
    //根据media获取永久素材
    public function getNews(){
        $token=$this->get_access_token();
        $media='nuVUdbBjALyGdflHrAI51hDw0KWKtS2G0oMKamR0xwU';
        $data=['media_id'=>$media];
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/material/get_material?access_token='.$token,json_encode($data));
        echo $result;
    }
    //获取永久素材总数
    public function getAllNews(){
        $token=$this->get_access_token();
        $result=file_get_contents('https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token='.$token);
        echo $result;
    }
    //获取永久素材图文列表
    public function getNewList(){
        $data=['type'=>'news','offset'=>'0','count'=>'10'];
        $token=$this->get_access_token();
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$token,json_encode($data));
        echo $result;
    }
    /**
     * POST 请求
     * @param string $url
     * @param array $param
     * @param boolean $post_file 是否文件上传
     * @return string content
     */
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
    //查询所有分组
    public function getAllUser(){
        $token=$this->get_access_token();
        $result=file_get_contents('https://api.weixin.qq.com/cgi-bin/groups/get?access_token='.$token);
        echo $result;
    }
    //删除分组
    public function deleteGroup(){
        $token=$this->get_access_token();
        $data=['group'=>['id'=>104]];
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/groups/delete?access_token='.$token,json_encode($data));
        echo $result;
    }
    //添加分组
    public function addGroup(){
        $token=$this->get_access_token();
        $data=['group'=>['name'=>'一群逗逼']];
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/groups/create?access_token='.$token,$data);
        echo $result;
    }
    //批量移动分组
    public function batchMembers(){
        $token=$this->get_access_token();
        $data=['openid_list'=>['o3HPgvlGlX6qXBAFhPy_fkFFq-Kw','o3HPgvtcol_xGbkgLqEpcuFP3z6Y','o3HPgvtuETUwXTNMCfG8SsLF9LRA','o3HPgvrxt6b95yful3aq1FTFyK_g','o3HPgvkhCFlp-IrV7wUbOggTW0sc','o3HPgvvlFrYMflttHxd6Hfe-V7g0','o3HPgvqXXb7GI4YuP-dFgChikx2c'],'to_groupid'=>'105'];
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate?access_token='.$token,json_encode($data));
        echo $result;
    }
    //根据openid群发图文消息
    public function sendByOpenidList(){
        $token=$this->get_access_token();
        $data=['touser'=>['o3HPgvtuETUwXTNMCfG8SsLF9LRA','o3HPgvvlFrYMflttHxd6Hfe-V7g0'],'mpnews'=>['media_id'=>'YvcIK6RT9Nqr01GBm-u3Z0cJXs66QXXfqJ5NMwH20UmEJFSZwdipCxnSuVx6p5IS'],'msgtype'=>'mpnews'];
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$token,json_encode($data));
        echo $result;
    }
    //根据分组群发文本消息
    public function sendContentByGroup(){
        $token=$this->get_access_token();
        $data=['filter'=>['is_to_all'=>false,'group_id'=>105],'text'=>['content'=>'小样，你别跩Ｏ（∩＿∩）Ｏ哈！'],'msgtype'=>'text'];
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$token,$data);
        echo $result;
    }
    //获取消息自动回复接口
    public function reply(){
        $token=$this->get_access_token();
        $result=file_get_contents('https://api.weixin.qq.com/cgi-bin/get_current_autoreply_info?access_token='.$token);
        echo $result;
    }
    //按照分组发送图文素材
    public function sendByGounp(){
        $token=$this->get_access_token();
        $data=['filter'=>['is_to_all'=>false,'group_id'=>105],'mpnews'=>['media_id'=>'gKb_LFTfFc_x5cD-NUKlpzYkjjVvX5fEentcpy_eqIhDuaStJVkA_yefjVOHa2UN'],'msgtype'=>'mpnews'];
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$token,json_encode($data));
        print_r($result);
    }
    public function abc(){
        $this->load->model('media_model','media');
        $data=['type'=>'image','media_id'=>'123','create_at'=>date('Y-m-d H:i:s',time())];
        $a=$this->media->add($data);
        var_dump($a);
    }

}