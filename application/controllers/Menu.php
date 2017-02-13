<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-9-27
 * Time: 上午9:29
 */
require_once 'Common.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends Common
{
    const API_CREATE = 'https://api.weixin.qq.com/cgi-bin/menu/create';
    const API_GET    = 'https://api.weixin.qq.com/cgi-bin/menu/get';
    const API_DELETE = 'https://api.weixin.qq.com/cgi-bin/menu/delete';
    const API_QUERY  = 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info';
    const suffix='?access_token=';
    //获取自定义菜单

    public function get_menu(){
        $token=$this->get_access_token();
        $menu=file_get_contents(self::API_QUERY.self::suffix.$token);
        $menu=json_decode($menu,true);
        $menu=$menu['selfmenu_info'];
        //$menu=empty($menus['menu']['button']) ? array() : $menus['menu']['button'];
        print_r($menu);
    }
    //删除菜单
    public function delete_menu(){
        $token=$this->get_access_token();
        $result=file_get_contents(self::API_DELETE.self::suffix.$token);
        $result=json_decode($result,true);
        if($result['errcode']=='0'){
            echo '删除成功';
        }else{
            echo '删除失败';
        }

//        echo $result;
    }
    /**
     * 转menu为数组
     *
     * @param array $menus
     *
     * @return array
     */
    protected function extractMenus(array $menus)
    {
        foreach ($menus as $key => $menu) {
            $menus[$key] = $menu->toArray();

            if ($menu->sub_button) {
                $menus[$key]['sub_button'] = $this->extractMenus($menu->sub_button);
            }
        }

        return $menus;
    }
    //增加自定义分组
    public function add_group(){
        $token=$this->get_access_token();
        $data=array('group'=>array('name'=>'小曾的逗'));
        $result=$this->http('https://api.weixin.qq.com/cgi-bin/groups/create?access_token='.$token,json_encode($data));
        //var_dump(json_decode($result,true));
        echo $result;
    }
    //查询所有分组
    public function get_all_group(){
        $token=$this->get_access_token();
        $result=file_get_contents('https://api.weixin.qq.com/cgi-bin/groups/get?access_token='.$token);
        var_dump(json_decode($result,true));
    }

}