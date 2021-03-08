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
                                <div class="form-group">
                                    <label for="pecat">Pecat</label>
                                    <input
                                        class="form-control"
                                        placeholder="Enter pecat"
                                        type="file"
                                        id="pecat"
                                        name="pecat"
                                        value="{{ old('pecat') }}"
                                        required
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="sertifikat">Sertifikat</label>
                                    <input
                                        class="form-control"
                                        placeholder="Enter sertifikat"
                                        type="file"
                                        id="sertifikat"
                                        name="sertifikat"
                                        value="{{ old('sertifikat') }}"
                                        required
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="sifra">Sifra</label>
                                    <input
                                        class="form-control"
                                        placeholder="Enter sifra"
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
