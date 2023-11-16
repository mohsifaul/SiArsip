@extends('layout/app')
@section('title')
    Profil | SiArsip
@endsection
@section('isiNavbar')
    Profil
@endsection
@section('isiNavbar2')
    Berikut ini adalah profil singkat dari pembuat aplikasi SiArsip.
@endsection
@section('content')
    <div class="col-md-12 col-lg-12">
        {{-- <div class="row"> --}}
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 col-sm-4">
                            <img src="{{asset('assets/images/profil.JPG')}}" alt="" style="width: 165px; height: auto;border-radius : 10px">
                        </div>
                        <div class="col-md-5 col-sm-6 ms-2">
                            <h5>Aplikasi ini dibuat oleh :</h5>
                            <table class="text-dark mt-3">
                                <tr>
                                    <td class="fw-bold">Nama</td>
                                    <td>:</td>
                                    <td>Moh. Sifaul Khoir</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Program Studi</td>
                                    <td>:</td>
                                    <td>Manajemen Informatika</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">NIM</td>
                                    <td>:</td>
                                    <td>2131730052</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Tanggal Pembuatan</td>
                                    <td>:</td>
                                    <td>08 November 2023</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
