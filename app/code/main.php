<?php
/**
 * Created by PhpStorm.
 * User: wuyongyu
 * Date: 2017/8/21
 * Time: 10:04
 */
 if (!defined('IN_ANWSION'))
 {
     die;
 }

 class main extends AWS_CONTROLLER
 {

     public function setup()
     {
         $this->crumb(AWS_APP::lang()->_t('优惠码'), '/code/');
     }
     public function index_action()
     {
        HTTP::redirect('/code/put/');
     }

     public function put_action()
     {
         $this->crumb(AWS_APP::lang()->_t('输入优惠码'), '/code/put/');
         TPL::output('/code/put');
     }

     //检测输入的优惠码是否正确
     public function check_action()
     {
         $code=$_POST['put_code'];
        $count=$this->model('code')->get_alive_code($code);
        if($count) {
            //将优惠码添加到用户的余额 $find 代表优惠码代表的价格
            if (!$result = $this->model('code')->set_code_die($code)) //将优惠码失效
            {
                $this->model('account')->set_user_money($this->user_id, $count);
                TPL::assign('result', true);
                //$this->result=true;

            }
        }
        TPL::output('/code/put');
        HTTP::redirect('/code/put');
     }

     function curl_post_ssl($url,$vars,$second=30,$aHeader=array())
     {
         $ch=crul_init();

     }
 }