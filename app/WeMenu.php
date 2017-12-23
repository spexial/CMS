<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeMenu extends Model
{
    protected $table = 'we_menus';

    public function Menu()
    {
        return $this->belongsTo('App\WeMenu','parent_id');
    }
}
