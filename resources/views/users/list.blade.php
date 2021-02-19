@extends('layouts.main')
@section('title', 'List users')
@section('content')
<!--  =======================================  USER TABLE  ======================================= -->
<div id="container_table_user" class="container-fluid">
	<H2>Liste de Clients</H2><br>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-hover">
				  <thead class="thead-light">
					<tr>
						<th># ID</th>
						<th>Nom</th>
						<th>Email</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<!-- DISPLAY ALL WITHOUT ADMIN -->
					@foreach($users as $user)
					@if($user->isAdmin != 1)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td> Membre </td>
						<td><a  onClick="desactiverUser();" class="btn btn-outline-danger"  role="button">Desactiver </a></td>
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection