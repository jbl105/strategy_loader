<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrawdownsEqualWeightPortfolio extends Model
{
    public $table = 'drawdowns_equal_weight_portfolio';
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
