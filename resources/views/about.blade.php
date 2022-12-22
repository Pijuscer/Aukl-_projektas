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
        <main>
            <div class="container mt-4">
                <div class="row">
                <div class="d-flex justify-content-center transboxabout">
                <div class="col-md-10">
                    <h1 class="about_pavadinimas text-center p-4" >Apie auklės Kaune paslaugą</h1>
                    <p class="about_tekstas">Sveiki, esu Ieva Ievaitė asmuo, kuri prižiūrės Jūsų vaiką. Turiu daugiau nei 7 metų patirties šiame darbe. Todėl galiu Jums pasiūlyti patikimą bei atsakingą vaiko priežiūrą. Gyvenu didelėje teritoryje esančiame name, kuriame vaikas turės daug laisvės bei įvairiausių pramogų ne tik namo viduje, bet ir lauke. Jums pažadu savo kaip žmogaus sąžiningumą, nuoširdumą bei rūpestingumą Jūsų vaiko priežiūrai.</p>
                    <h1 class="about_pavadinimas text-center p-4">Kontaktai</h1>
                <div class="container">
                    <div class="row g-2">
                          <div class="about_tekstas col-4 text-center">
                            Telefono numeris
                          </div>
                          <div class="about_tekstas col-4 text-center">
                            Adresas
                          </div>
                          <div class="about_tekstas col-4 text-center">
                            Elektroninis paštas
                          </div>
                    </div>
                    <div class="row g-2">
                        <div class="about_tekstas col-4 text-center">
                          +37061111111
                        </div>
                        <div class="about_tekstas col-4 text-center">
                          Naujoji gatvė 1 (Žaliakalnis)
                        </div>
                        <div class="about_tekstas col-4 text-center"> 
                          pc.priežiūra@gmail.com
                        </div>
                  </div>
                </div>
                <h1 class="about_pavadinimas text-center p-4">Taisyklės kaip užsisakyti paslaugą</h1>
                <ul class="about_tekstas taisykliuSarasas">
                  <li>Pirmiausia, kad galėtumėte matyti vartotojui priskiriamus visus puslapius turite prisiregistruoti</li>
                  <li>Prisiregistravus būtina užpildyti apie save bei savo vaiko duomenis profilio puslapyje, kitaip užsisakyti prižiūrėjimo paslaugos negalėsite.</li>
                  <li>Peržvelkite kainų puslapio, kuriame nurodytos 1 valandos kainos tiek darbo dienomis, tike savaitgaliais.</li>
                  <li>Peržvelkite paslaugų puslapio, kuriame nurodyta kuom auklė su jūsų užsiims, kad vaikui būtų įdomu bei linksma.</li>
                  <li>Tuomet paslaugų puslapyje paspaudus „Užsisakyti“ mygtuką patenkate į nurodytų laisvų valandų puslapį.</li>
                  <li>Pasirinkite iš žemiau esančios lentelės paslaugos norimą rezervacijos laiką bei paspauskite „Rezervuotis“ mygtuką.</li>
                  <li>Savo rezervacija galite matyti rezervacijos puslapyje.</li>
              </ul>
              <div>
                <img src="/image/Fotoo4.png" class="center w-50 mx-auto about_foto card-img-top">
              </div>  
              </div>
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
