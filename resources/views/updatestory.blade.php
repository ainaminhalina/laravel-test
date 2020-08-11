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
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}"/>


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
						<li><a style="font-size:40px" href="index.html"><font color="white">LITERALLY TWITTER</font></a></li>
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


	<!-- search section -->
	<section class="search-section ss-other-page">
		<div class="container">
			<div class="row">
                <div class="col-md-8 offset-md-2 col-xs-12">
                    <div class="row">
                        <div class="card" style="width: 100%; border-radius: 0;box-shadow: 10px 10px 20px #111111, -10px 10px 20px #111111;">
                            <div class="card-body" >
								<form id="updatestory">
									<input type="hidden" name="id" value="{{$story[0]->id}}"/>
									<h5 class="card-title">Update Story</h5><br>
									<div class="input-group mb-3">
									  <input style="border-radius: 0; background: #d3d3d3;" type="text" class="form-control" placeholder="Story Title" name="title" value="{{$story[0]->title}}">
									</div>	
									
									<div class="input-group mb-3">
									  <textarea style="border-radius: 0; background: #d3d3d3;" class="form-control" placeholder="Story Content" name="content" rows="3">{{$story[0]->content}}</textarea>
									</div>
									
									<div class="pull-right">
										<button style="border-radius: 0;" type="submit" class="btn btn-primary">Update Story</button>
									</div>
								</form>
							</div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</section>
	<!-- search section end -->

	<!--====== Javascripts & Jquery ======-->
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/mixitup.min.js') }}"></script>
	<script src="{{ asset('js/circle-progress.min.js') }}"></script>
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
 $(function() {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
 
	$("#updatestory").submit(function(event){
	   event.preventDefault();
	   var formData = $(this).serialize();
		
	   $.ajax({
		  type: "PUT",
		  url: '{{ env('APP_URL') }}/api/updateStory',
		  data: formData,
		  dataType: "json",
		  success: function(story){
			if(story.code == 200){
				swal({
				  icon: 'success',
				  title: 'Success',
				  text: story.message,
				}).then((result) => {
				  window.location.href = "{{ env('APP_URL') }}/storylist";
				});					
			}else{
				swal({
				  icon: 'error',
				  title: 'Oops...',
				  text: story.message,
				});
			}
		  },
		  error: function() {
				swal({
				  icon: 'error',
				  title: 'Oops...',
				  text: 'An error occurred!',
				});
		  },
	   });

	});   
 });
</script>

</html>