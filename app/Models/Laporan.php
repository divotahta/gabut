<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'mitra_id',
        'pegawai_id',
        'tanggal_laporan',
        'keterangan',
        'media_foto',
        'media_video',
        'metode'
    ];

    protected $casts = [
        'tanggal_laporan' => 'datetime',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'pegawai_id')->where('role', 'pegawai');
    }
} 