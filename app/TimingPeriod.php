<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimingPeriod extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'start',            
        'end', 
        'months', 
        'assets', 
        'asset_performance', 
        'timing_portfolio', 
        'equal_weight_portfolio', 
        'vanguard_500_index_fund', 
        'type', 
    ];

    protected $hidden = [
    	'id', 'type'
    ];
}
