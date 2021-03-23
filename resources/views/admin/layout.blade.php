<!DOCTYPE html>
<html>
<head>
    <title>Racuni</title>
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
    <link href="{{ mix('css/all.css') }}" rel="stylesheet">
</head>
    <body class="menu-position-side menu-side-left full-screen with-content-panel" style="height: 100%;">
<div class="all-wrapper with-side-panel solid-bg-all">
    <div class="layout-w">
        <div class="menu-w selected-menu-color-light menu-has-selected-link menu-activated-on-click color-scheme-light color-style-transparent sub-menu-color-light menu-position-side menu-side-left menu-layout-compact sub-menu-style-inside">
            <div class="logo-w">
                <a class="logo" href="index.html">
                    <div class="logo-element"></div>
                    <div class="logo-label">
                        Racuni
                    </div>
                </a>
            </div>
            <div class="logged-user-w avatar-inline">
                <div class="logged-user-i">
                    <div class="avatar-w">
                        <img alt="" src="{{ asset('admin2/img/avatar.png') }}">
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
                                <img alt="" src="{{ asset('admin2/img/avatar.png') }}">
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
                                    <i class="os-icon os-icon-signs-11"></i> {{ __('Logout') }}
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
                <li class="sub-header">
                    <span>Navigacija</span>
                </li>
                <li class=" has-sub-menu">
                    <a href="{{ route('preduzeca.index') }}">
                        <div class="icon-w">
                            <div class="os-icon os-icon-package"></div>
                        </div>
                        <span>Preduzeca</span></a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-header">
                            Preduzeca
                        </div>
                        <div class="sub-menu-icon">
                            <i class="os-icon os-icon-package"></i>
                        </div>
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('preduzeca.index') }}">Prikazi</a>
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
                                    <a href="{{ route('aktivnosti.index') }}">Prikazi</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @can('edit users')
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
                                        <a href="{{ route('users.index') }}">Prikazi</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                @endcan
                @can('edit users')
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
                                        <a href="{{ route('uloge.index') }}">Prikazi</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('uloge.create') }}">Dodaj ulogu</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                @endcan
                @can('edit users')
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
                                        <a href="{{ route('dozvole.index') }}">Prikazi</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('dozvole.create') }}">Dodaj dozvolu</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                @endcan
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
                                    <a href="{{ route('blogs.index') }}">Prikazi</a>
                                </li>
                                <li>
                                    <a href="{{ route('blogs.create') }}">Dodaj blog</a>
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
                                    <a href="{{ route('blogCategories.index') }}">Prikazi</a>
                                </li>
                                <li>
                                    <a href="{{ route('blogCategories.create') }}">Dodaj kategoriju</a>
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
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="display-type"></div>
</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ mix('js/all.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.js"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.1.0/cropper.js" referrerpolicy="origin"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        @yield('scripts')
    </body>
</html>
