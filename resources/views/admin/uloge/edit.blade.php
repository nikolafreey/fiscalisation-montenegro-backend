@extends('admin.layout')

@section('content')

    <div class="content-i">
        <div class="content-box"><div class="row">
                <div class="col-lg-10">
                    <div class="element-wrapper">
                        <div class="element-box">

                            <form method="POST" action="{{ route('dodajDozvolu', $role) }}" enctype="multipart/form-data">
                                @csrf
                                <h5 class="form-header">
                                    Dodajte dozvole
                                </h5>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Example select</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="dozvola[]" multiple>
                                        @foreach($dozvole as $dozvola)
                                            <option value="{{ $dozvola->name }}">{{ $dozvola->name }}</option>
                                        @endforeach
                                    </select>
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
