@extends('admin.layout')

@section('content')

    <div class="content-i">
        <div class="content-box"><div class="row">
                <div class="col-lg-10">
                    <div class="element-wrapper">
                        <div class="element-box">

                            <form
                                method="POST"
                                action="{{ $action ? route('blogCategories.update', $blogCategory) : route('blogCategories.store')}}"
                                enctype="multipart/form-data"
                            >
                                @method($method)
                                @csrf
                                <h5 class="form-header">
                                    {{ $action ? 'Izmjenite' : 'Dodajte' }} kategoriju bloga
                                </h5>
                                <div class="form-group">
                                    <label for="naziv">Unesite naziv kategorije</label>
                                    <input type="text" class="form-control" id="naziv" aria-describedby="emailHelp" placeholder="Unesite naziv kategorije" name="naziv" value="{{ old('naziv', $blogCategory->naziv) }}">
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
