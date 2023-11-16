<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surat';
    protected $primaryKey = 'kd_surat';
    public $incrementing = false;
    protected $fillable = [
        'kd_surat',
        'nomor_surat',
        'judul_surat',
        'kategori_surat',
        'file_surat'
    ];

    public function kategoriSurat() {
        return $this->belongsTo(KategoriSurat::class, 'kategori_surat',  'id')->withTrashed();
    }
}
