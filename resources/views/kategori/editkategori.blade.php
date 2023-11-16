@extends('layout/app')

@section('title')
    Edit Kategori Surat | SiArsip
@endsection

@section('isiNavbar')
    Edit Kategori Surat
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
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-12 col-lg-12 pt-1">
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="card-body">
                    <form action="{{ route('update-kategori', $kategori->id) }}" method="post" class="row g-3 needs-validation text-dark" novalidate>
                        @csrf
                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Kode Kategori</label>
                            <input type="text" class="form-control fw-bold text-dark" id="validationCustom01" value="{{ $kategori->id }}" required readonly disabled>
                            <input type="hidden" class="form-control fw-bold text-dark" id="validationCustom01" value="{{ $kategori->id }}" name="idKategori" required>
                        </div>

                        <div class="col-md-10">
                            <label for="validationCustom02" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control text-dark" id="validationCustom02" name="namaKategori" value="{{ $kategori->nama_kategori }}" required>
                            <div class="invalid-feedback">
                                Harap Isi Bidang Ini.    
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Keterangan Kategori</label>
                            <textarea name="keterangan" id="" class="form-control text-dark" cols="10" rows="5">{{ $kategori->keterangan }}</textarea>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-light text-primary fw-bold btn-sm me-2" type="button" onclick="goBack()">Kembali</button>
                            <button class="btn btn-success btn-sm" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        // Form valid, biarkan formulir dikirim secara tradisional
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
