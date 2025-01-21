<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FueJournal extends Model
{
    //
    protected $table = 'FUE_JOURNAL';

    public $timestamps = false;

    protected $fillable = [
        'JOURNALID',
        'TRANSDATE',
        'TRANSTYPE',
        'TRANSDESC',
        'TRANSREF',
        'TRANSGROUPFROM',
        'TRANSGROUPTO',
        'VOLUME',
        'MEMO',
        'TRANSFROM',
        'TRANSTO',
        'YEARMONTH',
        'HOURMETER',
        'FLOWMETEREND',
        'TRANSTIMESTART',
        'TRANSTIMEEND',
        'TRANSSHIFT',
        'TRANSTIMESTAMP',
        'TRANSID',
        'TRANSUSERNAME',
    ];


}
