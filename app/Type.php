<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'name', 'slug', 'link'
    ];
    protected $hidden = [
        'link'
    ];

    public function crawl()
    {
        return $this->hasMany('App\Crawl');
    }
}
