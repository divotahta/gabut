<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitra';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'email',
        'telepon',
        'luas_lahan',
        'pohon',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'alamat_detail',
        'latitude',
        'longitude',
        'media_lahan',
        'surat_tanah',
        'kontrak',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
} 