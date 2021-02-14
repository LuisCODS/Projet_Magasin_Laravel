<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--GOOGLE FONTS-->
		<link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
		<!--CSS BOOTSTRAP  -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<!--CSS APP -->
		<link rel="stylesheet" href="/css/styles.css">
		<!-- JS APP-->
		<script type="text/javascript" src="/js/scripts.js"></script>
		<title>@yield('title')</title>
	</head>
	<body>
		<!-- =======================================  HEADER ======================================= -->
		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<nav class="navbar navbar-expand-lg navbar-light bg-light">
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="navbar-toggler-icon"></span>
							</button> <a class="navbar-brand" href="/">C&A Mode</a>
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="navbar-nav">
									<li class="nav-item ">
										<a class="nav-link" href="{{ route('produits') }}">Nos produits </a>
									</li>
									<li class="nav-item">
										<a href="{{ route('contact') }}" class="nav-link">Contact</a>
									</li>
									<li class="nav-item ">
										<a href="{{ route('add-produit') }}" class="nav-link">Ajouter produit</a>
									</li>

								</ul>

								<ul class="navbar-nav ml-md-auto">
									<div class="dropdown">
										<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Link dropdown
										</a>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="#">Alguma ação</a>
											<a class="dropdown-item" href="#">Outra ação</a>
											<a class="dropdown-item" href="#">Alguma coisa aqui</a>
										</div>
									</div>

									<li class="nav-item active">
										<a class="nav-link" href="#">Login <span class="sr-only">(current)</span></a>
									</li>
									<li class="nav-item active">
										<a class="nav-link" href="#">Logout <span class="sr-only">(current)</span></a>
									</li>

								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</header>
		<!-- ======================================= MAIN ======================================= -->
		<main>
			<div id ="mainContentLayout" class="container-fluid h-100">
				<div class="row h-100 justify-content-center align-items-center">
					@if(session('msg'))
					<p class="msg">{{ session('msg') }}</p>
					@endif
					<!-- ================= RENDER PAGES HERE ================= -->
					@yield('content')
					<!-- ==================================================== -->
				</div>
			</div>
		</main>
		<!--ICONS : https://ionicons.com/ -->
		<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
	</body>
	<!-- ======================================= FOOTER ======================================= -->
	<footer>
		<p>LuisCODS- &copy; 2021</p>
	</footer>
</html>
