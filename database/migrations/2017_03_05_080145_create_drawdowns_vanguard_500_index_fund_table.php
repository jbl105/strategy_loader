<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrawdownsvanguard500IndexFundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drawdowns_vanguard_500_index_fund', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rank');
            $table->string('drawdown_start');
            $table->string('drawdown_end');
            $table->string('drawdown_length');
            $table->string('recovery_by');
            $table->string('recovery_time');
            $table->string('drawdown');
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
        Schema::dropIfExists('drawdowns_vanguard_500_index_fund');
    }
}
