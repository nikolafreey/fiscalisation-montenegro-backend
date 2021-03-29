@extends('admin.layout')

@section('title', 'Izmjena Uloge')

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Pocetna</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('users.index') }}">Korisnici</a>
        </li>
        <li class="breadcrumb-item">
            <span>@yield('title')</span>
        </li>
    </ul>
    <div class="content-i">
        <div class="content-box"><div class="row">
                <div class="col-lg-10">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form
                                method="POST"
                                action="{{ route('updateUlogu', $user) }}"
                                enctype="multipart/form-data"
                            >
                                @method('put')
                                @csrf
                                <h5 class="form-header">
                                    Izmjenite ulogu
                                </h5>
                                <div class="form-group">
                                    <label for="uloga">Uloga</label>
                                    <select class="form-control" id="uloga" name="uloga">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
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
