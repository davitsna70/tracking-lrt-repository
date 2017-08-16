<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nama_grup',
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function delete()
    {
        foreach ($this->users as $user) $user->delete();
        return parent::delete(); // TODO: Change the autogenerated stub
    }
}
