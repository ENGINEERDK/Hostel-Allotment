<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentmerit extends Model
{
    protected $fillable = [
        'regno', 'year','academics','attendance','merit',
    ];
}
