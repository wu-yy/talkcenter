<?php
/**
 * Created by PhpStorm.
 * User: wuyongyu
 * Date: 2017/8/21
 * Time: 11:11
 */
if (!defined('IN_ANWSION'))
{
    die;
}

class code_class extends AWS_MODEL
{

        public function  get_alive_code($code_num)
        {
            //获取所有的没有使用过的优惠码的列表
            if($find=$this->fetch_one('code','value',"content='".$code_num."' and alive=0"))
            {
                return $find;
            }else
            {
                return false;
            }
        }

        //优惠码使用之后，失效
        public function set_code_die($code_num)
        {
            $data['alive']=0;
            $result=$this->update('code',$data,"content='".$code_num."'");
            return $result;
        }


}