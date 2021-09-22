@extends('layouts.public-app')

@section('content')

    <!-- Header Area
        ============================================ -->
    @include('includes.top-bar')
    <!-- End Header Area
        ============================================ -->



    <!-- Main Area Start
        ============================================ -->
    <section class="main-content d-flex flex-column justify-content-center" style="margin-top:50px;">
        <div class="container-fluid text-center">

            <form method="POST" action="{{ route('store.subscriber') }}">
            @csrf
                <div class="content-wrap text-center d-flex align-items-center justify-content-center">
                    <div class="content-wrap-single user-data">

                        <div class="segment" style="margin-top:10px;">
                            <h2>Data Identitas Responden</h2>
                        </div>
                        <label>
                            <input type="text" name="name" placeholder="Nama" required/>
                        </label>
                        <label>
                            <select aria-label="Default select example" name="gender" required>
                                <option selected>Pilih Jenis Kelamin</option>
                                @foreach($genders as $key => $gender)
                                <option value="{{ $key }}"> {{ $gender }} </option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <input type="number" name="age" placeholder="Umur" required/>
                        </label>
                        <label>
                            <input type="text" name="telephoneNumber" placeholder="Nomor Telephone " required/>
                        </label>
                        <label>
                            <select aria-label="Default select example" name="education" required>
                                <option selected>Pilih Pendidikan</option>
                                @foreach($educations as $key => $education)
                                <option value="{{ $education }}"> {{ $education }} </option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <select aria-label="Default select example" name="profession" required>
                                <option selected>Pilih Pekerjaan</option>
                                @foreach($professions as $key => $profession)
                                <option value="{{ $profession }}"> {{ $profession }} </option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <select aria-label="Default select example" name="workingArea" required>
                                <option selected>Pilih Kelurahan</option>
                                @foreach($address as $key => $add)
                                <option value="{{ $key }}"> {{ $add }} </option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <select aria-label="Default select example" name="vaccineStatus" required>
                                <option selected> Sudah Vaksin ?</option>
                                @foreach($vaccineStatuses as $key => $vaccineStatus)
                                <option value="{{ $key }}"> {{ $vaccineStatus }} </option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <input type="text" name="diseaseHistory" placeholder="Riwayat Penyakit" required/>
                        </label>
                        <button class="red" type="submit"><i class="icon ion-md-lock"></i> {{ __('front_end.question.user-data.get_result') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Main Area End
        ============================================ -->


@endsection
