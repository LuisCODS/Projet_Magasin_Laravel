@extends('layouts.main')
@section('title', 'Create categorie')
@section('content')

<!-- ================== Flash message ================== -->
@if(session('msg'))
	<p class="msg">{{ session('msg') }}</p>
@endif

<!-- ================== CATH ERROS ================== -->

<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

<!-- ==================  CREATE FORM ================== -->

<div id="createCategorieContainer" class="col-md-6 offset md-3">
	<h2>Nouvelle Categorie</h2>
	<br>
	<br>
	<form action="{{ route('save-categorie') }}" method="POST" enctype="multipart/form-data">
		<!-- Prevencao contra os ataques -->
		@csrf

		<div class="form-group">
			<label for="nomCategorie">Nom categorie</label>
			<input type="text" class="form-control" id="nomCategorie" name="nomCategorie" 
					value="{{ old('nomCategorie') }}" class="@error('nomCategorie') is-invalid @enderror">
			@error('nomCategorie')
			    <div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="form-group">
			<input type="submit"  class="btn btn-primary form-control" value="Enregistrer">
			<br>
			<br>
		</div>

	</form>
</div>
@endsection