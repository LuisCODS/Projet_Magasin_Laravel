@extends('layouts.main')
@section('title', 'Create produit')
@section('content')

<!-- Flash message -->

@if(session('msg'))
    <p class="msg">{{ session('msg') }}</p>
@endif

<!-- ============================== FORM SEARCHE PRODUIT  ============================== -->

<div id="search_container" class="col-md-12">
    <h3>Cherche un produit</h3>
    <form action="{{ route('list-all') }}" method="GET">
        @csrf
        <input type="text" name="search" id="search" class="form-control" placeholder="Cherche...">
    </form>
</div>

<!-- ============================== MSN  SEARCHE PRODUIT  ============================== -->

@if( count($produits) == 0 && $search)
       <p>Aucune produit trouvé avec le mot: <b>{{ $search }}</b> <br><a href="{{ route('list-all') }}">Voir nos produits! </a></p> 
@elseif(count($produits) == 0)
    <p>Aucun produit disponible! </p>

@endif

<!-- ============================== CONTAINER PRODUIT ============================== -->
<div id="produit_container" class="col-md-12 ">
    <!--  CONTAINER CARD  -->
    <div id="cards_container" class="row">
        @foreach($produits as $produit)
        <div id="divCardBorder" class="col-md-3" >
            <img class="card-img-top" src="/img/produits/{{ $produit->img }}" alt="{{ $produit->nomProduit }}">
            <div class="card-body">
                <h5 class="card-title">{{ $produit->nomProduit }}</h5>
                <p class="card-text">${{ $produit->prix }}</p>
                <a href="/produit/add-cart/{{ $produit->id_produit }}"><ion-icon id="panier" name="heart-outline"></ion-icon></a><br>
                <a href="/produit/{{ $produit->id_produit }}" class="btn btn-primary">Details</a><br>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
