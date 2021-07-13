<!--
Projet final du cours 2021 fait en Laravel. Il s'agit d'une petite boutique en ligne qui permet aux client d'acheter des vêtements . Un systeme de panier a été crée pour les achats. 
Du côté de l'admin, il y a un CRUD  pour l'ajout de categorie, pour les produits et listage des clients permettant ainsi de familiariser avec la communication client serveur .
 -->

<main class="container">
<div class="nav-scroller py-1 mb-1">
    <nav class="nav d-flex justify-content-center">
        <form action="{{ route('list-all') }}" method="GET">
            @csrf
            {{-- <input type="text" name="search" id="search" class="form-control"> --}}
            <a class="p-2 text-muted"
                href="{{ route('create-categorie') }}"><b>Home</b></a>
            <a class="p-2 text-muted" href="#"><b>Femme</b></a>
            <a class="p-2 text-muted" href="#"><b>Garçon</b></a>
            <a class="p-2 text-muted" href="#"><b>Fille</b></a>
        </form>
    </nav>
</div>
</main> 

<div class="col-md-6 offset md-3"> 

<!--Mot de passe Admin: 005635917 -->

<!-- PAYPAL API credentials :
 EMAIL: sb-cbhcx5229250@personal.example.com
Password: zTG5Y>2%
 -->
