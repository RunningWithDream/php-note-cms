<?php

namespace app\index\model;

use think\Model;
use think\model\concern\SoftDelete;

class Msg extends Model
{
    //
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $table = 'info';
}
