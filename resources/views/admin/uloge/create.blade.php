@extends('admin.layout')

@section('content')

    <div class="content-i">
        <div class="content-box"><div class="row">
                <div class="col-lg-10">
                    <div class="element-wrapper">
                        <div class="element-box">

                            <form method="POST" action="{{ route('uloge.store') }}" enctype="multipart/form-data">
                                @csrf
                                <h5 class="form-header">
                                    Dodajte Ulogu
                                </h5>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Unesite ime uloge</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unesite ime dozvole" name="uloga">
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
