<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'activity_id', 'isi',
    ];

    public function attachment_comments()
    {
        return $this->hasMany('App\AttachmentComment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public function delete()
    {
        foreach ($this->attachment_comments as $attachment_comment){
            $attachment_comment->delete();
        }
        return parent::delete(); // TODO: Change the autogenerated stub
    }
}
