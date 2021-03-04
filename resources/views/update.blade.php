<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Preduzeca</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>{{ $preduzece->kratki_naziv }}</h1>
        <form method="POST" action="{{ route('preduzeca.update', $preduzece) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="pecat">Pecat</label>
                <input name="pecat" type="file" class="form-control" id="pecat" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="sertifikat">Sertifikat</label>
                <input name="sertifikat" type="file" class="form-control" id="sertifikat" aria-describedby="emailHelp">
            </div>
            <div class="form-group mb-2">
                <label for="sifra">Sifra</label>
                <input name="sifra" type="password" class="form-control" id="sifra">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
