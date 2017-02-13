<?php

/**
 * 这只是一个分页的小功能
 * User: bruce.zeng
 * Date: 16-11-14
 * Time: 下午2:32
 */

class Page
{
    public function __construct()
    {
        // 用CI =& get_instance()代替 $this,因为在自己的类库里面没法使用$this(CodeIgniter对象),$this只能在控制器里面使用
        $this->CI =& get_instance();
        $this->CI->load->model('media_model','media');
    }
    /**
     *  分页，样式可以控制
     * @param $table            表名
     * @param $per_page         每页显示条数
     * @param $url              分页url
     * @param $count            总共条数

     */
    public function pages($table,$per_page,$count,$url,$start_position){



        $this->CI->load->library('pagination');
        $config['base_url'] =$url;
        $config['total_rows']   =$count;    //记录总条数
        $config['per_page']     =$per_page;                             //每页显示多少条
        $config['page_query_string'] = TRUE;
        $config['first_link'] = '第一页'; // 第一页显示
        $config['last_link'] = '末页'; // 最后一页显示
        $config['next_link'] = '下一页 >'; // 下一页显示
        $config['prev_link'] = '< 上一页'; // 上一页显示
        $config['cur_tag_open'] = ' <a class="current">'; // 当前页开始样式
        $config['cur_tag_close'] = '</a>';
        $data=$this->CI->media->pageSeclect($table,$per_page,$start_position);
        $this->CI->pagination->initialize($config);
        return $result=['data'=>$data];

    }

}