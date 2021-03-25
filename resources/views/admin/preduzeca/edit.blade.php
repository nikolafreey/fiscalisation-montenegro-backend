@extends('admin.layout')

@section('content')

    <div class="content-i">
        <div class="content-box"><div class="row">
                <div class="col-lg-10">
                    <div class="element-wrapper">
                        <div class="element-box">

                            <form method="POST" action="{{ route('preduzeca.update', $preduzece) }}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <h5 class="form-header">
                                    Sertifikati
                                </h5>
                                <div class="custom-file mb-3 mt-4">
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
                                <div class="custom-file mb-3 mt-3">
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
