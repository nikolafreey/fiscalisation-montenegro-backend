@extends('admin.layout')

@section('title', $action ? 'Izmjena Korisnika' : 'Dodavanje Korisnika')

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Početna</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('users.index') }}">Korisnici</a>
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
                                action="{{ $action ? route('users.update', $user) : route('users.store') }}"
                                enctype="multipart/form-data"
                            >
                                @method($method)
                                @csrf
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" placeholder="E-mail..." name="email" value="{{ old('email', $user->email) }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password..." name="password" value="{{ old('password', $user->password) }}">
                                </div>
                                <div class="form-group">
                                    <label for="ime">Ime</label>
                                    <input type="text" class="form-control" id="ime" placeholder="Ime..." name="ime"
                                    value="{{ old('ime', $user->ime) }}">
                                </div>
                                <div class="form-group">
                                    <label for="prezime">Prezime</label>
                                    <input type="text" class="form-control" id="prezime" placeholder="Prezime..." name="prezime" value="{{ old('prezime', $user->prezime) }}">
                                </div>
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" class="form-control-file" id="avatar" name="avatar">
                                </div>
                                <div class="form-group">
                                    <label for="uloga">Uloga</label>
                                    <select class="selectize" id="uloga" name="uloga">
                                        @foreach($roles as $role)
                                            <option
                                                @if(in_array(
                                                    $role->name,
                                                    $user->roles->pluck('name')->toArray(),
                                                    true
                                                ))
                                                    selected
                                                @endif
                                                value="{{ $role->name }}"
                                            >
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="preduzece">Preduzece</label>
                                    <select class="preduzece" name="preduzeca[]" id="preduzece" multiple>
                                        @foreach($preduzeca as $preduzece)
                                            <option
                                                @if(in_array(
                                                   $preduzece->id,
                                                   $user->preduzeca->pluck('id')->toArray(),
                                                   true
                                               ))
                                                selected
                                                @endif
                                                value="{{ $preduzece->id }}"
                                            >
                                                {{ $preduzece->kratki_naziv }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="defaultCheck1"
                                        {{ 'checked' ? true : false }}
                                        name="check"
                                    >
                                    <label class="form-check-label" for="defaultCheck1">
                                        Posalji lozinku na mail
                                    </label>
                                </div>
                                <div class="form-buttons-w">
                                    <button class="btn btn-primary" type="submit">
                                        {{ $action ? 'Sacuvajte' : 'Dodajte' }}
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

    </script>

@endsection
