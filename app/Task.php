<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // The attributes which are mass assignable.
    protected $fillable = array('name');

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}