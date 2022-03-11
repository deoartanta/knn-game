<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtEvals extends Model
{
    use HasFactory;
    protected $table = "dt_evals";
    protected $fillable = [
        'no ',
        'kelas',
        'kelas_prediksi',
        'jml_k',
    ];
}
