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
        <main>
            <div class="container mt-4 transboxabout">
                <div class="d-flex justify-content-center">
                  <div class="col-md-6">
                    <a href="{{ url('/cares') }}" class="btn btn-success btn-lg atgal">Atgal</a>
                      <h1 class="about_pavadinimas text-center p-4">Paslaugos užsakymas</h1>
                      @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif
                      <form  action="/check_time" method="POST">
                        @csrf
                        <div class="col-md-6 order_care_style">
                          @isset($day)
                          <label for="date" class="form-label add_order_care_tektas">Dienos</label>
                          <input value="{{$day}}" type="date" id="date" class="form-control" name="date">
                          @endisset
                         
                         @empty($day)

                         <label for="date" class="form-label add_order_care_tektas">Dienos</label>
                         <input value="" type="date" id="date" class="form-control" name="date">
                          @endempty
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto paslauga_stilius">
                          <button type="submit" class="paslauga_mygtukas">Tikrinti</button>
                        </div>
                      </form>
                      <form action="/reservate" method="POST">
                        @csrf
                      @isset($hours)
                      <input type="hidden" value="{{$hours[0]->date}}" name="date">
                      <div class="row row-cols-4 row-cols-lg-4 g-1 g-lg-2 order_stilius">
                        @foreach ( $hours as $key=> $hour)
                        <div class="col">
                          <div class="p-3 ">
                            <input class="form-check-input" type="checkbox" name="hours[]" value="{{$hour->time}}" id="flexCheckDefault">
                              <label class="form-check-label label_stilius" for="flexCheckDefault">
                              {{$hour->time}} val
                              </label>
                          </div>
                        </div>
                          
                        @endforeach
                      </div>
                        @isset($kids)
                        <div class="row row-cols-1 row-cols-1 lg-1 g-1 g-lg-2 order_stilius">
                        
                        @foreach ( $kids as $key=> $kid)
                        <div class="col">
                          <div class="p-3 ">
                            <input class="form-check-input" type="checkbox" name="kid[]" value="{{$kid->id}}" id="flexCheckDefault">
                              <label class="form-check-label label_stilius" for="flexCheckDefault">
                              {{$kid->kid_name}} {{$kid->kid_surname}} {{$kid->date_of_birth}} {{$kid->additional_information}}
                              </label>
                          </div>
                        </div>
                          
                        @endforeach
                        </div>
                        @endisset
                      
                      @endisset
                        <div class="d-grid gap-2 col-6 mx-auto paslauga_stilius" >
                            <button type="submit" class="paslauga_mygtukas">Užsisakyti</button>
                        </div>
                      </form>
                      </div>           
                  </div>
              </div>
        </main>
    <footer>
        <div class="footer text-center p-3 order_cares_footer">© 2022 Darbą atliko Pijus Černiauskas</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>