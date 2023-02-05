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
          <div class="d-flex justify-content-center">
            <div class="col-md-10">
              @if (session('message_freedom_add'))
                <div class="alert alert-success">{{session('message_freedom_add')}}</div>
              @endif
              <h1 class="about_pavadinimas text-center p-4">Laisvumas</h1>
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form action="working_days" method="POST" class="row g-3 transboxaboutadd paslaugu_pridejimas">
                @csrf
                <div class="col-md-6">
                  <label for="date" class="form-label add_label_tektas">Diena</label>
                  <input value="{{ old('date') }}" type="date" id="date" class="form-control" name="date">
                </div>
                <div class="col-md-6">
                  <label for="time" class="form-label add_label_tektas">Nurodytos darbo laisvos valandos</label>
                  <input value="{{ old('time') }}" type="text" class="form-control" id="time" name="time" placeholder="Įrašomas laisvumas valandų">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end button_issaugoti">
                  <button type="submit" class="btn btn-success btn-lg">Išsaugoti</button>                 
                  <a href="{{ url('/all_working_days') }}" class="btn btn-success btn-lg">Visas laisvumas</a>
                </div>
              </form>
            </div>           
          </div>
        </div>
      </main>
      <footer>
        <div class="footer text-center p-3 working_days_footer">© 2022 Darbą atliko Pijus Černiauskas</div>
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>