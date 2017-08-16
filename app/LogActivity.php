<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LogActivity extends Model
{
    protected $table = 'log_activities';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'deskripsi', 'waktu_kegiatan',
    ];

    public function saveLog($string){
        $this->user_id = Auth::user()->id;
        $this->deskripsi = $string;
        $this->waktu_kegiatan = date("Y-m-d h:i:s");
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
