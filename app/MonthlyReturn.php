<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyReturn extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'year', 
        'month', 
        'timing_return', 
        'equal_weight_portfolio_return', 
        'vanguard_500_index_fund_return', 
        'VFINX', 
        'VGTSX', 
        'VEIEX', 
        'VGSIX', 
        'VGPMX', 
        'VGENX', 
        'VCVSX', 
        'VWEHX', 
        'VWAHX', 
        'VFIIX', 
        'VWESX', 
        'VFISX', 
        'VFITX', 
        'VFICX', 
        'VUSTX', 
        'timing_balance', 
        'equal_weight_portfolio_balance', 
        'vanguard_500_index_fund_balance', 
        'type', 
    ];

    protected $hidden = [
    	'id', 'type'
    ];
}
