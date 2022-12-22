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
  <div class="container mt-4">
  <div class="d-flex justify-content-center">
    <div class="col-md-12">
      @if (session('message_kid_profile_add'))
        <div class="alert alert-success">{{session('message_kid_profile_add')}}</div>
      @endif
      @if (session('message_kid_profile_edit'))
        <div class="alert alert-success">{{session('message_kid_profile_edit')}}</div>
      @endif
        <h1 class="about_pavadinimas text-center p-4">Jūsų vaikų profilis</h1>
        <div class="col-lg-6 transboxabout_my">
        <p class="text-center">Jeigu esate naujas vartotojas ir neužpildėte profili apie savo vaikus, galite tai atlikti paspaudę mygtuką „Užpildyti profilį“.</p>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <table class="table table_stilius">
              <thead class="table1">
                <tr>
                  <th scope="col">Vaiko vardas</th>
                  <th scope="col">Vaiko pavardė</th>
                  <th scope="col">Gimimo data</th>
                  <th scope="col">Svarbi informacija</th>
                  <th scope="col"></th>
                  <th scope="col">Redaguoti</th>
                </tr>
              </thead>
          <tbody>
            @foreach ( $kids_profiles as  $kids_profiles2)
            @isset($users_profiles)
            @if($kids_profiles2->user_profile_id==$users_profiles->id)
            <tr class="tr_stilius">
                <td>{{$kids_profiles2->kid_name }}</td>
                <td>{{$kids_profiles2->kid_surname }}</td>
                <td>{{$kids_profiles2->date_of_birth}}</td>
                <td>{{$kids_profiles2->additional_information }}</td>
                <td>{{ Str::limit($kids_profiles2->description, 50) }}</td>
                <td>
                  <a class='no-underline btn btn-info btn-sm' href="/edit_kids_profiles/edit_kid/{{$kids_profiles2->id }}">Redaguoti</a>
                </td>
            </tr>
            @endif
            @endisset
              @endforeach
          </tbody>
          </table>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end my_user_profiles">
            <a href="{{ url('/add_kids_profiles') }}" class="btn btn-success btn-lg">Užpildyti profilį</a>
            @if (auth()->user()->roles==2 || auth()->user()->roles==1)
            <a href="{{ url('/all_kids_profiles') }}" class="btn btn-success btn-lg">Visi profiliai</a>
            @endif
          </div>
          <div class="col-lg-6">
            <img src="/image/Foto11.png" class="center my_foto card-img-top">
          </div>
        </div>
  </div>
</div>
</div>
</main>
<footer>
<div class="footer text-center p-3 my_footer">© 2022 Darbą atliko Pijus Černiauskas</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>