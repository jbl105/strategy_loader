<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->string('month');
            $table->string('timing_return');
            $table->string('equal_weight_portfolio_return');
            $table->string('vanguard_500_index_fund_return');
            $table->string('VFINX');
            $table->string('VGTSX');
            $table->string('VEIEX');
            $table->string('VGSIX');
            $table->string('VGPMX');
            $table->string('VGENX');
            $table->string('VCVSX');
            $table->string('VWEHX');
            $table->string('VWAHX');
            $table->string('VFIIX');
            $table->string('VWESX');
            $table->string('VFISX');
            $table->string('VFITX');
            $table->string('VFICX');
            $table->string('VUSTX');
            $table->string('timing_balance');
            $table->string('equal_weight_portfolio_balance');
            $table->string('vanguard_500_index_fund_balance');
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
        Schema::dropIfExists('monthly_returns');
    }
}
