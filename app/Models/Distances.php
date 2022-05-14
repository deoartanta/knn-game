<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distances extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "distances";
    protected $fillable = [
        'no_data',
        'nilai',
        'kelas',
        'updated_at',
    ];
}
