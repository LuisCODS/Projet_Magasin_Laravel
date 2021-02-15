@extends('layout.main')
@section('title', 'Creer produit')
@section('content')
<!-- =============== CONTAINER PRODUIT CREATE  =============== -->

<div id="createProduitContainer" class="col-md-6 offset md-3">
	<h2>Nouveau Produit</h2>
    <br>
    <br>
	<form action="{{ route('save-produit') }}" method="POST" enctype="multipart/form-data">
		<!-- Prevencao contra os ataques -->
		@csrf

		<div class="form-group">
			<label for="img">Image</label>
			<input type="file" class="form-control-file" id="img" name="img">
		</div>

		<div class="form-group">
			<label for="prix">Prix</label>
			<input type="text" class="form-control" id="prix" name="prix" required>
		</div>

		<div class="form-group">
			<label for="nomProduit">Nom du produit</label>
			<input type="text" class="form-control" id="nomProduit" name="nomProduit" required>
		</div>

        <div class="form-group">
			<input type="hidden" class="form-control" id="totalStock" name="totalStock">
		</div>

		<div class="form-group">
			<label for="fk_id_categorie">Categorie</label>
			<select class="form-control" id="fk_id_categorie" name="fk_id_categorie" required>
            @foreach($categories as $categorie)
 				<option value="{{ $categorie->id_categorie }}">{{ $categorie->nomCategorie }}</option>
            @endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="description">Description</label>
			<textarea type="text" class="form-control"  id="description" name="description"></textarea>
		</div>

        <div class="form-group">
             <input type="submit"  class="btn btn-primary form-control" value="Enregistrer">
             <br>
             <br>
		</div>

	</form>
</div>
@endsection
