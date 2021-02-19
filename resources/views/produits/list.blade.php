@extends('layouts.main')
@section('title', 'Liste Produits')
@section('content')


<!-- ================================= Flash message =================================-->

@if(session('msg'))
<p class="msg">{{ session('msg') }}</p>
@endif

<!--  =======================================  PRODUIT TABLE  ======================================= -->

<div id="container_table_produit" class="container-fluid">
	<H2>Liste des Produits</H2><br>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-hover">
				<thead class="thead-light">
					<tr>
						<th># ID</th>
						<th>IMAGE</th>
						<th>TITRE</th>
						<th>PRIX</th>
						<th>QUANTITÉ EN STOCK</th>
						<th>EDITER</th>
						<th>SUPPRIMER</th>
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
						<td><a href="/produit/destroy/{{ $produit->id_produit }}" class="btn btn-danger">Supprimer</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection