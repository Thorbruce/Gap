<?php
/**
 * 这只是一个测试的控制器
 * User: bruce.zeng
 * Date: 16-9-4
 * Time: 上午10:19
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Doubi extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['title']='我是2b';
       // redirect('index/doubi/dbi');
        echo site_url().'<br>';
        echo base_url();
        $this->load->view('index/top.html',$data);
        $this->load->view('index/doubi.html');
        $this->load->view('index/footer.html');
    }
    public function dbi(){
        print_r($_SERVER['HTTP_HOST']);
    }

}
