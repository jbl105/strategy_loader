<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('portfolio');
            $table->string('initial_balance');
            $table->string('final_balance');
            $table->string('CAGR');
            $table->string('std_dev');
            $table->string('best_year');
            $table->string('worst_year');
            $table->string('max_drawdown');
            $table->string('sharpe_ratio');
            $table->string('sortino_ratio');
            $table->string('us_mkt_correlation');
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_statistics');
    }
}
