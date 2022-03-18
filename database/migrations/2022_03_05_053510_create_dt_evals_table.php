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
            $table->bigInteger('jml_k')->nullable();
            $table->timestamps();
        });
        Schema::table('pred_datas', function (Blueprint $table) {
            $table->foreign('no_data')
                ->references('no')->on('dt_evals')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pred_datas', function (Blueprint $table) {
            $table->dropForeign(['no_data']); // fk first
            
            // $table->dropColumn('no_data'); // then column
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('dt_evals');
    }
}
