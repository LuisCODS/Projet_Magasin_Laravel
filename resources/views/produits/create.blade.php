@extends('layout.main')
@section('title', 'Creer produit')
@section('content')
<!-- =============== CONTAINER PRODUIT CREATE  =============== -->

<div id="createProduitContainer">
	<h1>Create Produit</h1>
	<form class="col-12">
		<div class="form-group">
			<label for="formGroupExampleInput">Example label</label>
			<input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
		</div>
		<div class="form-group">
			<label for="formGroupExampleInput2">Another label</label>
			<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
		</div>
	</form>
</div>
@endsection