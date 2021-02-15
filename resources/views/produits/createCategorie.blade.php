@extends('layouts.main')
@section('title', 'Create categorie')
@section('content')

<!-- ================================= Flash message =================================-->

@if(session('msg'))
<p class="msg">{{ session('msg') }}</p>
@endif

<!-- ================================= FORM CATEGORIE =================================-->

<div id="createCategorieContainer" class="col-md-6 offset md-3">
	<h2>Nouvelle Categorie</h2>
    <br>
    <br>
	<form action="{{ route('save-categorie') }}" method="POST" enctype="multipart/form-data">
		<!-- Prevencao contra os ataques -->
		@csrf
		<div class="form-group">
			<label for="nomCategorie">Nom categorie</label>
			<input type="text" class="form-control" id="nomCategorie" name="nomCategorie" required>
		</div>
	</form>
</div>

@endsection
