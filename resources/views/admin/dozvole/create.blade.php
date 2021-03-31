@extends('admin.layout')

@section('title', 'Dodavanje Dozvole')

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Pocetna</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('dozvole.index') }}">Dozvole</a>
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

                            <form method="POST" action="{{ route('dozvole.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Unesite ime</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unesite ime" name="dozvola">
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
