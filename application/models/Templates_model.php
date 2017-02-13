<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-9-28
 * Time: 下午4:35
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Templates_model extends CI_Model
{
    public function __construct(){
               parent::__construct();
         $this->load->database();
   }

   public function getALl(){
       $c=$this->db->get('id',1);
       return $c;
   }
}