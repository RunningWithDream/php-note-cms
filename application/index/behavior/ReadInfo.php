<?php

namespace app\index\behavior;

use app\index\model\User;

class ReadInfo
{
    public function run()
    {
        $id   = request()->route('id');
        echo 'run-id:'.$id;
    }
}