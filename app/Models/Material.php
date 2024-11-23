<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    protected $connection = 'focus';
    protected $table = 'PRD_MATERIAL';

    protected $guarded = [];
}
