@extends('admin.layout')

@section('title', $action ? 'Izmjena Kategorije Bloga' : 'Dodavanje Kategorije Bloga')


@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Pocetna</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('blogCategories.index') }}">Kategorije Blogova</a>
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
                                action="{{ $action ? route('blogCategories.update', $blogCategory) : route('blogCategories.store')}}"
                                enctype="multipart/form-data"
                            >
                                @method($method)
                                @csrf
                                <div class="form-group">
                                    <label for="naziv">Unesite naziv</label>
                                    <input type="text" class="form-control" id="naziv" aria-describedby="emailHelp" placeholder="Unesite naziv" name="naziv" value="{{ old('naziv', $blogCategory->naziv) }}">
                                    @error('naziv')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
