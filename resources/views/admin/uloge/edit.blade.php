@extends('admin.layout')

@section('title', 'Izmjena Uloge')

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Početna</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('uloge.index') }}">Uloge</a>
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
                            <form method="POST" action="{{ route('dodajDozvolu', $role) }}" enctype="multipart/form-data">
                                @csrf
                                <label for="input-tags">Odaberite dozvole</label>
                                <select id="input-tags" name="dozvola[]" multiple>
                                    @foreach($dozvole as $dozvola)
                                        <option
                                            @if(in_array(
                                                $dozvola->name,
                                                $role->permissions->pluck('name')->toArray(),
                                                true
                                                ))
                                            selected
                                            @endif
                                            value="{{ $dozvola->name }}"
                                        >
                                            {{ $dozvola->name }}
                                        </option>
                                    @endforeach
                                </select>
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

@section('scripts')

    <script>
        $('#input-tags').selectize({
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
    </script>

@endsection


