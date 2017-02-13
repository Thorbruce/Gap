<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-11-10
 * Time: 下午1:08
 */
require_once  'Common.php';
require_once 'Media.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends Common
{
    public function index(){

     $this->load->view('login');


    }
    //生成二维码
    public function qcord(){
        //$this->load->library('Qrcode');
        echo $this->qrcode->png('hcttp://www.sina.com');
    }
    public function excel(){
        //$this->load->library('PHPExcel');
        $this->load->model('media_model','media');
        $data=$this->media->select();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle('export')->setDescription('none');

    }
    public function cc(){
        $de=new Media();

    }

}