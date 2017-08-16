<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachmentListToDo extends Model
{
    protected $table = 'attachment_list_to_dos';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'list_to_do_id', 'lampiran', 'waktu_pembuatan',
    ];

    public function attachment_list_to_do()
    {
        return $this->belongsTo('App\ListToDo');
    }
}
