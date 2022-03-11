<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;
    protected $table = "pred_datas";
    protected $fillable = [
        'qu_id',
        'no',
        'value',
    ];
}
