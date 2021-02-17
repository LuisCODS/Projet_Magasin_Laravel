@extends('layouts.main')
@section('title', 'Liste categorie')



@section('content')
<!--  =======================================  CATEGORIE TABLE  ======================================= -->

<div id="tableCategorie" class="container-fluid">
	<H2>Liste des Categories</H2><br>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-hover">
				  <thead class="thead-light">
					<tr>
						<th># ID</th>
						<th>Nom</th>
						<th>Action</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $cat)
					<tr>
						<td>{{ $cat->id_categorie }}</td>
						<td>{{ $cat->nomCategorie }}</td>
						<td><a  href="/categorie/delete/{{$cat->id_categorie}}" class="btn btn-outline-danger"   role="button">Delete </a></td>
						<td><a  href="/categorie/edit/{{$cat->id_categorie}}" class="btn btn-outline-secondary"   role="button">Edite </a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection