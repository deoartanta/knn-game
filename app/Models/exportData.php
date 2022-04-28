<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exportData extends Model
{
    use HasFactory;
    protected $fillable = [
        'q1','q2','q3','q4','q5','q6','q7','q8','q9','kelas'
    ];
}
