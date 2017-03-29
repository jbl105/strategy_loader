<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crawl extends Model
{
	public $table = 'crawl';
	public $timestamps = false;
    protected $fillable = [
        'portfolio_statistic',
        'metrics',
        'annual_returns',
        'monthly_returns',
        'timing_periods',
        'drawdowns_equal_weight_portfolio',
        'drawdowns_timing_portfolio',
        'drawdowns_vanguard_500_index_fund',
        'type_id'
    ];
    protected $hidden = [
        'id', 'type_id'
    ];

    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
