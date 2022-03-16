<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qu_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('qu_id')
                ->constrained('questions')
                ->onDelete('cascade');
            $table->string('answer');
            $table->string('value');
            $table->string('type')->default('input');
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
        Schema::table('qu_answers', function (Blueprint $table) {
            $table->dropForeign(['qu_id']); // fk first

            // $table->dropColumn('qu_id'); // then column
        });
        Schema::dropIfExists('qu_answers');
    }
}
