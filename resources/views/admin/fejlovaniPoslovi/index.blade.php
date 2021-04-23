@extends('admin.layout')

@section('title', 'Fejlovani poslovi')

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
                    Fejlovani poslovi
                </h6>
                <div class="element-box">
                    <table id="example" class="table table-hover table-clean">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Posao</th>
                            <th>Konekcija</th>
                            <th>Vrijeme</th>
                            <th>Poruka</th>
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
                url: '{{ route('failedJobs.index') }}',
            },
            columns: [
                { data: 'payload' },
                { data: 'job_name' },
                { data: 'connection' },
                { data: 'failed_at' },
                { data: 'exception' },
            ]
        } );
    </script>
@endsection
