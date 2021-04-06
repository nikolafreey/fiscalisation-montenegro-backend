@extends('admin.layout')

@section('title', 'Dodavanje paketa')

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
                            <form
                                method="POST"
                                action="{{ route('updatePaket', $preduzece) }}"
                                enctype="multipart/form-data"
                            >
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="paket">Paket</label>
                                    <select class="selectize mt-2" id="paket" name="paket[]" multiple>
                                        @foreach($paketi as $paket)
                                            <option
                                                @if(in_array(
                                                    $paket->id,
                                                    $preduzece->paketi->pluck('id')->toArray(),
                                                    true
                                                ))
                                                selected
                                                @endif
                                                value="{{ $paket->id }}"
                                            >
                                                {{ $paket->naziv }}
                                            </option>
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

@section('scripts')

    <script>
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
