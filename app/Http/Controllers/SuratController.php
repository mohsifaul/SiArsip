<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arsip = Surat::latest()->get();
        return view('/surat/arsipsurat', ['arsip' => $arsip]);
    }

    public function formTambah()
    {
        $kategori = KategoriSurat::all();
        return view('/surat/tambaharsip', ['kategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat,nomor_surat',
            'judul_surat' => 'required',
            'kategori_surat' => 'required',
            'file_surat' => 'required|mimes:pdf|max:2048',
        ], [
            'nomor_surat.required' => 'Nomor Surat harus diisi.',
            'nomor_surat.unique' => 'Nomor Surat sudah digunakan.',
            'judul_surat.required' => 'Judul Surat harus diisi.',
            'kategori_surat.required' => 'Kategori Surat harus dipilih.',
            'file_surat.required' => 'File Surat harus diupload.',
            'file_surat.mimes' => 'File Surat harus berupa PDF.',
            'file_surat.max' => 'File Surat maksimal 2 Mb.',
        ]);
        // Menyimpan file dengan nama yang unik dan di folder 'FileArsip'
        $fileSurat = $request->file('file_surat');
        $namaSurat = $fileSurat->getClientOriginalName();
        $fileSurat->move(public_path('File Arsip/'), $namaSurat);


        // Mendapatkan id terakhir
        $lastSurat = Surat::orderBy('kd_surat', 'desc')->first();
        if ($lastSurat) {
        $lastKd = intval(substr($lastSurat->kd_surat, 1));
        } else {
            $lastKd = 0;
        }
        $kd = 'S' . str_pad($lastKd + 1, 3, '0', STR_PAD_LEFT);

        // Buat instansiasi objek Akun dengan data input
        $surat = new Surat();
        $surat->kd_surat = $kd;
        $surat->nomor_surat = $request->nomor_surat;
        $surat->judul_surat = $request->judul_surat;
        $surat->kategori_surat = $request->kategori_surat;
        $surat->file_surat = $namaSurat;
        $surat->created_at = now();
        $surat->updated_at = null;
        
        // Simpan surat ke database
        $surat->save();

        // Redirect atau berikan respon sesuai kebutuhan
        toast('Surat berhasil diarsipkan.', 'success');
        return redirect('/arsip-surat');
    }

    public function unduhFileSurat($id)
    {
        $surat = Surat::find($id);
        
        if (!$surat || $surat->file_surat === '-') {
            // Handle jika surat tidak ditemukan atau file_surat bernilai '-'
            alert()->error('Unduhan Gagal','File Dokumen Tidak Ditemukan');
            return redirect()->back();
        }

        $filePath = public_path('File Arsip/' . $surat->file_surat);

        if (file_exists($filePath)) {
            alert()->success('Unduhan Berhasil','File Dokumen telah didownload');
            return response()->download($filePath, $surat->file_surat);
        } else {
            // Handle jika file tidak ditemukan
            return redirect()->back()->with('error', 'File dokumen tidak ditemukan.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lihatsurat = Surat::with('kategoriSurat')->find($id);
        // Tampilkan surat pada halaman lihat-surat
        $kategoriList = KategoriSurat::all();
        return view('/surat/lihatsurat', ['surat' => $lihatsurat, 'kategorisurat' => $kategoriList]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Menggunakan whereNull untuk mengambil hanya data yang belum dihapus secara lunak
        $kategori = KategoriSurat::whereNull('deleted_at')->get();

        // Menggunakan with untuk memuat relasi kategoriSurat dan mengambil data surat
        $surat = Surat::with(['kategoriSurat' => function($query) {
            // Menggunakan withTrashed untuk memuat relasi yang telah dihapus
            $query->withTrashed();
        }])->find($id);

        return view('/surat/editarsip', ['surat' => $surat, 'kategori' => $kategori]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'judul_surat' => 'required',
            'kategori_surat' => 'required',
            'file_surat' => 'nullable|mimes:pdf|max:2048',
        ], [
            'nomor_surat.required' => 'Nomor Surat harus diisi.',
            'judul_surat.required' => 'Judul Surat harus diisi.',
            'kategori_surat.required' => 'Kategori Surat harus dipilih.',
            'file_surat.mimes' => 'File Surat harus berupa PDF.',
            'file_surat.max' => 'File Surat maksimal 2 Mb.',
        ]);

        // dd($request->all());
        // Mendapatkan data surat yang akan diupdate
        $surat = Surat::find($id);

        // Memeriksa apakah ada file_surat baru diinputkan
        if ($request->hasFile('file_surat')) {
            // Jika ada, validasi dan simpan file baru
            $fileSurat = $request->file('file_surat');
            $namaSurat = $fileSurat->getClientOriginalName();
            $fileSurat->move(public_path('File Arsip/'), $namaSurat);

            // Hapus file lama jika ada
            if (file_exists(public_path('File Arsip/') . $surat->file_surat)) {
                unlink(public_path('File Arsip/') . $surat->file_surat);
            }

            // Update data surat dengan file surat baru
            $surat->file_surat = $namaSurat;
        }

        // Update data surat dengan input lainnya
        $surat->nomor_surat = $request->nomor_surat;
        $surat->judul_surat = $request->judul_surat;
        $surat->kategori_surat = $request->kategori_surat;
        $surat->updated_at = now();

        // Simpan perubahan ke database
        $surat->save();

        // Redirect atau berikan respon sesuai kebutuhan
        toast('Surat berhasil diupdate.', 'success');
        return redirect('/arsip-surat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $arsip = Surat::find($id);

        if (!$arsip) {
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Hapus file_surat dari folder File Arsip menggunakan unlink
        $fileSuratPath = public_path('File Arsip') . '/' . $arsip->file_surat;

        if (file_exists($fileSuratPath)) {
            unlink($fileSuratPath);
        }

        // Hapus record dari database
        $arsip->delete();

        toast('Surat berhasil dihapus.', 'success');
        return redirect('/arsip-surat');
    }
}
