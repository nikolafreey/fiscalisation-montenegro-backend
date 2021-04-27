@extends('admin.layout')

@section('title') Dodavanje sertifikata preduzeću "{{ $preduzece->kratki_naziv }}" @endsection

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Početna</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('preduzeca.index') }}">Preduzeća</a>
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
                                    <span>Pečat</span>
                                </legend>
                                <div class="custom-file mb-3">
                                    <label for="">Digitalni pečat</label>
                                    <input type="file" name="pecat" class="custom-file-input" id="pecat">
                                    <label class="custom-file-label mt-4" for="pecat">Odaberite pečat</label>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="pecatSifra">Šifra za pečat</label>
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
                                    <label for="sertifikatSifra">Šifra za sertifikat</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite sifru"
                                        type="password"
                                        id="sertifikatSifra"
                                        name="sertifikatSifra"
                                        value="{{ old('sertifikatSifra') }}"
                                    >
                                </div>
                                <legend>
                                    <span>Ostalo</span>
                                </legend>
                                <div class="form-group mt-4">
                                    <label for="pib">PIB</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite PIB"
                                        type="text"
                                        id="pib"
                                        name="pib"
                                        value="{{ $preduzece->pib ?? old('pib') }}"
                                    >
                                </div>
                                <div class="form-group mt-4">
                                    <label for="enu_kod">ENU Kod</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite ENU Kod"
                                        type="text"
                                        id="enu_kod"
                                        name="enu_kod"
                                        value="{{ $preduzece->enu_kod ?? old('enu_kod') }}"
                                    >
                                </div>
                                <div class="form-group mt-4">
                                    <label for="kod_operatera">Kod operatera</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite Kod operatera"
                                        type="text"
                                        id="kod_operatera"
                                        name="kod_operatera"
                                        value="{{ $preduzece->kod_operatera ?? old('kod_operatera') }}"
                                    >
                                </div>
                                @foreach($preduzece->poslovne_jedinice as $poslovnaJedinica)
                                    <legend>
                                        <span>{{ $poslovnaJedinica->kratki_naziv }}</span>
                                    </legend>
                                    <input type="hidden" name="poslovneJedinice[{{$poslovnaJedinica->id}}][id]" value="{{$poslovnaJedinica->id}}"></td>
                                    <div class="form-group">
                                        <label for="kod_poslovne_jedinice">Kod poslovnog prostora</label>
                                        <input
                                            class="form-control"
                                            placeholder="Unesite kod poslovnog prostora"
                                            type="text"
                                            id="kod_poslovne_jedinice"
                                            name="poslovneJedinice[{{$poslovnaJedinica->id}}][kod_poslovnog_prostora]"
                                            value="{{ $poslovnaJedinica->kod_poslovnog_prostora ?? old('kod_poslovnog_prostora') }}"
                                        >
                                    </div>
                                @endforeach
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
