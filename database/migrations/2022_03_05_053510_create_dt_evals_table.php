<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtEvalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_evals', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('no')->index();
            $table->integer('kelas')->nullable();
            $table->integer('kelas_prediksi')->nullable();
            $table->bigInteger('jml_k');
            $table->timestamps();
        });
        Schema::table('pred_datas', function (Blueprint $table) {
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
        Schema::dropIfExists('dt_evals');
    }
}
