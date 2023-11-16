<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class KategoriSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriSurat = KategoriSurat::all();
        return view('/kategori/kategorisurat', ['kategoriSurat' => $kategoriSurat]);
    }

    public function formTambah()
    {
        $last = KategoriSurat::withTrashed()->orderBy('id', 'desc')->first();
        if ($last) {
        $lastId = intval(substr($last->id, 1));
        } else {
            $lastId = 0;
        }
        $formattedId = 'K' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        // Kirimkan nilai $formattedId ke tampilan
        return view('/kategori/tambahkategori', ['formattedId' => $formattedId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idKategori' => 'required|unique:kategorisurat,id',
            'namaKategori' => 'required',
            'keterangan' => 'nullable',
        ], [
            'idKategori.required' => 'Kode Kategori harus di isi.',
            'idKategori.unique' => 'Kode Kategori sudah digunakan.',
            'namaKategori.required' => 'Nama Kategori harus di isi.',
        ]);
        // dd($request->all());
        // Buat instansiasi objek KategoriSurat dengan data input
        $kategoriSurat = new KategoriSurat();
        $kategoriSurat->id = $request->idKategori;
        $kategoriSurat->nama_kategori = $request->namaKategori;
        $kategoriSurat->keterangan = $request->keterangan ? : '-';
        
        // Simpan kategoriSurat ke database
        $kategoriSurat->save();

        // Redirect atau berikan respon sesuai kebutuhan
        toast('Kategori Surat berhasil ditambahkan.', 'success');
        return redirect('/kategori-surat');
    }


    /**
     * Display the specified resource.
     */
    public function show(KategoriSurat $kategoriSurat)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil data kategori berdasarkan ID
        $kategori = KategoriSurat::findOrFail($id);

        // Kirim data ke tampilan editkategori
        return view('/kategori/editkategori', compact('kategori'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'namaKategori' => 'required',
            'keterangan' => 'nullable',
        ], [
            'namaKategori.required' => 'Nama Kategori harus di isi.',
        ]);

        // Cek apakah kategori dengan ID yang diberikan ada
        $kategori = KategoriSurat::find($id);

        if (!$kategori) {
            // Kategori tidak ditemukan, handle sesuai kebutuhan (redirect, error, dll.)
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }

        // Check for uniqueness manually
        $existingCategory = KategoriSurat::where('nama_kategori', $request->namaKategori)
            ->where('id', '!=', $id) // Exclude the current record being updated
            ->whereNull('deleted_at') // Consider only non-deleted records
            ->first();

        if ($existingCategory) {
            return redirect()->back()->with('error', 'Nama Kategori sudah digunakan.');
        }

        // Update data kategori
        $kategori->nama_kategori = $request->namaKategori;
        $kategori->keterangan = $request->keterangan ?? '-';

        // Simpan perubahan
        $kategori->save();

        // Redirect atau berikan respon sesuai kebutuhan
        toast('Kategori Surat berhasil diubah.', 'success');
        return redirect('/kategori-surat');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = KategoriSurat::find($id);

        if ($kategori) {
            $kategori->delete();

            toast('Kategori Surat berhasil dihapus', 'success');
            return redirect('/kategori-surat');
        } else {
            toast('Data kategori tidak ditemukan', 'error');
            return redirect('/kategori-surat');
        }
    }
}
