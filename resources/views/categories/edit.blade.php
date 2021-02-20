@extends('layouts.main')
@section('title', 'Edit categorie')
<!-- ================================= Flash message =================================-->

@if(session('msg'))
<p class="msg">{{ session('msg') }}</p>
@endif


@section('content')

<!--  =======================================  CATEGORIE UPDATE   ======================================= -->

<div  class="col-md-6 offset md-3">
	<h2 style="text-align: center;">Edition Categorie</h2>
	<form  action="{{ route('update-categorie', [$categorie->id_categorie]) }}" method="POST" >

		<!-- Prevencao contra os ataques -->
		@csrf
		@method('PUT')
		<div class="form-group">
			<label for="nomCategorie">Nom categorie</label>
			<input type="text" class="form-control" id="nomCategorie" value="{{ $categorie->nomCategorie }}" name="nomCategorie" required>
		</div>
		<div class="form-group">
			<input type="submit"  class="btn btn-primary form-control" value="Enregistrer">
			<br>
			<br>
		</div>
	</form>
</div>
@endsection
