<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    //是否逻辑删除
    const DISABLED = "T";  //关闭
    const ENABLED = "F";  //启用
}

