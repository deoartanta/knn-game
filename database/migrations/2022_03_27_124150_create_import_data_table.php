<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_data', function (Blueprint $table) {
            $table->id();
            $table->integer('q1')->nullable();
            $table->integer('q2')->nullable();
            $table->integer('q3')->nullable();
            $table->integer('q4')->nullable();
            $table->integer('q5')->nullable();
            $table->integer('q6')->nullable();
            $table->integer('q7')->nullable();
            $table->integer('q8')->nullable();
            $table->integer('q9')->nullable();
            $table->integer('kelas')->nullable();
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
        Schema::dropIfExists('import_data');
    }
}
