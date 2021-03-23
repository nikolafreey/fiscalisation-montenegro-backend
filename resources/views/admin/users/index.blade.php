@extends('admin.layout')

@section('content')

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Korisnici
                </h6>
                <div class="element-box">
                    <table id="example" class="table">
                        <thead>
                            <tr>
                                <th>Ime</th>
                                <th>E-mail</th>
                                <th>Uloga</th>
                                <th>Action</th>
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
            ajax: {
                url: '{{ route('users.index') }}',
            },
            columns: [
                { data: 'ime' },
                { data: 'email' },
                { data: 'roles[].name' },
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
