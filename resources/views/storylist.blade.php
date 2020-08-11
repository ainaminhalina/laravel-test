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


	<!-- search section -->
	<section class="search-section ss-other-page">
		<div class="container">
			<div class="row">
                <div class="col-md-8 offset-md-2 col-xs-12">
                    <div class="row">
                        <div class="card" style="width: 100%; border-radius: 0; box-shadow: 10px 10px 20px #111111, -10px 10px 20px #111111;">
                            <div class="card-body" >
								<form id="addStory">
									<input type="hidden" name="user_id" value="{{Auth::id()}}"/>
									<h3 class="card-title">Add Story</h3><br>
									<div class="input-group mb-3">
									  <input style="border-radius: 0; background: #d3d3d3;" type="text" class="form-control" placeholder="Story Title" name="title">
									</div>	
									
									<div class="input-group mb-3">
									  <textarea style="border-radius: 0; background: #d3d3d3;" class="form-control" placeholder="Story Content" name="content" rows="5"></textarea>
									</div>
									
									<div class="pull-right">
										<button style="border-radius: 0;" type="submit" class="btn btn-primary">Add Story</button>
									</div>
								</form>
							</div>
                        </div>
                    </div>
                </div>
			</div>
			<br/>
			<br/>
			@foreach($stories as $story)
			<div class="row">
                <div class="col-md-8 offset-md-2 col-xs-12">
                    <div class="row">
                        <div class="card" style="width: 100%; border-radius: 0; box-shadow: 10px 10px 20px #111111, -10px 10px 20px #111111;">
                            <div class="card-body" >
                                <h3 class="card-title" style="display: inline">{{$story->title}}</h3>
								<button class="btn btn-danger pull-right" style="margin-left: 5px; border-radius: 0;" onclick="deleteStory('{{$story->id}}')"><i class="fa fa-trash"></i></button>
								<a href="{{ env('APP_URL') }}/updateStory/{{$story->id}}" class="btn btn-primary pull-right" style="margin-left: 5px; border-radius: 0;"><i class="fa fa-edit"></i></a>
								<hr style="border-top: 1px solid rgba(0,0,0,.2)">
								@if(strlen($story->content) <= 100)
                                <ul class="list-group list-group-flush" style="font-size:32px">
								@elseif(strlen($story->content) <= 200)
								<ul class="list-group list-group-flush" style="font-size:24px">
								@else
								<ul class="list-group list-group-flush" style="font-size:16px">
								@endif
                                {{$story->content}} 
                                </ul>
								<br/>
							</div>
                        </div>
                    </div>
                </div>
			</div>
			<br/>
			@endforeach
		</div>
	</section>
	<!-- search section end -->

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
 $(function() {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
 
	$("#addStory").submit(function(event){
	   event.preventDefault();
	   var formData = $(this).serialize();
		
	   $.ajax({
		  type: "POST",
		  url: '{{ env('APP_URL') }}/api/addStory',
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
<script>
function deleteStory(story_id){
	
   $.ajax({
	  type: "DELETE",
	  url: '{{ env('APP_URL') }}/api/deleteStory/' + story_id,
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
}
</script>
</html>