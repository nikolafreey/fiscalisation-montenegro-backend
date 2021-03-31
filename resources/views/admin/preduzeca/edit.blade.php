@extends('admin.layout')

@section('title', 'Dodavanje Sertifikata')

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Pocetna</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('preduzeca.index') }}">Preduzeca</a>
        </li>
        <li class="breadcrumb-item">
            <span>@yield('title')</span>
        </li>
    </ul>
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-lg-10">
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            @yield('title')
                        </h6>
                        <div class="element-box">
                            <form method="POST" action="{{ route('preduzeca.update', $preduzece) }}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <legend>
                                    <span>Pecat</span>
                                </legend>
                                <div class="custom-file mb-3">
                                    <label for="">Digitalni pecat</label>
                                    <input type="file" name="pecat" class="custom-file-input" id="pecat">
                                    <label class="custom-file-label mt-4" for="pecat">Odaberite pecat</label>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="pecatSifra">Sifra za pecat</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite sifru"
                                        type="password"
                                        id="pecatSifra"
                                        name="pecatSifra"
                                        value="{{ old('pecatSifra') }}"
                                    >
                                </div>
                                <legend>
                                    <span>Sertifikat</span>
                                </legend>
                                <div class="custom-file mb-3">
                                    <label for="sertifikat">Digitalni sertifikat</label>
                                    <input type="file" name="sertifikat" class="custom-file-input" id="sertifikat">
                                    <label class="custom-file-label mt-4" for="sertifikat">Odaberite sertifikat</label>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="sertifikatSifra">Sifra za sertifikat</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite sifru"
                                        type="password"
                                        id="sertifikatSifra"
                                        name="sertifikatSifra"
                                        value="{{ old('sertifikatSifra') }}"
                                    >
                                </div>
                                <div class="form-buttons-w">
                                    <button class="btn btn-primary" type="submit">
                                        Sacuvajte
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
