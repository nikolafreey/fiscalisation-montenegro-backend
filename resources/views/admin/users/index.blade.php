@extends('admin.layout')

@section('title', 'Korisnici')

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
                    Korisnici
                </h6>
                <div class="element-box">
                    <table id="example" class="table table-hover table-clean">
                        <thead>
                            <tr>
                                <th>Ime</th>
                                <th>E-mail</th>
                                <th>Uloga</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#example').DataTable( {
            language: language,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            deferRender: true,
            stateSave: true,
            stateDuration: 60 * 60 * 24 * 30,

            ajax: {
                url: '{{ route('users.index') }}',
            },
            columns: [
                { data: 'ime' },
                { data: 'email' },
                { data: 'roles', name: 'roles.name'},
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
