@extends('layout.main')
@section('title', 'produits')
@section('content')

<h1>Tous nos produits</h1>
<!-- ________________ CONTAINER DES EVENEMENTS ________________ -->
<div id="produit_container" class="col-md-12 ">

	<!--  CONTAINER CARD  -->
	<div id="cards_container" class="row">
		<div class="card" style="width: 18rem;">
			<img class="card-img-top" src="img/pantalon.png" alt="Imagem de capa do card">
			<div class="card-body">
				<h5 class="card-title">Título do card</h5>
				<p class="card-text">Um exemplo de texto rápido conteúdo do card.</p>
				<a href="#" class="btn btn-primary">Visitar</a>
			</div>
		</div>
	</div>

</div>
@endsection
