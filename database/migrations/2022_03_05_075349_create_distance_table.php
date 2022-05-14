<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('no_data');
            $table->decimal('nilai', $precision = 30, $scale = 12);
            $table->integer('kelas')->nullable();
            $table->timestamps();
            $table->foreign('no_data')
                ->references('no')->on('dt_evals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('distances');
    }
}
