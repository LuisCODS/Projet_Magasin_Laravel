@extends('layouts.main')
@section('title', 'Create categorie')
@section('content')
<!-- ================================= Flash message =================================-->
@if (session('msg'))
<p class="msg">{{ session('msg') }}</p>
@endif
<!-- ================================= FORM CATEGORIE =================================-->
<div class="col-xs-12 col-sm-12 col-md-12">
    <h2 style="text-align: center;">Nouvelle Categorie</h2>
    <br>
    <br>
    <form action="{{ route('save-categorie') }}" method="POST" enctype="multipart/form-data">
        <!-- Prevencao contra os ataques -->
        @csrf

        <div class="form-group">
            <label for="nomCategorie">Nom categorie</label>
            <input type="text" name="nomCategorie" value="{{ old('nomCategorie') }}"
                class="form-control @error('nomCategorie') is-invalid @enderror">
            @error('nomCategorie')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary form-control" value="Enregistrer">
            <br>
            <br>
        </div>
    </form>
</div>
@endsection
