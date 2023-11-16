@extends('layout/app')
@section('title')
    Lihat Arsip Surat | SiArsip
@endsection
@section('isiNavbar')
    Lihat Arsip Surat
@endsection
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="flex-wrap card-header">
                    <div class="header-title d-flex justify-content-between">
                        <h4 class="card-title fw-bold">{{ $surat['judul_surat'] }}</h4>
                    </div>
                    <span class="badge bg-light text-primary fw-bold">{{ $surat->kategoriSurat->nama_kategori }}</span>
                    <table class="text-dark">
                        <tr>
                            <td>Nomor Surat</td>
                            <td>:</td>
                            <td>{{ $surat['nomor_surat'] }}</td>
                        </tr>
                        <tr>
                            <td>Waktu Unggah</td>
                            <td>:</td>
                            <td>{{ $surat['created_at']->format('d F Y H:i:s') }}</td>
                        </tr>
                        @if ($surat['updated_at'] != null)
                            <tr>
                                <td>Diperbarui</td>
                                <td>:</td>
                                <td>{{ $surat['updated_at']->format('d F Y H:i:s') }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="card-body">
                    @if ($surat['file_surat'] && $surat['file_surat'] != '-')
                        <iframe src="/File Arsip/{{ $surat['file_surat'] }}" frameborder="0" width="100%" height="650px"></iframe>
                        <button type="submit" class="btn btn-sm btn-primary mt-3" onclick="goBack()"><i class="fas fa-arrow-left"></i> | Kembali</button>
                        <a href="{{ route('edit-arsip',$surat->kd_surat) }}" class="btn btn-sm btn-warning mt-3"><i class="fa fa-edit"></i> | Edit File Surat</a>
                        <button type="submit" class="btn btn-sm btn-success mt-3 downloadButton" data-id="{{ $surat->kd_surat }}"><i class="fa-solid fa-file-arrow-down"></i> | Unduh</button>
                    @else
                        <p>Tidak ada dokumen untuk surat ini.</p>
                        <button type="submit" class="btn btn-sm btn-primary mt-3" onclick="goBack()"><i class="fas fa-arrow-left"></i> | Kembali</button>
                        <a href="{{ route('edit-arsip',$surat->kd_surat) }}" class="btn btn-sm btn-warning mt-3"><i class="fa fa-edit"></i> | Unggah File Surat</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.location.href = '/arsip-surat';
        }
        document.addEventListener('DOMContentLoaded', function() {
            const downloadButtons = document.querySelectorAll('.downloadButton');
            downloadButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const itemId = this.getAttribute('data-id');
                    // Ganti URL sesuai dengan URL yang sesuai untuk mengunduh file_surat
                    const downloadUrl = '/unduh-surat/' + itemId;
                    // Buka URL dalam tab baru atau jendela
                    window.open(downloadUrl, '_blank');
                });
            });
        });
    </script>
@endsection
