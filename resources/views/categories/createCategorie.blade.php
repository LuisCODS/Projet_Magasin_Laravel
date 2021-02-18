@extends('layouts.main')
@section('title', 'Create categorie')
@section('content')
<!-- ================================= Flash message =================================-->
@if(session('msg'))
<p class="msg">{{ session('msg') }}</p>
@endif
<!-- ================================= FORM CATEGORIE =================================-->
<div id="createCategorieContainer" class="col-md-6 offset md-3">
	<h2 style="text-align: center;">Nouvelle Categorie</h2>
	<form action="{{ route('save-categorie') }}" method="POST" enctype="multipart/form-data">
		<!-- Prevencao contra os ataques -->
		@csrf
		<div class="form-group">
			<label for="nomCategorie">Nom categorie</label>
			<input type="text" class="form-control" id="nomCategorie" name="nomCategorie" required>
		</div>
		<div class="form-group">
			<input type="submit"  class="btn btn-primary form-control" value="Enregistrer">
			<br>
			<br>
		</div>
	</form>
</div>
@endsection