<?php
/**
 * 文章控制器
 * User: bruce.zeng
 * Date: 16-9-4
 * Time: 下午3:23
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends CI_Controller{
    public function add(){
        $this->load->helper('form');
        $this->load->view('Article/add.html');
    }
    //发布文章
    public function sendArticle(){
        $this->load->library('form_validation');
        $status=$this->form_validation->run('article'); //这里直接把验证跟验证方法放到config文件夹里面的form_validation立马
                                                        //这样有利于管理代码
        if($status){
            echo '发布文章成功';
        }else{
            $this->load->view('Article/add.html');
        }

    }

}