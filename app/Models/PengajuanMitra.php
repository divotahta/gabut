<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanMitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'email',
        'telepon',
        'media_lahan',
        'luas_lahan',
        'pohon',
        'alamat_detail',
        'latitude',
        'longitude',
        'tanggal_pengajuan',
        'status_pengajuan',
        'surat_tanah',
        'kontrak'
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 