<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    //
    protected $connection = 'focus';
    protected $table = 'PRS_PERSONAL';

    protected $guarded = [];
}
