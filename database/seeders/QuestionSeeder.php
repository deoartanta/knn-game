<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert(
        [
            'qu_name' => 'Bermain Game Setiap Hari'
        ]);
        DB::table('questions')->insert(
        [
            'qu_name' => 'Lama Bermain dalam Sehari'
        ]);
        DB::table('questions')->insert(
        [
            'qu_name' => 'Dimarahin Orang Tua karena bermain Game'
        ]);
        DB::table('questions')->insert(
        [
            'qu_name' => 'Merasa Pusing saat main Game'
        ]);
        DB::table('questions')->insert(
        [
            'qu_name' => 'Lupa mengerjakan tugas karena bermain game'
        ]);
        DB::table('questions')->insert(
        [
            'qu_name' => 'Marah Saat bermain game'
        ]);
        DB::table('questions')->insert(
        [
           'qu_name' => 'Membeli Voucher Game'
        ]);
        DB::table('questions')->insert(
        [
            'qu_name' => 'Level Tertingi Game'
        ]);
        DB::table('questions')->insert(
        [
            'qu_name' => 'Merasa Malu Saat Kalah bermain game'
        ]);
    }
}
