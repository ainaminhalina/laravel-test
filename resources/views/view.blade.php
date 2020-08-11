<!DOCTYPE html>
<html lang="en">
<head>
	<title>LITERALLY TWITTER</title>
	<meta charset="UTF-8">
	<meta name="description" content="Fake Twitter">
	<meta name="keywords" content="webuni, education, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<style>
	th{
	color: white;
	}
	
	td{
	color: white;
	}
	
	p{
	color: white;
	}

	</style>
	
</head>
<body style="background: #4c4c4c">
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="site-logo">
					<nav class="main-menu">
						<ul>
						<li><a style="font-size:40px" href="#"><font color="white">LITERALLY TWITTER</font></a></li>
						</ul>
					</nav>
					</div>
					<div class="nav-switch">
						<i class="fa fa-bars"></i>
					</div>
				</div>
				<div class="col-lg-9 col-md-9">
					<nav class="main-menu pull-right">
						<ul>
							<li><a style="font-size:25px" href="{{ env('APP_URL') }}/view">My Profile</a></li>
							<li><a style="font-size:25px" href="{{ env('APP_URL') }}/storylist">My Stories</a></li>
							<li><a style="font-size:25px" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->


	<!-- Page info -->
	<div class="page-info-section set-bg" style="background: #4c4c4c">
		<div class="container">
			<div class="site-breadcrumb">
				 
			</div>
		</div>
	</div>
	<!-- Page info end -->



	<!-- Page -->
	<section class="contact-page spad pb-0"  style="background: #4c4c4c">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="contact-form-warp">
						<div class="section-title text-white text-left">
							<h2>My Profile</h2>
						</div>
						<form class="contact-form" id="profile">
							<input id="id" name="id" type="hidden" value="{{$users[0]->id}}">
							<input id="name" name="name" type="text" placeholder="Name" value="{{$users[0]->name}}">
							<input id="email" name="email" type="email" placeholder="E-mail" value="{{$users[0]->email}}">
							<input id="address" name="address" type="text" placeholder="Address" value="{{$users[0]->address}}">
							<input id="phoneno" name="phoneno" type="text" placeholder="Phone No" value="{{$users[0]->phoneno}}">

							<input value="Update" type="submit" class="site-btn">
						</form>
					</div>
				</div>
		</div>
	</section>
	<!-- Page end -->


	<!-- banner section -->
	<section class="banner-section spad">
		<div class="container">
			
		</div>
	</section>
	<!-- banner section end -->

	<!--====== Javascripts & Jquery ======-->
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/mixitup.min.js') }}"></script>
	<script src="{{ asset('js/circle-progress.min.js') }}"></script>
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	<script>
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }}); 
	
		$('#profile').submit(function (event) {
			event.preventDefault();
		
			<!-- use this technique for ajax data if not using RESTFul -->
			<!-- NOTE this will capture the name attribute (not id) in this form -->
			var formData = $(this).serialize(); //terima data dari formData
			console.log(formData); 
			<!-- check the console to make sure that the form data values are correctly serialize -->
			
			$.ajax({
					type: "PUT",
					url: "{{ env('APP_URL') }}/api/update",
					data: formData,
					dataType: "json",
					
					success: function(user){
			if(user.code == 200){
				swal({
				  title: "Good job!",
				  text: user.message,
				  icon: "success",
				}).then((result) => {
					location.reload();
				});
			}else{
				swal({
				  title: "Oops...",
				  text: user.message,
				  icon: "error",
				});
			}
			},
			error: function() {
				swal({
				  title: "Oops...",
				  text: "An error occured!",
				  icon: "error",
				});
},
			});
			
			
			
			});
	</script>	
	
	
	
</body>
</html>