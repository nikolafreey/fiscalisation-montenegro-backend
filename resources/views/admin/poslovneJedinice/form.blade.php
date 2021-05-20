@extends('admin.layout')

@section('title', $action ? 'Izmjena Poslovne Jedinice' : 'Dodavanje Poslovne Jedinice')

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Početna</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('poslovneJedinice.index') }}">Poslovne Jedinice</a>
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
                            <form
                                method="POST"
                                action="{{ $action ? route('poslovneJedinice.update', $poslovnaJedinica) : route('poslovneJedinice.store') }}"
                                enctype="multipart/form-data"
                            >
                                @method($method)
                                @csrf
                                <div class="form-group">
                                    <label for="kratki_naziv">Naziv</label>
                                    <input type="text" class="form-control" id="kratki_naziv" placeholder="Unesite naziv" name="kratki_naziv" value="{{ old('kratki_naziv', $poslovnaJedinica->kratki_naziv) }}">
                                </div>
                                <div class="form-group">
                                    <label for="adresa">Adresa</label>
                                    <input type="text" class="form-control" id="adresa" placeholder="Unesite adresu" name="adresa"
                                        value="{{ old('adresa', $poslovnaJedinica->adresa) }}">
                                </div>
                                <div class="form-group">
                                    <label for="grad">Grad</label>
                                    <input type="text" class="form-control" id="grad" placeholder="Unesite grad" name="grad" value="{{ old('grad', $poslovnaJedinica->grad) }}">
                                </div>
                                <div class="form-group">
                                    <label for="drzava">Država</label>
                                    <input type="text" class="form-control" id="drzava" placeholder="Unesite državu" name="drzava" value="{{ old('drzava', $poslovnaJedinica->drzava) }}">
                                </div>
                                <div class="form-group">
                                    <label for="kod_poslovnog_prostora">Kod poslovnog prostora</label>
                                    <input type="text" class="form-control" id="kod_poslovnog_prostora" placeholder="Unesite kod poslovnog prostora" name="kod_poslovnog_prostora" value="{{ old('kod_poslovnog_prostora', $poslovnaJedinica->kod_poslovnog_prostora) }}">
                                </div>

                                <div class="form-group">
                                    <label for="preduzece">Preduzece</label>
                                    <select class="preduzece" name="preduzece_id" id="preduzece">
                                        @foreach($preduzeca as $preduzece)
                                            <option
                                                @if(
                                                   $preduzece->id
                                                   ===
                                                   $poslovnaJedinica->preduzece->id
                                               )
                                                selected
                                                @endif
                                                value="{{ $preduzece->id }}"
                                            >
                                                {{ $preduzece->kratki_naziv }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="user">Korisnik</label>
                                    <select class="user" name="user_id" id="user">
                                        @foreach($users as $user)
                                            <option
                                                @if(
                                                  $user->id
                                                  ===
                                                  $poslovnaJedinica->user->id
                                                )
                                                selected
                                                @endif
                                                value="{{ $user->id }}"
                                            >
                                                {{ $user->ime }} {{ $user->prezime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-buttons-w">
                                    <button class="btn btn-primary" type="submit">
                                        {{ $action ? 'Sačuvajte' : 'Dodajte' }}
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
        $('.preduzece').selectize({
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
