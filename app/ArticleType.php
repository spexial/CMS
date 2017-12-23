<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    public function article()
    {
        return $this->hasMany('App\Article','type_id');
    }

    // 获取父级节点
    public function parentType()
    {
        return $this->belongsTo('App\ArticleType', 'parent_id');
    }
}
