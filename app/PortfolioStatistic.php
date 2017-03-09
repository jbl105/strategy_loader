<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortfolioStatistic extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'portfolio', 
        'initial_balance', 
        'final_balance', 
        'CAGR', 
        'std_dev', 
        'best_year', 
        'worst_year', 
        'max_drawdown', 
        'sharpe_ratio', 
        'sortino_ratio', 
        'us_mkt_correlation', 
        'type', 
    ];

    protected $hidden = [
    	'id', 'type'
    ];
}
