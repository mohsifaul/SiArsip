@extends('layout/app')
@section('title')
    Tambah Kategori Surat | SiArsip
@endsection
@section('isiNavbar')
    Tambah Kategori Surat
@endsection
@section('content')
    @if ($errors->any())
        <script>
            Swal.fire({
                title: "Error",
                text: "Data Invalid!",
                icon: "error",
                button: "OK"
            });
        </script>
        <div class="alert alert-left alert-danger alert-dismissible fade show mb-3" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-12 col-lg-12 pt-1">
        {{-- <div class="row"> --}}
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="card-body">
                    <form action="{{ route('simpan-kategori') }}" enctype="multipart/form-data" method="post" class="row g-3 needs-validation text-dark" novalidate>
                        @csrf
                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Kode Kategori</label>
                            <input type="text" class="form-control fw-bold text-dark" id="validationCustom01" value="{{ $formattedId }}" required readonly disabled novalidate>
                            <input type="hidden" class="form-control fw-bold text-dark" id="validationCustom01" value="{{ $formattedId }}" name="idKategori" required novalidate>
                        </div>
                        <div class="col-md-10">
                            <label for="validationCustom02" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control text-dark" id="validationCustom02" name="namaKategori" required>
                            <div class="invalid-feedback">
                                Harap Isi Bidang Ini.    
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Keterangan Kategori </label>
                            <textarea name="keterangan" id="" class="form-control text-dark" cols="10" rows="5" novalidate></textarea>
                            <span class="text-danger text-xs"> * Boleh Kosong</span>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-light text-primary fw-bold btn-sm me-2" type="button" onclick="goBack()">Kembali</button>
                            <button class="btn btn-success btn-sm" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        form.submit();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
        function goBack() {
            window.location.href = '/kategori-surat';
        }
    </script>
@endsection