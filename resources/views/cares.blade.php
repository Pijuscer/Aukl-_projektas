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
      <nav class="spalvaNavbar navbar sticky-top navbar-expand-lg ">
        <div class="container-fluid">
            <a href="{{ url('/dashboard') }}" class="navbar-brand font-italic">Auklė Kaune</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav navbar-collapse justify-content-end">
                  @if (auth()->user()!= null)
                  @if (auth()->user()->roles==2 || auth()->user()->roles==1 || auth()->user()->roles==0)
                  <li class="nav-item dropdown">
                    <a class="linkai nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Profilis
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ url('/my_user_profile') }}">Mano profilis</a></li>
                      <li><a class="dropdown-item" href="{{ url('/my_kid_profiles') }}">Vaiko profilis</a></li>
                    </ul>
                  </li>
                  @endif
                  @endif
                  <a href="{{ url('/cares') }}" class="linkai nav-link">Paslaugos</a>
                  <a href="{{ url('/prices') }}" class="linkai nav-link">Kainos</a>
                  @if (auth()->user()!= null)
                    
                  @if (auth()->user()->roles==2)
                  <a href="{{ url('/working_days') }}" class="linkai nav-link">Laisvumas</a>
                  @else
                  @endif
                  @endif
                  @if (auth()->user()!= null)
                  @if (auth()->user()->roles==2 || auth()->user()->roles==1 || auth()->user()->roles==0)
                  <a href="{{ url('/reservation') }}" class="linkai nav-link">Rezervacija</a>
                  @endif
                  @endif
                  <a href="{{ url('/about') }}" class="linkai nav-link">Apie</a>
                  @if (auth()->user()!= null)
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
                      @endif
                </div>
            </div>
        </div>
    </nav>
        <div class="container mt-4">
            <div class="d-flex justify-content-center">
              <div class="col-md-10">
                @if (session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
                @endif
                @if (session('message_edit'))
                  <div class="alert alert-success">{{session('message_edit')}}</div>
                @endif
                @if (session('message_delete'))
                  <div class="alert alert-success">{{session('message_delete')}}</div>
                @endif
                  <h1 class="about_pavadinimas text-center p-4">Paslaugos</h1>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="cares_card card">
                        <div class="card-body card_border_style2">
                          <h5 class="prices card-title">Užsiėmimas darbo dienomis</h5>
                          <div class="cares_tekstas">
                            @forelse ($cares as $care)
                            @if($care->when=="Darbo diena")
                              {{$care->take_of_care}}<br/>
                            @endif
                          @empty
                            <div>Paslaugos nenustatytos</div>
                          @endforelse
                            </div>
                          <img src="/image/Fotoo13.png" class="cares_foto card-img-top paslaugos_foto">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="cares_card card">
                        <div class="card-body card_border_style2">
                          <h5 class="prices card-title">Užsiėmimas savaitgaliais</h5>
                          <div class="cares_tekstas">
                            @forelse ($cares as $care)
                            @if($care->when=="Savaitgali")
                              {{$care->take_of_care}}<br/>
                            @endif
                          @empty
                            <div>Paslaugos nenustatytos</div>
                          @endforelse
                            </div>
                          <img src="/image/Fotoo14.png" class="cares_foto card-img-top paslaugos_foto">
                        </div>
                      </div>
                    </div>                    
                  </div>
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                  @if (auth()->user()!= null)
                  @if (auth()->user()->roles==2)
                  <form action="cares" method="POST" class="paslaugu_pridejimas">
                    @csrf
                  <div class="row">
                    <h1 class="about_pavadinimas text-center p-4">Paslaugų pridėjimas</h1>
                  <div class="col">
                    <input value="{{ old('take_of_care') }}" type="text" class="form-control" placeholder="Užsiėmimas" aria-label="take_of_care" id="take_of_care" name="take_of_care">
                  </div>
                  <div class="col">
                    <input value="{{ old('when') }}" type="text" class="form-control" placeholder="Prižiūrėjimas" aria-label="when" id="when" name="when">
                  </div>
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end cares_issaugoti">
                    <button type="submit" class="btn btn-success btn-lg">Pridėti</button>
                    <a href="{{ url('/add_cares') }}" class="btn btn-success btn-lg">Redaguoti</a>
                  </div>
                  </form>
                  @endif
                  @endif
                  @if (auth()->user()!= null)
                  @if (auth()->user()->roles==2 || auth()->user()->roles==1 || auth()->user()->roles==0)
                  <div class="d-grid gap-2 col-6 mx-auto cares_issaugoti">
                    <a href="{{ url('/order_cares') }}" class="paslauga_mygtukas">Užsisakyti prižiūrėjimo paslaugą</a>
                  </div>
                  @endif
                  @endif
                  </div>
                  </form>
              </div>
          </div>
      </div>
  </main>
    <footer>
        <div class="footer text-center p-3" >© 2022 Darbą atliko Pijus Černiauskas</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>