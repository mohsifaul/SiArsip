@extends('layout/app')
@section('title')
    Kategori Surat | SiArsip
@endsection
@section('isiNavbar')
    Kategori Surat
@endsection
@section('isiNavbar2')
    Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat. <br>
    Klik "tambah" pada kolom aksi untuk menambahkan kategori surat.
@endsection
@section('content')
    @include('sweetalert::alert')
    <div class="col-md-12 col-lg-12">
        {{-- <div class="row"> --}}
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Kategori Surat</h4>      
                    </div>
                    <div>
                        <a href="/tambah-kategori-surat" class="btn btn-primary">Tambah Kategori</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered" data-toggle="data-table">
                            <thead class="text-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategoriSurat as $item)
                                    <tr>
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item['nama_kategori'] }}</td>
                                        <td>{{ $item['keterangan'] }}</td>
                                        <td class="text-center aligns-item-center">
                                            <div class="button-container d-flex justify-content-center align-items-center posting-form">
                                                <a href="{{ route('edit-kategori', $item->id) }}" class="btn btn-icon btn-outline-primary btn-md me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa-solid fa-edit"></i></a>
                                                <form action="{{ route('hapus-kategori', $item->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-outline-danger btn-md deleteButton" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
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
        });
    </script>
@endsection
