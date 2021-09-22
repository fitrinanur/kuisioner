@extends('layouts.public-app')

@section('content')

<!-- Main Area Start
        ============================================ -->
<section class="main-content d-flex flex-column justify-content-center">
    <div class="container-fluid">
        <div class="content-wrap content-wrap-home text-center">
            <div class="home_title">
                <h5>Informed Consent</h5>
                <div class="content" style="text-align:justify">
                    <p>Saya yang bertanda tangan dibawah ini:</p>
                    <table class="table table-borderless">
                        <tr>
                            <td>Nama &nbsp : {{ $name }}</td>
                        <tr>
                        <tr>
                            <td>Umur &nbsp : {{ $age }}</td>
                        <tr>
                        <tr>
                            <td>Jenis Kelamin &nbsp : {{ $gender }}</td>
                        <tr>
                    </table>
                    <p>Setelah mendapat penjelasan secukupnya tentang manfaat dan resiko
                        penelitian yang berjudul “Pengaruh Edukasi Vaksin Covid-19 Secara Audiovisual Terhadap Tingkat
                        Kecemasan Calon Peserta Vaksinasi” menyatakan (bersedia/tidak besedia*) ikut sebagai responden
                        dalam penelitian ini, dengan catatan bila sewaktu-waktu merasa dirugikan dalam bentuk apapun
                        berhak membatalkan persetujuan ini. Saya percaya bahwa informasi yang saya berikan ini dijamin
                        kerahasiaannya.
                    </p>
                    <p>Demikian surat perjanjian ini dibuat agar dapat dipergunakan sebagaimana
                        mestinya.
                    </p>
                    <p>
                    <form method="POST" action="{{ route('informed-consent') }}">
                    @csrf
                    @method('PUT')
                        <input class="form-check-input" type="hidden" value="{{ $name }}" name="name">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked name="informedConsent">

                            <label class="form-check-label" for="flexCheckChecked">
                                <i>Dengan ini saya bersedia dan melanjutkan mengisi kuisioner HRS-A</i>
                            </label>
                        </div>
                    </p>
                </div>
                <div class="content-footer">
                    <p style="text-align:right">Surakarta, {{$date->format('d/m/Y') }}</p>
                    <table class="table table-borderless">
                        <tr>
                            <td>Peneliti</td>
                            <td>Responden</td>
                        <tr>
                        <tr>
                            <td></td>
                            <td></td>
                        <tr>
                        <tr>
                            <td>Leona Miga Karima<br />
                                <p>NIM 205070209111010</p>
                            </td>
                            <td>{{$name}}</td>
                        <tr>
                    </table>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-lg" style="float:right">Lanjutkan</button>
            </div>
        </div>
        </form> 
    </div>
</section>
<!-- Main Area End
        ============================================ -->


@endsection
