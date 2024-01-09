<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makananan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jenis',
        'stock',
        'foto_makanan'
    ];
}
