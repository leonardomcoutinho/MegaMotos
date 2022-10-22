<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MEGA MOTOS')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/icon.png">
    <!-- Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script> 
    @yield('style')     
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white nav-p">
            <div class="container"> 
                <a href="{{route('admin')}}"><img src="/img/logo.png" alt="" width="100px"></a>               
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div class="container-fluid">
                <div class="dashboard">
                    <div class="aside-dash p-3 text-bg-dark">
                        <a href="/admin" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">                          
                          <span class="fs-4">Dashboard</span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                          <li class="nav-item">
                            <a href="{{route('sell')}}" class="nav-link active bg-danger mb-3" aria-current="page">
                            <i class="bi bi-plus-lg me-2"></i>
                              Lançar Venda/Serviço
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{route('read_budget')}}" class="nav-link text-white" aria-current="page">
                            <i class="bi bi-card-checklist me-2"></i>
                              Orçamentos
                            </a>
                          </li>
                          <li>
                            <a href="{{route('products')}}" class="nav-link text-white">
                            <i class="bi bi-bag me-2"></i>
                              Produtos
                            </a>
                          </li>                          
                          <li>
                            <a href="{{route('inventory')}}" class="nav-link text-white">
                            <i class="bi bi-bank me-2"></i>
                              Estoque
                            </a>
                          </li> 
                          <li>
                            <a href="{{route('relatory')}}" class="nav-link text-white">
                            <i class="bi bi-card-list me-2"></i>
                              Relatório V/S
                            </a>
                          </li>                           
                          {{-- <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-card-list me-2"></i>Relatorios
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{route('relatory')}}"><i class="bi bi-cash me-2"></i>Vendas/Serviço</a></li>
                              <li><a class="dropdown-item" href="#"><i class="bi bi-bag me-2"></i>Orça</a></li>
                              <li><a class="dropdown-item" href="#"><i class="bi bi-bank me-2"></i>Estoque</a></li>
                            </ul>
                          </div>  --}}
                          <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-gear me-2"></i>Configuração
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{route('categories')}}"><i class="bi bi-tag me-2"></i>Categorias</a></li>
                              <li><a class="dropdown-item" href="{{route('fpay')}}"><i class="bi bi-wallet2 me-2"></i>Forma de Recebimento</a></li>
                              <li><a class="dropdown-item" href="{{route('tariff')}}"><i class="bi bi-credit-card-2-back me-2"></i>Tarifas Cartão</a></li>
                            </ul>
                          </div>                       
                        </ul>
                        <hr>
                        <div class="dropdown">                          
                            <ul class="navbar-nav ms-auto">
                              <!-- Authentication Links -->
                              @guest
                                  @if (Route::has('login'))
                                      <li class="nav-item">
                                          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                      </li>
                                  @endif
      
                                  @if (Route::has('register'))
                                      <li class="nav-item">
                                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                      </li>
                                  @endif
                              @else
                                  <li class="nav-item dropdown">
                                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                          {{ Auth::user()->name }}
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                          <a class="dropdown-item" href="{{ route('logout') }}"
                                              onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                              Sair
                                          </a>
                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                              @csrf
                                          </form>
                                      </div>
                                  </li>
                              @endguest
                          </ul>
                        </div>
                    </div>                    
                    <section class="section-dash">
                        <div class="row">
                            @if (session('error'))
                                  <div class="col-12">
                                      <div class="alert alert-danger text-center">{{ session('error')}}</div>
                                  </div>
                              @endif
                              @if (session('success'))
                                  <div class="col-12">
                                      <div class="alert alert-success text-center">{{ session('success')}}</div>
                                  </div>
                              @endif
                          </div>
                          
                        @yield('dashboard')
                    </section>
                </div>
            </div>                         
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    @yield('scripts')
    
</body>
</html>
