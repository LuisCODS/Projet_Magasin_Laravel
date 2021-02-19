@extends('layouts.main')
@section('title', 'Edit produit')
@section('content')
<?php
//dd($__data);
?>
<!-- ===============  PRODUIT  EDIT  =============== -->

<div class="col-md-6 offset md-3">
	<h2 style="text-align: center;">Edition Produit</h2>
    <br>
    <br>
	<form action="/produit/update/{{ $produit->id_produit }}" method="POST" enctype="multipart/form-data">
		<!-- Prevencao contra os ataques -->
		@csrf
		@method('PUT')
		<div class="form-group">
			<!-- <label for="img">Image</label> -->
			<img  src="/img/produits/{{ $produit->img }}" alt="{{ $produit->nomProduit }}" value="{{ old('img') }}" class="img-preview @error('img') is-invalid @enderror">
			<input type="file"  id="img" name="img" class="form-control-file"> 
 			@error('img')<div class="alert alert-danger">{{ $message }}</div>@enderror
		</div>

		<div class="form-group">
			<label for="prix">Prix</label>
			<input type="text" id="prix" name="prix" value="{{  $produit->prix }}" class="form-control @error('prix') is-invalid @enderror">
 			@error('prix')<div class="alert alert-danger">{{ $message }}</div>@enderror
		</div>

		<div class="form-group">
			<label for="nomProduit">Nom du produit</label>
			<input type="text" id="nomProduit" name="nomProduit"
					value="{{  $produit->nomProduit }}" class="form-control @error('nomProduit') is-invalid @enderror">
 			@error('nomProduit')<div class="alert alert-danger">{{ $message }}</div>@enderror
		</div>

        <div class="form-group">
        	<label for="totalStock">Total stock</label>
			<input type="number" id="totalStock" name="totalStock" min="1" max="999999"
				   value="{{  $produit->totalStock }}" class="form-control @error('totalStock') is-invalid @enderror">
 			@error('totalStock')<div class="alert alert-danger">{{ $message }}</div>@enderror
		</div>

		<div class="form-group">
			<label for="categorie">Categorie</label>
			<select class="form-control" id="categorie" name="nomCategorie" >
 				<option value=""  > Selecione </option>
            @foreach($categories as $categorie)
 				<option {{ (old('nomCategorie') === $categorie->id_categorie) ? ' selected ': '' }} value="{{ $categorie->id_categorie }}">{{ $categorie->nomCategorie }}</option>
            @endforeach
			</select>
			@error('NomCategorie')<div class="alert alert-danger">{{ $message }}</div>@enderror
		</div>

		<div class="form-group">
			<label for="description">Description</label>
			<textarea id="description" name="description"  class="form-control @error('description') is-invalid @enderror">{{$produit->description}}</textarea>
 			@error('description')<div class="alert alert-danger">{{ $message }}</div>@enderror
		</div>

        <div class="form-group">
             <input type="submit"  class="btn btn-primary form-control" value="Enregistrer">
             <br>
             <br>
		</div>

	</form>
</div>
@endsection
