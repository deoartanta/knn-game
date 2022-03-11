<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuAnswers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('qu_answers')->insert(
             [
                'qu_id' => '1',
                'answer' => 'Tidak',
                'value' => '1',
                'type' => 'radio']);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '1',
                'answer' => 'Ya',
                'value' => '2',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '2',
                'answer' => 'Kurang Dari 2 Jam',
                'value' => '1',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '2',
                'answer' => 'Lebih Dari 2 Jam',
                'value' => '1',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '3',
                'answer' => 'Tidak',
                'value' => '1',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '3',
                'answer' => 'Ya',
                'value' => '2',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '4',
                'answer' => 'Tidak',
                'value' => '1',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '4',
                'answer' => 'Ya',
                'value' => '2',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '4',
                'answer' => 'Kadang-kadang',
                'value' => '3',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '5',
                'answer' => 'Tidak',
                'value' => '1',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '5',
                'answer' => 'Ya',
                'value' => '2',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '5',
                'answer' => 'Kadang-kadang',
                'value' => '3',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '6',
                'answer' => 'Tidak',
                'value' => '1',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '6',
                'answer' => 'Ya',
                'value' => '2',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '6',
                'answer' => 'Kadang-kadang',
                'value' => '3',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '7',
                'answer' => 'Tidak',
                'value' => '1',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '7',
                'answer' => 'Ya',
                'value' => '2',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '8',
                'answer' => 'Jumlah Level Tertinggi',
                'value' => '',
                'type' => 'input'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '9',
                'answer' => 'Tidak',
                'value' => '1',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '9',
                'answer' => 'Ya',
                'value' => '2',
                'type' => 'radio'
            ]);
            DB::table('qu_answers')->insert(
             [
                'qu_id' => '9',
                'answer' => 'Kadang-kadang',
                'value' => '3',
                'type' => 'radio'
            ]
        );
    }
}
