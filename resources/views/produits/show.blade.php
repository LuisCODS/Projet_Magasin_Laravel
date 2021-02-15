@extends('layouts.main')
@section('title', {{ $produit->nomProduit }})
@section('content')
<!-- =============== CONTAINER PRODUIT DETAILS  =============== -->

<div class="col-md-10 offset md-1">
	<div class="row">

		<!-- IMAGE -->
		<div id="image_container" class="col-md-6">
			<img src="/img/produits/{{ $produit->img }}" class="img-fluid" alt="{{ $produit->nomProduit }}">
		</div>

		<!-- ATTRIBUTS-->
		<div id="info_container" class="col-6">
			<h1>{{ $produit->nomProduit }}</h1>
			<p>$  {{ $produit->prix }} </p>
			<br>
			<br>
		</div>

		<!-- DESCRIPTION ÉVENEMENT-->
		<div class="col-md-12"  id="description_container" >
			<h3>Description</h3>
			<br>
			<p class="produit_description">{{ $produit->description }}</p><br><br>
		</div>		

	</div>
</div>
@endsection
