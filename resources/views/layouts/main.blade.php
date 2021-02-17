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
										<a class="nav-link" href="{{ route('list-all') }}">Nos produits </a>
									</li>
									<li class="nav-item">
										<a href="{{ route('contact') }}" class="nav-link">Contact</a>
									</li>
								</ul>
								<ul class="navbar-nav ml-md-auto">
									<div class="dropdown">
										<a class="btn btn-secondary dropdown-toggle" href="#" role="button"
											id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Link dropdown
										</a>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="#">Ajouter Categorie</a>
											<a class="dropdown-item" href="#">Ajouter Produit</a>
											<a class="dropdown-item" href="#">Alguma coisa aqui</a>
										</div>
									</div>
									<!-- ================= ONLY GUEST CAN SEE THIS ZONE====================== -->

									@guest
									<li class="nav-item">
										<a href="/login" class="nav-link">Login</a>
									</li>
									<li class="nav-item">
										<a href="/register" class="nav-link">Enregistrer</a>
									</li>
									@endguest

									<!-- ================== ONLY AUTH. CAN SEE THIS ZONE ================= -->

									@auth
									<li class="nav-item ">
										<a href="{{ route('create-produit') }}" class="nav-link">Ajouter Produit</a>
									</li>
									<li class="nav-item ">
										<a href="{{ route('create-categorie') }}" class="nav-link">Ajouter Categorie</a>
									</li>	
									<li class="nav-item ">
										<a href="{{ route('create-adresse') }}" class="nav-link">Ajouter Adresse</a>
									</li>
									<li class="nav-item">
										<a href="/dashboard" class="nav-link">Gestion Produit</a>
									</li>
									
									<!--  LOGOUT  -->
									<li class="nav-item">
										<form action="/logout" method="POST">
											@csrf
											<a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
												Quitter
											</a>
										</form>
									</li>
									@endauth

									<!-- ================== ADMIN ACCES ================= -->


									
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</header>
		<!-- ======================================= MAIN ======================================= -->
		<main>
			<div id ="mainContentLayout" class="container h-100">
				<div class="row h-100 justify-content-center align-items-center">
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