@extends('admin.layout')

@section('title', 'Aktivnost')

@section('content')

    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Pocetna</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('aktivnosti.index') }}">Aktivnosti</a>
        </li>
        <li class="breadcrumb-item">
            <span>@yield('title')</span>
        </li>
    </ul>
    <div class="element-box">
        <div class="table-responsive">
            <div class="row">
                <table class="table" style="word-break: break-all; width: 100%;">
                    <thead>
                        <tr>
                            <th>Kolona</th>
                            @if(isset($aktivnost['properties']['old']))
                                <th>Stara vrijednost</th>
                            @endif
                            <th>Nova vrijednost</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($aktivnost['properties']['attributes'] as $column => $value)
                            <tr>
                                <td>{{ $column }}</td>
                                @if(isset($aktivnost['properties']['old']))
                                    <td>{{ $aktivnost['properties']['old'][$column] }}</td>
                                @endif
                                <td
                                    {!!
                                        (isset($aktivnost['properties']['old']) && $aktivnost['properties']['old'][$column] !== $value)
                                        ? "style='color: green; font-weight: 700;'"
                                        : ''
                                    !!}
                                >{{ $value }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
