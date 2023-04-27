<!DOCTYPE HTML>
<html>
<head>
	<title>{{ $title }}</title>
	<link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
	<link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Personal Blog Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" 
	/>
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!----webfonts---->
	<link href='http://fonts.googleapis.com/css?family=Oswald:100,400,300,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic' rel='stylesheet' type='text/css'>
	<!----//webfonts---->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!--end slider -->
	<!--script-->
    <script type="text/javascript" src="{{ asset('js/move-top.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/easing.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
    <!--/script-->
    <script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
    </script>
    <!---->
</head>
<body>
<!---header---->			
<div class="header">  
	 <div class="container">
		  <div class="logo">
			  <a href="{{ route('main.index') }}"><img src="{{ asset('images/logo.jpg') }}" title="" /></a>
		  </div>
			 <!---start-top-nav---->
			 <div class="top-menu">
				 <div class="search">
					<form action="{{ route('post.search') }}" method="GET">
					    <input type="text" style="color: #232323;" name="q" placeholder="Поиск..." value="{{ isset($query) ? $query : '' }}" required="">
					    <input type="submit" value=""/>
					</form>
				 </div>
				  <span class="menu"> </span> 
				    <ul>
						<li class="active"><a href="{{ route('post.index') }}">БЛОГ</a></li>											
						<li>
							@auth()
							    <a href="{{ route('personal.main.index') }}">ЛИЧНЫЙ КАБИНЕТ</a>
							@endauth
							@guest()
							    <a href="{{ route('personal.main.index') }}">ВОЙТИ</a>								
							@endguest
						</li>
						@auth()	
						@if(auth()->user()->role === 0)
						<li>
							<a href="{{ route('admin.main.index') }}">АДМИН-ПАНЕЛЬ</a>
						</li>
						@endif
						<li>
							<form action="{{ route('logout') }}" method="POST">
							    @csrf
								<button class="btn-link" type="submit"><li style="font-size: 14px">ВЫЙТИ</li></button>
						    </form>
					    </li>	
						@endauth								
						<div class="clearfix"> </div>
				    </ul>
			 </div>
			 <div class="clearfix"></div>
				<script>
					$("span.menu").click(function(){
					$(".top-menu ul").slideToggle("slow" , function(){
					});
					});
			    </script>
				<!---//End-top-nav---->					
	 </div>
</div>
<!--/header-->
@yield('content')
<!---->
<div class="footer">
	<div class="container">
		<p>&copy; 2023 BLOGNAME. All rights reserved.</p>
	</div>
</div>