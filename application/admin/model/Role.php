<?php

namespace app\admin\model;

use think\Model;

class Role extends Model
{
    protected $table = 'rbac_role';
    protected $pk = 'id';
    protected $autoWriteTimestamp = true;
}
