<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayloadData extends Model
{
    protected $fillable = ['post_id', 'field_name', 'field_value'];
}
