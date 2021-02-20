@extends('layouts.main')
@section('title', $produit->nomProduit)


@section('content')
<!-- =============== CONTAINER PRODUIT DETAILS  =============== -->


<div class="container">
	<div class="row">
		<div class="col-md-6">
			<!-- IMAGE -->
			<div id="image_container" class="col-md-6">
				<img src="/img/produits/{{ $produit->img }}" class="img-fluid" alt="{{ $produit->nomProduit }}">
			</div>
		</div>
		<div class="col-md-6">
				<h1>Titre: {{ $produit->nomProduit }}</h1>
				<br><br>
				<span>Prix: {{ $produit->getFormatPrice() }} </span>
				<br><br>
				<h4>Description</h4>				
				<p class="produit_description">{{ $produit->description }}</p><br><br>
				<button type="button" class="btn btn-lg btn-info btn-block">Acheter</button>
				<button type="button" class="btn btn-lg btn-info btn-block"><ion-icon id="incon_btn_acheter" name="cart-outline"></ion-icon></button>
		</div>
	</div>
</div>

@endsection
