<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - {{config('app.name', 'Simple Task Report')}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;600;700&family=Material+Icons+Outlined&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap5.min.css" rel="stylesheet">
    @yield('pagestyle')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>
<body class="d-flex flex-column min-vh-100">
    <header class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <div class="container-fluid px-0">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center" href="#">{{config('app.name', 'Simple Task Report')}}</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav px-3 usermenu">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item {{active('editpass')}}" href="{{route('editpass')}}">Change Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Sign out</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{active('home')}}" aria-current="page" href="{{route('home')}}">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{active(['task.index', 'task.*'])}}" aria-current="page" href="{{route('task.index')}}">
                                <span data-feather="clipboard"></span>
                                Task
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{active(['taskrequest.index', 'taskrequest.*'])}}" aria-current="page" href="{{route('taskrequest.index')}}">
                                <span data-feather="help-circle"></span>
                                Task Request
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{active('calendar')}}" aria-current="page" href="{{route('calendar')}}">
                                <span data-feather="calendar"></span>
                                Calendar
                            </a>
                        </li>
                        @if (Auth::user()->role == 'superadmin')
                            <li class="nav-item">
                                <a class="nav-link {{active(['user.index', 'user.*'])}}" aria-current="page" href="{{route('user.index')}}">
                                    <span data-feather="users"></span>
                                    Users
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @if (session('message'))
                    <div class="alert alert-secondary mt-3 alert-dismissible fade show" role="alert">
                        {{session('message')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>@yield('title')</h2>
                </div>
                @yield('content')
            </main>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-end">
            <span class="text-muted">Copyright {{date('Y')}} <a href="https://sofiullah.my.id/" target="_blank">Muhammad Sofiullah</a></span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="{{asset('js/main.js')}}"></script>
    @yield('script')
</body>
</html>
