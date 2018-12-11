<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['latitude', 'longitude', 'altitude', 'device_id'];

    public function device()
    {
        return $this->hasOne('App\Device', 'id', 'device_id');
    }

    public function payload()
    {
        return $this->hasMany('App\PayloadData', 'post_id', 'id');
    }
}
