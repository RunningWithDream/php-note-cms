<?php

namespace app\index\model;

use think\Model;

class News extends Model
{
    protected $pk = 'news_id';
    protected $autoWriteTimestamp = true;
}
