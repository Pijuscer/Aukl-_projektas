<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Auklė Kaune</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ url('/css1/style.css') }}" />
    </head>
    <body class="antialiased">
        <header>
            <nav class="spalvaNavbar navbar sticky-top navbar-expand-lg ">
                <div class="container-fluid">
                    <a href="{{ url('/dashboard') }}" class="navbar-brand font-italic">Auklė Kaune</a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav navbar-collapse justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="linkai nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profilis
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('/my_user_profile') }}">Mano profilis</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/my_kid_profiles') }}">Vaiko profilis</a></li>
                                </ul>
                            </li>
                            <a href="{{ url('/cares') }}" class="linkai nav-link">Paslaugos</a>
                            <a href="{{ url('/prices') }}" class="linkai nav-link">Kainos</a>
                            @if (auth()->user()->roles==2)
                                <a href="{{ url('/working_days') }}" class="linkai nav-link">Laisvumas</a>
                            @else
                            @endif
                            <a href="{{ url('/reservation') }}" class="linkai nav-link">Rezervacija</a>
                            <a href="{{ url('/about') }}" class="linkai nav-link">Apie</a>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <button type="submit" class="dropdown-item nav_dropdown">Atsijungti</button>
                                </form>
                                </ul>
                            </div> 
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container mt-4">
                <a href="{{ url('/my_user_profile') }}" class="btn btn-success btn-lg atgal">Atgal</a>
                <h1 class="about_pavadinimas text-center p-4">Visi vartotojų profiliai</h1>
                <div class="row justify-content-center paieska">
                    <div class="col-lg-4 ">
                        <form action="/all_users_profiles/search" method="get">
                            <input class="searchTerm" type="text" placeholder="Paieška.." name="query">
                            <button class="btn btn-info" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg></button>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8 ">
                        <table class="table table_stilius">
                            <thead class="table1">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="th_stilius">Vartotojo id</th>
                                <th scope="col" class="th_stilius">Vardas</th>
                                <th scope="col" class="th_stilius">Pavardė</th>
                                <th scope="col" class="th_stilius">Telefono numeris</th>
                                <th scope="col" class="th_stilius">Adresas</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ( $users_profiles as  $users_profiles2)
                                <tr class="tr_stilius">
                                    <th scope="row">{{  $users_profiles2->id }}</th>
                                    <td class="th_stilius">{{$users_profiles2->user_id }}</td>
                                    <td class="th_stilius">{{$users_profiles2->name }}</td>
                                    <td class="th_stilius">{{$users_profiles2->surname }}</td>
                                    <td class="th_stilius">{{$users_profiles2->telephone_number}}</td>
                                    <td class="th_stilius">{{$users_profiles2->address }}</td>
                                    <td class="th_stilius">{{ Str::limit($users_profiles2->description, 50) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="footer text-center p-3 all_footer" >© 2022 Darbą atliko Pijus Černiauskas</div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>