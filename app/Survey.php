<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'survey';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id'
    ];
}
