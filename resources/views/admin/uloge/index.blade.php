@extends('admin.layout')

@section('content')

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Uloge
                </h6>
                <div class="element-box">
                    <table id="example" class="table">
                        <thead>
                        <tr>
                            <th>Naziv</th>
                            <th>Dozvole</th>
                            <th>Akcija</th>
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
                url: '{{ route('uloge.index') }}',
            },
            columns: [
                { data: 'name' },
                { data: 'permissions[].name' },
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
