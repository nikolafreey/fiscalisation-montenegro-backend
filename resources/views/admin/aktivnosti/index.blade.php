@extends('admin.layout')

@section('content')

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Aktivnosti
                </h6>
                <div class="element-box">
                    <table id="example" class="table">
                        <thead>
                            <tr>
                                <th>Opis</th>
                                <th>Vrijeme</th>
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
                url: '{{ route('aktivnosti.index') }}',
            },
            columns: [
                { data: 'description' },
                { data: 'created_at' },
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
