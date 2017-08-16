<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachmentComment extends Model
{
    protected $table = 'attachment_comments';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment_id', 'lampiran', 'waktu_pembuatan',
    ];

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
