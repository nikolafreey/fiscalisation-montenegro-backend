@extends('admin.layout')

@section('title', 'Preduzeća')

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Početna</a>
        </li>
        <li class="breadcrumb-item">
            <span>@yield('title')</span>
        </li>
    </ul>
    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Preduzeća
                </h6>
                <div class="element-box">
                    <table id="data_table" class="table table-hover table-clean">
                        <thead>
                        <tr>
                            <th>Naziv</th>
                            <th>Adresa</th>
                            <th>Paketi</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#data_table').DataTable( {
            language: language,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            deferRender: true,
            stateSave: true,
            stateDuration: 60 * 60 * 24 * 30,

            ajax: {
                url: '{{ route('preduzeca.index') }}',
            },
            columns: [
                { data: 'kratki_naziv' },
                { data: 'adresa' },
                { data: 'paketi[, ].naziv', name:'paketi.naziv', orderable: false},
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
