<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // Nama tabel (opsional, jika nama tabel bukan bentuk jamak dari nama model)
    protected $table = 'mahasiswas';

    // Primary key (opsional, jika berbeda dari default "id")


    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'npm', 
        'nama', 
        'prodi',
    ];

    public $timestamps = true; // Nonaktifkan fitur timestamps
    
}
