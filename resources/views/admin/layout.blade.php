<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('admin/favicon.png') }}" rel="shortcut icon">
    <link href="{{ asset('admin/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.1.0/cropper.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="{{ mix('css/all.css') }}" rel="stylesheet">
    <style>
        .table-clean > tbody > tr > :first-child {
            padding-left: 12px;
        }

        .table-clean > tbody > tr > :last-child {
            padding-right: 12px;
        }
    </style>
</head>
<body class="full-screen with-content-panel menu-position-side menu-side-left" style="height: 100%;">
    <div class="all-wrapper with-side-panel solid-bg-all">
        <div class="layout-w" style="min-height: 100vh;">
            <div class="menu-w selected-menu-color-light menu-has-selected-link menu-activated-on-click color-scheme-light color-style-default sub-menu-color-light menu-position-side menu-side-left menu-layout-compact sub-menu-style-inside">
                <div class="logo-w">
                    <a class="logo" href="#">
                        <div class="logo-element"></div>
                        <div class="logo-label">
                            Računi
                        </div>
                    </a>
                </div>
                <div class="logged-user-w avatar-inline">
                    <div class="logged-user-i">
                        <div class="avatar-w">
                            <img alt="" src="{{ asset('admin2/img/avatar.jpg') }}">
                        </div>
                        <div class="logged-user-info-w">
                            <div class="logged-user-name">
                                {{ auth()->user()->ime }}
                            </div>
                            <div class="logged-user-role">
                                {{ auth()->user()->roles()->first()->name }}
                            </div>
                        </div>
                        <div class="logged-user-toggler-arrow">
                            <div class="os-icon os-icon-chevron-down"></div>
                        </div>
                        <div class="logged-user-menu color-style-bright">
                            <div class="logged-user-avatar-info">
                                <div class="avatar-w">
                                    <img alt="" src="{{ asset('admin2/img/avatar.jpg') }}">
                                </div>
                                <div class="logged-user-info-w">
                                    <div class="logged-user-name">
                                        {{ auth()->user()->ime }}
                                    </div>
                                    <div class="logged-user-role">
                                        {{ auth()->user()->roles()->first()->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-icon">
                                <i class="os-icon os-icon-wallet-loaded"></i>
                            </div>
                            <ul>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        <i class="os-icon os-icon-signs-11"></i> {{ __('Odjava') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <h1 class="menu-page-header">
                    Page Header
                </h1>
                <ul class="main-menu">
                    <li class=" has-sub-menu">
                        <a href="{{ route('preduzeca.index') }}">
                            <div class="icon-w">
                                <div class="os-icon os-icon-package"></div>
                            </div>
                            <span>Preduzeća</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">
                                Preduzeća
                            </div>
                            <div class="sub-menu-icon">
                                <i class="os-icon os-icon-package"></i>
                            </div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('preduzeca.index') }}">Prikaži</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class=" has-sub-menu">
                        <a href="{{ route('aktivnosti.index') }}">
                            <div class="icon-w">
                                <div class="os-icon os-icon-life-buoy"></div>
                            </div>
                            <span>Aktivnosti</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">
                                Aktivnosti
                            </div>
                            <div class="sub-menu-icon">
                                <i class="os-icon os-icon-file-text"></i>
                            </div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('aktivnosti.index') }}">Prikaži</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class=" has-sub-menu">
                        <a href="{{ route('users.index') }}">
                            <div class="icon-w">
                                <div class="os-icon os-icon-users"></div>
                            </div>
                            <span>Korisnici</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">
                                Korisnici
                            </div>
                            <div class="sub-menu-icon">
                                <i class="os-icon os-icon-life-buoy"></i>
                            </div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('users.index') }}">Prikaži</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.create') }}">Dodajte korisnika</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class=" has-sub-menu">
                        <a href="{{ route('uloge.index') }}">
                            <div class="icon-w">
                                <div class="os-icon os-icon-edit-32"></div>
                            </div>
                            <span>Uloge</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">
                                Uloge
                            </div>
                            <div class="sub-menu-icon">
                                <i class="os-icon os-icon-life-buoy"></i>
                            </div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('uloge.index') }}">Prikaži</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('uloge.create') }}">Dodajte ulogu</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class=" has-sub-menu">
                        <a href="{{ route('dozvole.index') }}">
                            <div class="icon-w">
                                <div class="os-icon os-icon-grid"></div>
                            </div>
                            <span>Dozvole</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">
                                Dozvole
                            </div>
                            <div class="sub-menu-icon">
                                <i class="os-icon os-icon-life-buoy"></i>
                            </div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('dozvole.index') }}">Prikaži</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('dozvole.create') }}">Dodajte dozvolu</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class=" has-sub-menu">
                        <a href="{{ route('blogs.index') }}">
                            <div class="icon-w">
                                <div class="os-icon os-icon-file-text"></div>
                            </div>
                            <span>Blogovi</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">
                                Blogovi
                            </div>
                            <div class="sub-menu-icon">
                                <i class="os-icon os-icon-file-text"></i>
                            </div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('blogs.index') }}">Prikaži</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blogs.create') }}">Dodajte blog</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class=" has-sub-menu">
                        <a href="{{ route('blogCategories.index') }}">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div>
                            <span>Kategorije blogova</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">
                                Kategorije blogova
                            </div>
                            <div class="sub-menu-icon">
                                <i class="os-icon os-icon-layers"></i>
                            </div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('blogCategories.index') }}">Prikaži</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blogCategories.create') }}">Dodajte kategoriju</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class=" has-sub-menu">
                        <a href="{{ route('ulogovaniKorisnici.index') }}">
                            <div class="icon-w">
                                <div class="os-icon os-icon-users"></div>
                            </div>
                            <span>Ulogovani korisnici</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">
                                Ulogovani korisnici
                            </div>
                            <div class="sub-menu-icon">
                                <i class="os-icon os-icon-life-buoy"></i>
                            </div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('ulogovaniKorisnici.index') }}">Prikaži</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class=" has-sub-menu">
                        <a href="{{ route('failedJobs.index') }}">
                            <div class="icon-w">
                                <div class="os-icon os-icon-zap"></div>
                            </div>
                            <span>Fejlovani poslovi</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">
                                Fejlovani poslovi
                            </div>
                            <div class="sub-menu-icon">
                                <i class="os-icon os-icon-life-buoy"></i>
                            </div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('failedJobs.index') }}">Prikaži</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="content-w">
                <div class="content-i">
                    <div class="content-box">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div class="display-type"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ mix('js/all.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.1.0/cropper.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let language = {
            "emptyTable": "Nema podataka u tabeli",
                "info": "Prikaz _START_ do _END_ od ukupno _TOTAL_ zapisa",
                "infoEmpty": "Prikaz 0 do 0 od ukupno 0 zapisa",
                "infoFiltered": "(filtrirano od ukupno _MAX_ zapisa)",
                "infoThousands": ".",
                "lengthMenu": "Prikaži _MENU_ zapisa",
                "loadingRecords": "Učitavanje...",
                "processing": "Obrada...",
                "search": "",
                "searchPlaceholder": "Pretraga...",
                "zeroRecords": "Nisu pronađeni odgovarajući zapisi",
                "paginate": {
                "first": "Početna",
                    "last": "Poslednja",
                    "next": "Sledeća",
                    "previous": "Prethodna"
            },
            "aria": {
                "sortAscending": ": aktivirajte da sortirate kolonu uzlazno",
                    "sortDescending": ": aktivirajte da sortirate kolonu silazno"
            }
        }
    </script>

    @include('admin.toastr')

    @yield('scripts')
</body>
</html>
