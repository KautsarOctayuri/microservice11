<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profileperusahaan extends Model
{
    use HasFactory;
    protected $table = 'profileperusahaan'; // agar bisa di panggil di postman

    protected $fillable = [
        'nama_perusahaan',
         'deskripsi',
         'latitude',
         'longitude',
         'jam_masuk',
         'jam_pulang',
         


    ];
}