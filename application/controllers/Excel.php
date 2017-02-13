<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-11-2
 * Time: 上午10:57
 */
require_once('../../application/libraries/PHPExcel.php');
require_once('../../application/libraries/PHPExcel/IOFactory.php');
defined('BASEPATH') OR exit('No direct script access allowed');
class Excel extends CI_Controller
{
  public function explort(){
        $excel=PHPExcel_IOFactory::load('query.xls');
        $data=$excel->getSheet(0)->toArray();
        print_r($data);
  }
}