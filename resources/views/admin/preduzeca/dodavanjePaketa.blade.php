@extends('admin.layout')

@section('title') Dodavanje paketa preduzeću "{{ $preduzece->kratki_naziv }}" @endsection

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Početna</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('preduzeca.index') }}">Preduzeca</a>
        </li>
        <li class="breadcrumb-item">
            <span>@yield('title')</span>
        </li>
    </ul>
    <div class="content-i">
        <div class="content-box"><div class="row">
                <div class="col-lg-10">
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            @yield('title')
                        </h6>
                        <div class="element-box">
                            <h2 class="mb-4"></h2>
                            <form
                                method="POST"
                                action="{{ route('updatePaket', $preduzece) }}"
                                enctype="multipart/form-data"
                            >
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="osnovni">Osnovni</label>
                                    <input type="number" class="form-control col-lg-3" id="osnovni" name="osnovni" placeholder="Unesite broj Osnovnih paketa" value="{{ $osnovniCount ?? 0 }}">
                                </div>
                                <div class="form-group">
                                    <label for="start">Start</label>
                                    <input type="number" class="form-control col-lg-3" id="start" name="start" placeholder="Unesite broj Start paketa" value="{{$startCount ?? 0}}">
                                </div>
                                <div class="form-group">
                                    <label for="pro">Pro</label>
                                    <input type="number" class="form-control col-lg-3" id="pro" name="pro" placeholder="Unesite broj Pro paketa" value="{{ $proCount ?? 0 }}">
                                </div>
                                <div class="form-group">
                                    <label for="datepicker">Vazenje paketa do</label>
                                    <input
                                        type="text"
                                        class="form-control col-lg-3 datepicker"
                                        id="datepicker"
                                        name="datum"
                                        value="{{ $preduzece->vazenje_paketa_do }}"
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

    <script type="text/javascript">
        $(".datepicker").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    </script>

@endsection
