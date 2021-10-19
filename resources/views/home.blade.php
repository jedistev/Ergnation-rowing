<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Ergnation</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

        <script src="{{ asset('js/app.js') }}"></script>

		<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

}
    </style>

<style>
      #intro {
		color: rgb(255, 255, 255);
    	position: relative;
        background-image: url("{{ asset('img/auth/login-bg.jpg') }}");
        height: 500vh;
		width: 100%
      }

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
	  .centerlogo{
		  padding-top:25%
	  }
    </style>


        <!-- themekit admin template asstes -->
        <link rel="stylesheet" href="{{ asset('all.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/theme.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body class="d-flex h-100 text-center text-white bg-dark">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" id="intro">

  <main class="px-3">
	<div class="container">
		    <div class="row justify-content-center centerlogo">
		        <div class="col-md-12 m-5 text-center">
		        	<a href="http://ergnation">
		            	<img height="40" src="{{ asset('img/logo.png') }}">
		            </a>
		        </div>
		        <div class="col-md-12 m-5 mt-0 text-center">
		            <a href="{{url('login')}}" class="btn btn-success">Login</a>
		        </div>

		        </div>
		    </div>
		</div>
  </main>
</div>


		<script src="{{ asset('all.js') }}"></script>

    </body>
</html>

