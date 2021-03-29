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
        <div class="content-box"><div class="row">
                <div class="col-lg-10">
                    <div class="element-wrapper">
                        <div class="element-box">

                            <form method="POST" action="{{ route('dozvole.store') }}" enctype="multipart/form-data">
                                @csrf
                                <h5 class="form-header">
                                    Dodajte Dozvolu
                                </h5>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Unesite ime dozvole</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unesite ime dozvole" name="dozvola">
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
