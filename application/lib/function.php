<?php
/**
 * Created by PhpStorm.
 * User: etocrm
 * Date: 2015/10/22
 * Time: 1:14
 */

function getSurp($num)
{
    global $m;
    $condition['id'] = 1;
    if(!$res = $m->get('surp', 'num', $condition)) return false;

    return $res >= $num ? true : false;
}

function setSurp($num)
{
    global $m;
    $condition['id'] = 1;
    $data['num[-]'] = $num;
    return $m->update('surp', $data, $condition);

}