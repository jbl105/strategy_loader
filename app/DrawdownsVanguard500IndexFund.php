<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrawdownsVanguard500IndexFund extends Model
{
    public $table = 'drawdowns_vanguard_500_index_fund';
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
