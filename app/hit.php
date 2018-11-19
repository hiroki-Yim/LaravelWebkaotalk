<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hit extends Model
{
    protected $fillable = ['postid', 'userid', 'like'];
}
