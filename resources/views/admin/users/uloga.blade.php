@extends('admin.layout')

@section('title', 'Izmjena Uloge')

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
        <div class="content-box"><div class="row">
                <div class="col-lg-10">
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            @yield('title')
                        </h6>
                        <div class="element-box">
                            <form
                                method="POST"
                                action="{{ route('updateUlogu', $user) }}"
                                enctype="multipart/form-data"
                            >
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="uloga">Uloga</label>
                                    <select class="selectize mt-2" id="uloga" name="uloga">
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
