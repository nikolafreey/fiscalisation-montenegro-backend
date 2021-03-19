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
                                    <label for="input-tags">Odaberite dozvole</label>
                                    <select class="form-control" id="input-tags" name="dozvola[]" multiple>
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


