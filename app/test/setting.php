<?php
/*
+--------------------------------------------------------------------------
|   WeCenter [#RELEASE_VERSION#]
|   ========================================
|   by WeCenter Software
|   © 2011 - 2014 WeCenter. All Rights Reserved
|   http://www.wecenter.com
|   ========================================
|   Support: WeCenter@qq.com
|
+---------------------------------------------------------------------------
*/


if (!defined('IN_ANWSION'))
{
    die;
}

class setting extends AWS_CONTROLLER
{
    public function get_access_rule()
    {
        $rule_action['rule_type'] = 'white'; //黑名单,黑名单中的检查  'white'白名单,白名单以外的检查
        $rule_action['actions'] = array();

        return $rule_action;
    }

    public function setup()
    {
        $this->crumb(AWS_APP::lang()->_t('设置'), '/test/setting/');

        TPL::import_css('css/user-setting.css');
    }

    public function index_action()
    {
        HTTP::redirect('/test/setting/profile/');
    }

    public function profile_action()
    {
        $this->crumb(AWS_APP::lang()->_t('基本资料'), '/test/setting/profile/');

        for ($i = date('Y'); $i > 1900; $i--)
        {
            $birthday_y[$i] = $i;
        }

        TPL::assign('birthday_y', $birthday_y);

        for ($tmp_i = 1; $tmp_i <= 31; $tmp_i ++)
        {
            $birthday_d[$tmp_i] = $tmp_i;
        }

        TPL::assign('birthday_d', $birthday_d);

        TPL::assign('job_list', $this->model('work')->get_jobs_list());

        TPL::assign('education_experience_list', $this->model('education')->get_education_experience_list($this->user_id));

        $jobs_list = $this->model('work')->get_jobs_list();

        if ($work_experience_list = $this->model('work')->get_work_experience_list($this->user_id))
        {
            foreach ($work_experience_list as $key => $val)
            {
                $work_experience_list[$key]['job_name'] = $jobs_list[$val['job_id']];
            }
        }

        TPL::assign('work_experience_list', $work_experience_list);

        TPL::import_js('js/fileupload.js');

        TPL::output('test/setting/profile');
    }


}
