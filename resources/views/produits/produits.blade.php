@extends('layout.main')
@section('title', 'produits')
@section('content')

<!-- ________________ CONTAINER SERCHE EVENEMENT ________________ -->
@if(session('msg'))
    <p class="msg">{{ session('msg') }}</p>
@endif

<div id="search_container" class="col-md-12">
	<h3>Cherche un produit</h3>
	<form action="/" method="GET">
		 @csrf
		<input type="text" name="search" id="search" class="form-control" placeholder="Cherche...">
	</form>
</div>

<!--  CONTAINER CARD  -->


        <!-- ________________ CONTAINER PRODUIT ________________ -->
        <div id="produit_container" class="col-md-12 ">
            <!--  CONTAINER CARD  -->
            <div id="cards_container" class="row">
            @foreach($produits as $produit)
                <div class=" col-md-3" style="width: 18rem;">
                    <img class="card-img-top" src="img/pantalon.png" alt="{{ $produit->nomProduit }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produit->nomProduit }}</h5>
                        <p class="card-text">${{ $produit->prix }}</p>
                        <a href="#" class="btn btn-primary">Details</a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>


@endsection