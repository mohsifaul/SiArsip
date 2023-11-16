<?php

namespace App\Http\Controllers;
use App\Models\Surat;
use App\Models\KategoriSurat;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSurat = Surat::count();
        $totalKategori = KategoriSurat::whereNull('deleted_at')->count();
        return view('/dashboard', ['totalSurat'=> $totalSurat, 'totalKategori' => $totalKategori]);
    }
}
