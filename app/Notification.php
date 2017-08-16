<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'deskripsi', 'status_baca','waktu_pembuatan',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
