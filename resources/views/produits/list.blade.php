@extends('layouts.main')
@section('title', 'Liste Produits')
<!-- ================================= Flash message =================================-->
@if(session('msg'))
<p class="msg">{{ session('msg') }}</p>
@endif
@section('content')
<!--  =======================================  PRODUIT TABLE  ======================================= -->
<div id="tableProduits" class="container-fluid">
	<H2>Liste des Produits</H2><br>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-hover">
				<thead class="thead-light">
					<tr>
						<th># ID</th>
						<th>IMG</th>
						<th>TITRE</th>
						<th>PRIX</th>
						<th>QUANTITÉ</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
					@foreach($produits as $produit)
					<tr>
						<td>{{ $produit->id_produit }}</td>
						<td><img style="width: 100px; height:100px;"  class="image-preview" src="/img/produits/{{ $produit->img }}"></td>
						<td>{{ $produit->nomProduit }}</td>
						<td>${{ $produit->prix }}</td>
						<td>{{ $produit->totalStock }}</td>
						<td><a href="/produit/edit/{{ $produit->id_produit }}" class="btn btn-primary">Editer</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection