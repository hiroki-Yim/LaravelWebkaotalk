<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mean extends Model
{
    //
    protected $fillable = [
        'word_id', 'mean', 'class',
    ];
}
