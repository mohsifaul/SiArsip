@extends('layout/app')
@section('title')
    Arsip Surat | SiArsip
@endsection
@section('isiNavbar')
    Arsip Surat
@endsection
@section('isiNavbar2')
    Berikut ini adalah surat yang telah terbit dan diarsipkan. Klik "lihat" pada kolom aksi untuk menampilkan surat.
@endsection
@section('content')
    @include('sweetalert::alert')
    <div class="col-md-12 col-lg-12">
        {{-- <div class="row"> --}}
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Data Surat</h4>      
                    </div>
                    <div>
                        <a href="/tambah-arsip" class="btn btn-primary">Arsipkan Surat</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered" data-toggle="data-table">
                            <thead class="text-dark">
                                <tr>
                                    <th>Nomor Surat </th>
                                    <th>Kategori Surat</th>
                                    <th>Judul</th>
                                    <th>Waktu Pengarsipan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arsip as $item)  
                                <tr>
                                    <td>{{ $item['nomor_surat']}}</td>
                                    <td>
                                        {!! $item->kategoriSurat ? $item->kategoriSurat->nama_kategori : 'Kategori Dihapus' !!}
                                        @if ($item->kategoriSurat && $item->kategoriSurat->trashed())
                                            @unless (\App\Models\KategoriSurat::where('nama_kategori', $item->kategoriSurat->nama_kategori)->where('id', '!=', $item->kategoriSurat->id)->exists())
                                                <br>
                                                <span class="text-danger">(Kategori Telah Terhapus)</span>
                                            @endif
                                        @endif
                                    </td>

                                    <td>{{ $item['judul_surat'] }}</td>
                                    <td>{{ $item['created_at']->format('d F Y H:i:s') }}</td>
                                    <td class="text-center aligns-item-center">
                                        <div class="button-container d-flex justify-content-center align-items-center posting-form">
                                            <a href="/lihat-surat/{{ $item->kd_surat }}" class="btn btn-icon btn-outline-primary btn-md me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Surat">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                            <a href="#" class="btn btn-icon btn-outline-warning btn-md downloadButton me-2" data-id="{{ $item->kd_surat }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Unduh Surat">
                                                <i class="fa-solid fa-file-arrow-down"></i>
                                            </a>
                                            <form action="{{ route('hapus-surat', $item->kd_surat) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-icon btn-outline-danger btn-md deleteButton" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Surat">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.deleteButton');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menghapus?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
            const downloadButtons = document.querySelectorAll('.downloadButton');
            downloadButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const itemId = this.getAttribute('data-id');
                    // Ganti URL sesuai dengan URL yang sesuai untuk mengunduh file_surat
                    const downloadUrl = '/unduh-surat/' + itemId;
                    // Buka URL tanpa membuka tab atau jendela baru
                    window.location.href = downloadUrl;
                });
            });
            // const downloadButtons = document.querySelectorAll('.downloadButton');
            //     downloadButtons.forEach(function(button) {
            //         button.addEventListener('click', function(event) {
            //             event.preventDefault();
            //             const itemId = this.getAttribute('data-id');
            //             const downloadUrl = '/unduh-surat/' + itemId;

            //             // Membuat elemen <a> baru untuk inisiasi unduhan
            //             const downloadLink = document.createElement('a');
            //             downloadLink.href = downloadUrl;
            //             downloadLink.target = '_blank';

            //             // Menambahkan elemen <a> ke dalam dokumen
            //             document.body.appendChild(downloadLink);

            //             // Memulai unduhan dengan membuka URL tanpa membuka tab atau jendela baru
            //             downloadLink.click();

            //             // Menunggu hingga unduhan selesai
            //             downloadLink.addEventListener('load', function() {
            //                 // Menghapus elemen <a> setelah unduhan selesai
            //                 document.body.removeChild(downloadLink);

            //                 // Menampilkan SweetAlert setelah unduhan berhasil
            //                 Swal.fire({
            //                     title: 'Download Berhasil',
            //                     text: 'File berhasil diunduh.',
            //                     icon: 'success',
            //                     confirmButtonColor: '#3085d6',
            //                     confirmButtonText: 'OK'
            //                 });
            //             });
            //         });
            //     });
        });
    </script>
@endsection
