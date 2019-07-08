<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    public function items() {
        return $this->belongsToMany('App\Item', 'item_gift', 'gift_id', 'item_id');
    }

}
