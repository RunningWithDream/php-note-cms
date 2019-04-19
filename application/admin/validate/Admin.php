<?php

namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username'=>'require',
        'phone'=>'require|mobile',
        'password'=>'require',
        'repass'=>'require|confirm:password',
        'email'=>'require|email',
        'status'=>'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require' => '账户名不能为空',
        'phone.require'     => '手机不能为空',
        'phone.mobile'     => '手机格式非法',
        'password.require'   => '密码不能为空',
        'repass.confirm'   => '两次密码不一致',
        'email.require'   => '邮箱不能为空',
        'status.require'   => '状态不能为空',
    ];

    /**
     * @var array 验证场景
     */
    protected $scene = [
        'update'  =>  ['password','repass'],
    ];
}
