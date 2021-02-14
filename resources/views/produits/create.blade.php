@extends('layout.main')
@section('title', 'Creer produit')
@section('content')
<!-- =============== CONTAINER PRODUIT CREATE  =============== -->

<div id="createProduitContainer" class="col-md-6 offset md-3">
	<h2>Nouveau Produit</h2>
    <br>
    <br>
	<form action="/evenement" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="form-group">
			<label for="">Image</label>
			<input type="file" class="form-control-file" id="image" name="image">
		</div>

		<div class="form-group">
			<label for="prix">Prix</label>
			<input type="text" class="form-control" id="prix" name="prix">
		</div>

		<div class="form-group">
			<label for="nomProduit">Nom du produit</label>
			<input type="text" class="form-control" id="nomProduit" name="nomProduit">
		</div>

        <div class="form-group">
			<input type="hidden" class="form-control" id="totalStock" name="totalStock">
		</div>

		<div class="form-group">
			<label for="">Categorie</label>
			<select class="form-control" id="" name="">
 				<option value="1">...</option>
			</select>
		</div>

		<div class="form-group">
			<label for="description">Description</label>
			<textarea type="text" class="form-control"  id="description" name="description" placeholder="Details de l'événement"></textarea>
		</div>
<!--
		<div class="form-group">
			<hr>
			<label for="items">Ajouter les items d'infrastructure</label><br><br>

			<input type="checkbox" name="items[]" value="Chaises" >
			<label for="Chaises"> Chaises</label><br>

			<input type="checkbox" name="items[]" value="Retroprojecteur" >
			<label for="Retroprojecteur"> Rétropro-jecteur</label><br>

			<input type="checkbox" name="items[]" value="Buffet a volonte">
			<label for="Buffet a volonte">Buffet à volonté</label><br>

			<input type="checkbox" name="items[]" value="Boisson alcoolisee">
			<label for="Boisson alcoolisae"> Boisson alcoolisée gratuit</label>
			<hr>
			<input type="submit" class="btn btn-primary" value="Enregistrer"><br><br>
		</div> -->

	</form>
</div>
@endsection
