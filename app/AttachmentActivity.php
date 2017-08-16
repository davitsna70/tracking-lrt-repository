<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachmentActivity extends Model
{
    protected $table = 'attachment_activities';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_id', 'lampiran', 'waktu_pembuatan',
    ];

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }
}
