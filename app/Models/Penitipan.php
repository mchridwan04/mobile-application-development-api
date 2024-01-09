<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penitipan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemilik',
        'tanggal',
        'hewan_id',
    ];

    protected $table = 'penitipans';

    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'hewan_id');
    }
}
