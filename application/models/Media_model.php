<?php

/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-10-19
 * Time: 下午2:21
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Media_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /**增加
     * @param $data
     * @return mixed
     */
    public function add($data){
        $a=$this->db->insert('media',$data);
        return $a;
    }

    /**
     * 查询
     * @return mixed
     */
    public function select(){
        $media=$this->db->get('media');     //get里面必须放表名
        return $media->result_array();      //result_array()是将以一个纯粹的数组 形式返回查询结果
    }

    /**更新
     * @param $where 以array传进去【‘id’=>'123'】
     * @param $data  以array传进去【‘name’=>'xiaozeng'】
     */
    public function update($where,$data){
        $media=$this->db->where($where)->update('media',$data);
        return $media;
    }

    /**删除
     * @param $id
     */
    public function delete($id){
        return $this->db->where('id',$id)->delete('media');
    }

    /**统计count
     * @param $table 表名
     * @return mixed
     */
    public function count($table){
        return $this->db->count_all_results($table);
    }

    /**
     * @param $table    表名
     * @param $per_page 每页数量
     * @param $start    起始位置
     */
    public function pageSeclect($table,$per_page,$start){
        return $this->db->limit($per_page,$start)->get($table)->result_array();
    }
}