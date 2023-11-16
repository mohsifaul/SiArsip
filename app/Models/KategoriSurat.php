<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriSurat extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kategorisurat'; // Nama tabel kategori_surat
    protected $primaryKey = 'id'; // Nama primary key yang sesuai
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'nama_kategori', 'keterangan']; // Kolom yang dapat diisi

    // Relasi dengan tabel surat
    public function surats()
    {
        return $this->hasMany(Surat::class, 'kategori_surat', 'id');
    }
}
