<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'metric', 
        'timing_model', 
        'equal_weight_portfolio', 
        'vanguard_500_index_fund',
        'type', 
    ];

    protected $hidden = [
    	'id', 'type'
    ];
}
