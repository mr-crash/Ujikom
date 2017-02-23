<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	@if(isset($page))
    <title>{{$page}} - {{ config('app.name', 'Laravel') }}</title>
    @else
    <title>{{ config('app.name', 'Laravel') }}</title>
    @endif
	<!-- CSS -->
	<link href="{{url('clean/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
	<link href="{{url('clean/css/font-awesome.min.css')}}" rel="stylesheet" media="screen">
	<link href="{{url('clean/css/simple-line-icons.css')}}" rel="stylesheet" media="screen">
	<link href="{{url('clean/css/animate.css')}}" rel="stylesheet">
    
	<!-- Custom styles CSS -->
	<link href="{{url('clean/css/style.css')}}" rel="stylesheet" media="screen">
    
    <script src="{{url('clean/js/modernizr.custom.js')}}"></script>
       
</head>
<body>

	<!-- Preloader -->

	<div id="preloader">
		<div id="status"></div>
	</div>

	<!-- Home start -->

	<section id="home" class="pfblock-image screen-height">
        <div class="home-overlay"></div>
		<div class="intro">
			<div class="start">Hello, my name is Fathurrahman Hardi Ar-Rasyid and I am</div>
			<h1>{{config('app.name')}}</h1>
			<div class="start">Wellcome To My Project</div>
		</div>

        <a href="#custom-collapse">
		<div class="scroll-down">
            <span>
                <i class="fa fa-angle-down fa-2x"></i>
            </span>
		</div>
        </a>

	</section>

	<!-- Home end -->

	<!-- Navigation start -->

	<header class="header">

		<nav class="navbar navbar-custom" role="navigation">

			<div class="container">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{url('/')}}">{{config('app.name')}}</a>
				</div>

				<div class="collapse navbar-collapse" id="custom-collapse">
					<ul class="nav navbar-nav ">
						@if(Auth::guest())
						@else
                        @if(Auth::user()->type_user == 'admin')
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
                        @elseif(Auth::user()->type_user == 'bendahara')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('jabatan')}}">Jabatan</a></li>
                                <li><a href="{{url('golongan')}}">Golongan</a></li>
                                <li><a href="{{url('kategori_lembur')}}">Kategori Lembur</a></li>
                                <li><a href="{{url('lembur_pegawai')}}">Lembur Pegawai</a></li>
                                <li><a href="{{url('tunjangan')}}">Kategori Tunjangan</a></li>
                                <li><a href="{{url('tunjangan_pegawai')}}">Tunjangan Pegawai</a></li>
                                <li><a href="{{url('penggajian')}}">Penggajian</a></li>
							</ul>
                        </li>
                        @elseif(Auth::user()->type_user == 'hrd')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('jabatan')}}">Jabatan</a></li>
                                <li><a href="{{url('golongan')}}">Golongan</a></li>
                                <li><a href="{{url('pegawai')}}">Pegawai</a></li>
                                <li><a href="{{url('tunjangan')}}">Kategori Tunjangan</a></li>
                                <li><a href="{{url('tunjangan_pegawai')}}">Tunjangan Pegawai</a></li>
							</ul>
                        </li>
                        @endif
                        @endif
					</ul>
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
                                    <div class="row" align="center">
                                        <?php $data = App\Pegawai::where('user_id',Auth::user()->id)->first(); ?>
                                        @if(isset($data->id))
                                        <img src="{{url('account/'.$data->foto)}}" class="foto-profile-mini">
                                        @else
                                        <img src="{{url('account/default.png')}}" class="foto-profile-mini">
                                        @endif
                                        </div>
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

			</div><!-- .container -->

		</nav>

	</header>
    <br><br>
	@yield('content')
	<br><br><br><br><br><br><br><br><br>

	<!-- Footer start -->

	<footer id="footer">
		<div class="container">
			<div class="row">

				<div class="col-sm-12">


					<p class="heart">
                        Made in <span class="fa fa-heart fa-2x animated pulse"></span> SMK Assalaam
                    </p>
                    <p class="copyright">
                        2017 &copy; Fathurrahman Hardi Ar-Rasyid
					</p>

				</div>

			</div><!-- .row -->
		</div><!-- .container -->
	</footer>

	<!-- Footer end -->

	<!-- Scroll to top -->

	<div class="scroll-up">
		<a href="#home"><i class="fa fa-angle-up"></i></a>
	</div>
    
    <!-- Scroll to top end-->

	<!-- Javascript files -->

	<script src="{{url('clean/js/jquery-1.11.1.min.js')}}"></script>
	<script src="{{url('clean/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{url('clean/js/jquery.parallax-1.1.3.js')}}"></script>
	<script src="{{url('clean/js/imagesloaded.pkgd.js')}}"></script>
	<script src="{{url('clean/js/jquery.sticky.js')}}"></script>
	<script src="{{url('clean/js/smoothscroll.js')}}"></script>
	<script src="{{url('clean/js/wow.min.js')}}"></script>
    <script src="{{url('clean/js/jquery.easypiechart.js')}}"></script>
    <script src="{{url('clean/js/waypoints.min.js')}}"></script>
    <script src="{{url('clean/js/jquery.cbpQTRotator.js')}}"></script>
	<script src="{{url('clean/js/custom.js')}}"></script>

</body>
</html>