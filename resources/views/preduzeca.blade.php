<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Preduzeca</title>
</head>
<body>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Naziv preduzeca</th>
                <th scope="col">Adresa preduzeca</th>
                <th scope="col">Akcija</th>
            </tr>
            </thead>
            <tbody>
            @foreach($preduzeca as $preduzece)
                <tr>
                    <th scope="row">{{ $preduzece->id  }}</th>
                    <td>{{ $preduzece->kratki_naziv }}</td>
                    <td>{{ $preduzece->adresa }}</td>
{{--                    @if (! Auth::user()->can('update', $preduzece))--}}
                        <td><a href="{{ route('preduzece.edit', $preduzece) }}"><button type="button" class="btn btn-primary">Add signature</button></a></td>
{{--                    @endif--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
