<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrawdownsTimingPortfolio extends Model
{
    public $table = 'drawdowns_timing_portfolio';
	public $timestamps = false;
    protected $fillable = [
        'rank',             
        'drawdown_start', 
        'drawdown_end', 
        'drawdown_length', 
        'recovery_by', 
        'recovery_time', 
        'drawdown', 
        'type', 
    ];

    protected $hidden = [
    	'id', 'type'
    ];
}
