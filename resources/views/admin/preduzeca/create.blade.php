@extends('admin.layout')

@section('title', 'Dodavanje preduzeća')

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
                            <form method="POST" action="{{ route('preduzeca.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-4">
                                    <label for="kratki_naziv">Kratki naziv</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite naziv"
                                        type="text"
                                        id="kratki_naziv"
                                        name="kratki_naziv"
                                        value="{{ $preduzece->kratki_naziv ?? old('kratki_naziv') }}"
                                    >
                                </div>
                                <div class="form-group mt-4">
                                    <label for="oblik_preduzeca">Oblik preduzeca</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite oblik preduzeca"
                                        type="text"
                                        id="oblik_preduzeca"
                                        name="oblik_preduzeca"
                                        value="{{ $preduzece->oblik_preduzeca ?? old('oblik_preduzeca') }}"
                                    >
                                </div>
                                <div class="form-group mt-4">
                                    <label for="adresa">Adresa</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite adresu"
                                        type="text"
                                        id="adresa"
                                        name="adresa"
                                        value="{{ $preduzece->adresa ?? old('adresa') }}"
                                    >
                                </div>
                                <div class="form-group mt-4">
                                    <label for="grad">Grad</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite grad"
                                        type="text"
                                        id="grad"
                                        name="grad"
                                        value="{{ $preduzece->grad ?? old('grad') }}"
                                    >
                                </div>
                                <div class="form-group mt-4">
                                    <label for="drzava">Država</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite drzavu"
                                        type="text"
                                        id="drzava"
                                        name="drzava"
                                        value="{{ $preduzece->drzava ?? old('drzava') }}"
                                    >
                                </div>
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
                                    <label for="enu_kod">ENU kod</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite ENU kod"
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
                                        placeholder="Unesite kod operatera"
                                        type="text"
                                        id="kod_operatera"
                                        name="kod_operatera"
                                        value="{{ $preduzece->kod_operatera ?? old('kod_operatera') }}"
                                    >
                                </div>
                                <div class="form-group mt-4">
                                    <label for="pdv">PDV</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite PDV"
                                        type="text"
                                        id="pdv"
                                        name="pdv"
                                        value="{{ $preduzece->pdv ?? old('pdv') }}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="kategorija_id">Kategorija</label>
                                    <select class="selectize" id="kategorija_id" name="kategorija_id">
                                        @foreach($kategorije as $kategorija)
                                            <option value="{{ $kategorija->id }}">
                                                {{ $kategorija->naziv }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="djelatnost_id">Djelatnost</label>
                                    <select class="selectize" id="djelatnost_id" name="djelatnost_id">
                                        @foreach($djelatnosti as $djelatnost)
                                            <option value="{{ $djelatnost->id }}">
                                                {{ $djelatnost->naziv }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="user">Korisnik</label>
                                    <select class="user" name="user_id[]" id="user" multiple>
                                        @foreach($users as $user)
                                            <option
                                                value="{{ $user->id }}"
                                            >
                                                {{ $user->ime }} {{ $user->prezime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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

@section('scripts')

    <script>

        $('.selectize').selectize({
            delimiter: ',',
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            }
        });

        $('.user').selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            }
        });
    </script>

@endsection
