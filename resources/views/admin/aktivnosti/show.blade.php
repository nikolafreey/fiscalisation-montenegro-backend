@extends('admin.layout')

@section('content')
    <table class="table">
        <thead>
        <tr class="table-primary">
            <th scope="col">#</th>
            <th scope="col">Stari podaci</th>
            <th scope="col">Novi podaci</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Pecat</th>
            <td>{{ $aktivnost['properties']['old']['pecat'] }}</td>
            <td>{{ $aktivnost['properties']['attributes']['pecat'] }}</td>
        </tr>
        <tr>
            <th scope="row">Sertifikat</th>
            <td>{{ $aktivnost['properties']['old']['sertifikat'] }}</td>
            <td>{{ $aktivnost['properties']['attributes']['pecat'] }}</td>
        </tr>
        </tbody>
    </table>

@endsection
