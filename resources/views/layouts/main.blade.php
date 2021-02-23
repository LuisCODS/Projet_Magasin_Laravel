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
                    <nav id="navbar_menu" class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                            <span class="navbar-toggler-icon"></span>
                        </button> <a class="navbar-brand" href="/">C&A Mode</a>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <!-- MENUE COTE GAUCHE -->
                            <ul class="navbar-nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('list-all') }}">Nos produits </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                                </li>
                            </ul>

                            <!-- MENUE COTE DROIT -->
                            <ul class="navbar-nav ml-md-auto">
                                <!-- =================  GUEST INTERFACE ====================== -->
                                @guest
                                    <li class="nav-item">
                                        <a href="/login" class="nav-link">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/register" class="nav-link">Enregistrer</a>
                                    </li>
                                @endguest

                                <!-- ////////////////////////////////// AUTH ZONE - BEGIN //////////////////////////////////////////////// -->
                                @auth

                                    <!-- ================== ADMIN INTERFACE ================= -->

                                    @if (Auth::user()->isAdmin())
                                        <!-- Admin user -->

                                        <!-- <li class="nav-item">
                                           <a href="/dashboard" class="nav-link">Dashboard</a>
                                        </li> -->
                                        <!-- DROPDOWN -->
                                        <div class="dropdown dropleft">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <ion-icon id="icon_outils" name="settings-outline"></ion-icon>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <h6 class="dropdown-header">PRODUITS</h6>
                                                <a class="dropdown-item" href="{{ route('create-produit') }}">Ajouter </a>
                                                <a class="dropdown-item" href="{{ route('list-produit') }}">Lister </a>
                                                <hr>
                                                <h6 class="dropdown-header">CATEGORIES</h6>
                                                <a class="dropdown-item" href="{{ route('create-categorie') }}">Ajouter
                                                </a>
                                                <a class="dropdown-item" href="{{ route('list-categories') }}">Lister </a>
                                                <hr>
                                                <h6 class="dropdown-header">CLIENTS</h6>
                                                <a class="dropdown-item" href="{{ route('list-user') }}">Lister </a>
                                                <a class="dropdown-item" href="/user/profile">
                                                    <ion-icon name="person-outline"></ion-icon> Profil
                                                </a>

                                            </div>
                                        </div>

                                    @else
                                        <!-- normal user -->

                                        <!-- ================== USER INTERFACE ================= -->
                                        <a class="dropdown-item" href="{{ route('list-cart') }}">
                                            <ion-icon name="cart-outline"></ion-icon> Panier
                                                    @if (session()->get('panier'))
                                                        {{ count( $cart['panier'] = session()->get('panier')) }}
                                                    @endif
                                        </a>

                                        <!-- DROPDOWN -->
                                        <div class="dropdown ">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Mon Compte
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="/user/profile">
                                                    <ion-icon name="person-outline"></ion-icon> Profil
                                                </a>
                                                <a class="dropdown-item" href="{{ route('create-adresse') }}">
                                                    <ion-icon name="home-outline"></ion-icon> Ajouter Adresse
                                                </a>
                                            </div>
                                        </div>

                                    @endif

                                    <!--  LOGOUT  -->
                                    <li class="nav-item">
                                        <form action="/logout" method="POST">
                                            @csrf
                                            <a href="/logout" class="nav-link"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                Quitter
                                            </a>
                                        </form>
                                    </li>
                                @endauth
                                <!-- ////////////////////////////////// AUTH ZONE - END //////////////////////////////////////////////// -->
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- ======================================= MAIN ======================================= -->
    <main>
        <div id="mainContentLayout" class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <!-- ================= RENDER PAGES HERE ================= -->
                @yield('content')
                <!-- ==================================================== -->
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!--ICONS : https://ionicons.com/ -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
<!-- ======================================= FOOTER ======================================= -->
<footer>
    <p>LuisCODS- &copy; 2021</p>
    <!-- 		<address>
  <strong>Twitter, Inc.</strong><br /> 795 Folsom Ave, Suite 600<br /> San Francisco, CA 94107<br /> <abbr title="Phone">P:</abbr> (123) 456-7890
  </address> -->
</footer>

</html>
