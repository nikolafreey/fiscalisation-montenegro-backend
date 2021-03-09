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
                                    Dodajte Pecat
                                </h5>
                                <div class="custom-file mb-3 mt-4">
                                    <input type="file" name="pecat" class="custom-file-input" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Odaberite pecat</label>
                                </div>
                                <div class="custom-file mb-3">
                                    <input type="file" name="sertifikat" class="custom-file-input" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Odaberite sertifikat</label>
                                </div>
                                <div class="form-group">
                                    <label for="sifra">Sifra</label>
                                    <input
                                        class="form-control"
                                        placeholder="Unesite sifru"
                                        type="password"
                                        id="sifra"
                                        name="sifra"
                                        value="{{ old('sifra') }}"
                                        required
                                    >
                                </div>
                                <div class="form-buttons-w">
                                    <button class="btn btn-primary" type="submit">
                                        Dodajte
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
