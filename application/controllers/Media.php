<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-11-14
 * Time: 上午9:39
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Media extends CI_Controller
{
    public function __construct(){
        parent::__construct();
       // $this->load->helper('url');
        $this->load->model('media_model','media');

    }
    //查询
    public function select(){
        $medias=$this->media->select();
        print_r($medias);
    }
    //增加
    public function add(){
        $data=['type'=>'image',
                'title'=>'新增临时素材',
                'media_id'=>'PQ2nJugK7PVlMy79YMEUyPLO02-R0TrAPLoMXgQxNzuqCO_X9v831pnR_LWC-Ezh',
                'create_at'=>date('Y-m-d H:i:s',time())];
        $result=$this->media->add($data);
//        for($i=0;$i<20;$i++){
//            $this->media->add($data);
//        }
        echo $result;
    }
    //updata
    public function update(){
        $where=['id'=>'25'];
        $data=['type'=>'sb',
                'create_at'=>date('Y-m-d H:i:s',time())];
        $media=$this->media->update($where,$data);
        print_r($media);
    }
    public function delete($id){
        $result=$this->media->delete($id);
        redirect('media/index');
    }
    //简单的分页
    public function index(){
        $per_page=$this->input->get('per_page');
        $per='10';
        $count=$this->media->count('media');
        $this->load->library('Page');   //只有载下面的new才能找到这个类
        $result=$this->page->pages('media',$per,$count,'index',$per_page);
        $this->load->view('page',$result);

    }



}