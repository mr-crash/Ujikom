<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    @if(isset($page))
    <title>{{$page}} - {{ config('app.name', 'Laravel') }}</title>
    @else
    <title>{{ config('app.name', 'Laravel') }}</title>
    @endif
    
    <link href="{{url('/css/loader.css')}}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{url('/css/app.css')}}" rel="stylesheet">
    <link href="{{url('/css/app-child.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
    <script>
        $(window).load(function() { $("#preloader").fadeOut("slow"); })
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
<div id="LWS">
<b>Handphone Kamu Terlalu Jelek</b>
</div>
  <!-- Preloader --> 
    <div id="preloader">
      <div class="loader">
        <div class="text-loading">Mohon Tunggu</div>
            <svg class="circle-loader" height="50" width="50">
              <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />
            </svg>
            <img src="{{url('boy05.png')}}" class="loading">
        </div>
    </div><!--preloader end-->
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a href="{{ url('/') }}">
                        <img src="{{url('boy05.png')}}" class="navbar-brand image" title="{{config('app.name','Penggajian')}}">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{url('home')}}">Home</a></li>
                        @if(Auth::user()->type_user == "admin"||Auth::user()->type_user == 'hrd')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('pegawai')}}">Pegawai</a></li>
                                <li><a href="{{url('jabatan')}}">Jabatan</a></li>
                                <li><a href="{{url('golongan')}}">Golongan</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gaji<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">                            
                                <li><a href="{{url('kategori_lembur')}}">Kategori Lembur</a></li>
                                <li><a href="{{url('lembur_pegawai')}}">Lembur Pegawai</a></li>
                                <li><a href="{{url('tunjangan')}}">Kategori Tunjangan</a></li>
                                <li><a href="{{url('tunjangan_pegawai')}}">Tunjangan Pegawai</a></li>
                                <li><a href="{{url('penggajian')}}">Penggajian</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <!-- <li><a href="{{ url('/register') }}">Register</a></li> -->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <?php $data = App\Pegawai::where('user_id',Auth::user()->id)->first(); ?>
                                        @if(isset($data->id))
                                        <img src="{{url('account/'.$data->foto)}}" class="foto-profile-mini">
                                        @else
                                        <img src="{{url('account/default.png')}}" class="foto-profile-mini">
                                        @endif
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br><br>
        @yield('content')
        <br><br><br>
    </div>
    @if (isset($_GET['search']))
    <button class="btn to-top" style="display: block;">^</button>
    @endif
    <!-- Scripts -->
    <script src="{{url('/js/app.js')}}"></script>
</body>
</html>
