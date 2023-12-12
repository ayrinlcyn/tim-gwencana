<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body style="font-family: Afacad">

    <div class="sticky-top">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid" >
        <a class="navbar-brand" href="#">YUM CRUNCH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{url('toko/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('toko/create')}}">Create</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('toko.action')}}">Action</a>
            </li>
            <li>
              <a href="{{ route('cart.index') }}" class="btn btn-primary">
                <i class="ti ti-shopping-cart"></i>
                <span class="badge bg-secondary">{{ count(session('cart', [])) }}</span>
            </a>
            </li>
          </ul>
          <form class="d-flex" role="search" action="{{url('toko')}}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
          </form>
        </div>
      </div>
    </nav>
    </div>
      {{-- <main class="container"> --}}
        @if (Session::has('success'))
        <div class="pt-3">
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        </div>
            
        @endif
        @yield('konten')
    {{-- </main> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
    </html>