@extends('admin.layout')

@section('title', 'Ulogovani korisnici')

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
                    Ulogovani korisnici
                </h6>
                <div class="element-box">
                    <table id="example" class="table table-hover table-clean">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Ime</th>
                            <th>E-mail</th>
                            <th>Preduzece</th>
                            <th>Poslovna Jedinica</th>
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
                url: '{{ route('ulogovaniKorisnici.index') }}',
            },
            columns: [
                { data: 'id', name:'id'},
                { data: 'user.ime', name:'user.ime'},
                { data: 'user.email', name:'user.email'},
                {
                    data: 'preduzece.kratki_naziv',
                    name: 'preduzece.kratki_naziv',
                    orderable: false,
                    defaultContent: "<i>Nije odabrano</i>"
                },
                {
                    data: 'poslovna_jedinica.kratki_naziv',
                    name: 'poslovna_jedinica.kratki_naziv',
                    orderable: false,
                    defaultContent: "<i>Nije odabrana</i>"
                },
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
