@extends('admin.layout')

@section('content')

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Preduzeca
                </h6>
                <div class="element-box">
                    <table id="example" class="display">
                        <thead>
                        <tr>
                            <th>Naziv</th>
                            <th>Adresa</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="floated-colors-btn floated-btn">
                <div class="os-toggler-w">
                    <div class="os-toggler-i">
                        <div class="os-toggler-pill"></div>
                    </div>
                </div>
                <span>Dark </span><span>Colors</span>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#example').DataTable( {
            ajax: {
                url: '{{ route('preduzeca.index') }}',
            },
            columns: [
                { data: 'kratki_naziv' },
                { data: 'adresa' },
                {
                    data: 'action',
                    class: 'text-right',
                    orderable: false,
                    searchable: false,
                }
            ]
        } );
    </script>
@endsection
