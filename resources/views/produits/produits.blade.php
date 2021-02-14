@extends('layout.main')
@section('title', 'produits')
@section('content')

<!-- ________________ CONTAINER SERCHE EVENEMENT ________________ -->

<div id="search_container" class="col-md-12">
	<h2>Cherche un événement</h2>
	<form action="/" method="GET">
		 @csrf
		<input type="text" name="search" id="search" class="form-control" placeholder="Cherche...">
	</form>
</div>

<!--  CONTAINER CARD  -->

    @foreach($produits as $produit)
        <!-- ________________ CONTAINER DES EVENEMENTS ________________ -->
        <div id="produit_container" class="col-md-12 ">
            <!--  CONTAINER CARD  -->
            <div id="cards_container" class="row">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="img/pantalon.png" alt="{{ $produit->nomProduit }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produit->nomProduit }}</h5>
                        <p class="card-text">${{ $produit->prix }}</p>
                        <p class="card-text">Categorie : </p>
                        <p class="card-text">Um exemplo de texto rápido conteúdo do card.</p>
                        <a href="#" class="btn btn-primary">Visitar</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
