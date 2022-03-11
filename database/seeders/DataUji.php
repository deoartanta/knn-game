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
        {
            DB::table('dt_evals')->insert(
                [
                    'no' => '1',
                    'kelas' => '1',
                    'jml_k' => 3
                ]);
            DB::table('dt_evals')->insert(
                [
                    'no' => '2',
                    'kelas' => '1',
                    'jml_k' => 3
                ]);
            DB::table('dt_evals')->insert(
                [
                    'no' => '3',
                    'kelas' => '0',
                    'jml_k' => 3
                ]);
            DB::table('dt_evals')->insert(
                [
                    'no' => '4',
                    'kelas' => '0',
                    'jml_k' => 3
                ]);
            DB::table('dt_evals')->insert(
                [
                    'no' => '5',
                    'kelas' => '0',
                    'jml_k' => 3
                ]);
        }
        // Prediction Data
            // Data 1
        {
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '1',
                    'no_data' => '1',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '2',
                    'no_data' => '1',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '3',
                    'no_data' => '1',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '4',
                    'no_data' => '1',
                    'value' => '3'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '5',
                    'no_data' => '1',
                    'value' => '3'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '6',
                    'no_data' => '1',
                    'value' => '3'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '7',
                    'no_data' => '1',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '8',
                    'no_data' => '1',
                    'value' => '100'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '9',
                    'no_data' => '1',
                    'value' => '3'
                ]);
        }
            // Data 2
        {
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '1',
                    'no_data' => '2',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '2',
                    'no_data' => '2',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '3',
                    'no_data' => '2',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '4',
                    'no_data' => '2',
                    'value' => '3'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '5',
                    'no_data' => '2',
                    'value' => '3'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '6',
                    'no_data' => '2',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '7',
                    'no_data' => '2',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '8',
                    'no_data' => '2',
                    'value' => '70'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '9',
                    'no_data' => '2',
                    'value' => '3'
                ]);
        }
            // Data 3
        {
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '1',
                    'no_data' => '3',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '2',
                    'no_data' => '3',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '3',
                    'no_data' => '3',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '4',
                    'no_data' => '3',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '5',
                    'no_data' => '3',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '6',
                    'no_data' => '3',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '7',
                    'no_data' => '3',
                    'value' => '2'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '8',
                    'no_data' => '3',
                    'value' => '65'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '9',
                    'no_data' => '3',
                    'value' => '1'
                ]);
        }
            // Data 4
        {
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '1',
                    'no_data' => '4',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '2',
                    'no_data' => '4',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '3',
                    'no_data' => '4',
                    'value' => '3'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '4',
                    'no_data' => '4',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '5',
                    'no_data' => '4',
                    'value' => '3'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '6',
                    'no_data' => '4',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '7',
                    'no_data' => '4',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '8',
                    'no_data' => '4',
                    'value' => '40'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '9',
                    'no_data' => '4',
                    'value' => '1'
                ]);
        }
        // Data 5
        {
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '1',
                    'no_data' => '5',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '2',
                    'no_data' => '5',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '3',
                    'no_data' => '5',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '4',
                    'no_data' => '5',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '5',
                    'no_data' => '5',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '6',
                    'no_data' => '5',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '7',
                    'no_data' => '5',
                    'value' => '1'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '8',
                    'no_data' => '5',
                    'value' => '40'
                ]);
            DB::table('pred_datas')->insert(
                [
                    'qu_id' => '9',
                    'no_data' => '5',
                    'value' => '1'
                ]);
        }
    }
}
