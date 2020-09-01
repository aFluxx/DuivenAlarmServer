<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLosDataDuivenspelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('los_data_duivenspel', function (Blueprint $table) {
            $table->id();
            $table->string('losplaats')->nullable();
            $table->string('verbond')->nullable();
            $table->string('losuur')->nullable();
            $table->string('opmerking')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('los_data_duivenspels');
    }
}
