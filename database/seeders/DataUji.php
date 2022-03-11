<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataUji extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data Evaluasi
        DB::table('dt_evals')->insert(
            [
                'no' => '1',
                'kelas' => '1',
                'kelas_prediksi' => '',
                'jml_k' => ''
            ]);
        DB::table('dt_evals')->insert(
            [
                'no' => '2',
                'kelas' => '1',
                'kelas_prediksi' => '',
                'jml_k' => ''
            ]);
        DB::table('dt_evals')->insert(
            [
                'no' => '3',
                'kelas' => '0',
                'kelas_prediksi' => '',
                'jml_k' => ''
            ]);
        DB::table('dt_evals')->insert(
            [
                'no' => '4',
                'kelas' => '0',
                'kelas_prediksi' => '',
                'jml_k' => ''
            ]);
        DB::table('dt_evals')->insert(
            [
                'no' => '5',
                'kelas' => '0',
                'kelas_prediksi' => '',
                'jml_k' => ''
            ]);
        // Prediction Data
        DB::table('pred_datas')->insert(
            [
                'qu_id' => '1',
                'no_data' => '1',
                'value' => '2'
            ]);
    }
}
