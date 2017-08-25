<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityRelation extends Model
{
    protected $table = 'activity_relations';
    public $timestamps = false;

    public function activity(){
        return $this->belongsTo('App\Activity');
    }

    public function tergantung(){
        return $this->belongsTo('App\Activity','tergantung');
    }
}
