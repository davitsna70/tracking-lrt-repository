<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'tujuan', 'status_baca', 'waktu_pengiriman',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function user_tujuan()
    {
        return $this->belongsTo('App\User', 'tujuan');
    }
}
