<?php
/**
 * Created by PhpStorm.
 * User: bruce.zeng
 * Date: 16-9-5
 * Time: 上午8:27
 *表单验证的配置
 */
$config=array(
    'article'=>array(
        array(
            'field'=>'title',
            'label'=>'文章标题',
            'rules'=>'required|min_length[5]'
        ),
        array(
            'field'=>'author',
            'label'=>'文章作者',
            'rules'=>'required'
        ),
        array(
            'field'=>'type',
            'label'=>'文章类型',
            'rules'=>'required'
        ),
        array(
            'field'=>'cid',
            'label'=>'文章栏目',
            'rules'=>'required|integer'
        ),
        array(
            'field'=>'content',
            'label'=>'文章内容',
            'rules'=>'required|min_length[10]|max_length[500]'
        ),

    )
);