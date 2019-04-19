<?php

namespace app\admin\validate;

use think\Validate;

class Role extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'rolename'=>'require'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'rolename.require' => '角色名不能为空'
    ];

    /**
     * @var array 验证场景
     */
    protected $scene = [
        'update'  =>  ['password','repass'],
    ];
}
