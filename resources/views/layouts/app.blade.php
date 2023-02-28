<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('')}}assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	@yield("style")
	<link href="{{asset('')}}assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{asset('')}}assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{asset('')}}assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('')}}assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{asset('')}}assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('')}}assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('')}}assets/css/app.css" rel="stylesheet">
	<link href="{{asset('')}}assets/css/icons.css" rel="stylesheet">
    @stack('styles')
    <title>Plataforma de Gestão de Processos</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		@include("layouts.header")
		<!--end header -->
		<!--navigation-->
		@include("layouts.nav")
		<!--end navigation-->
		<!--start page wrapper -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                @include('flash::message')
                @yield("wrapper")
            </div>
        </div>
        <!--end page wrapper -->

		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2023. Todos Direitos Reservados.</p>
		</footer>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{asset('')}}assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{asset('')}}assets/js/jquery.min.js"></script>
	<script src="{{asset('')}}assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{asset('')}}assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{asset('')}}assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--app JS-->
	<script src="{{asset('')}}assets/js/app.js"></script>
	@yield("script")
    @stack('scripts')
</body>

</html>
