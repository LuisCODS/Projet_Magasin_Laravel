@extends('layouts.main')
@section('title', 'Edit categorie')
@section('content')
    <!-- ================================= Flash message =================================-->

    @if (session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif

    <!--  =======================================  CATEGORIE UPDATE   ======================================= -->
    <div class="col-md-6 offset md-3">
        <h2 style="text-align: center;">Edition Categorie</h2>
        <form action="{{ route('update-categorie', [$categorie->id_categorie]) }}" method="POST" >
            <!-- Prevencao contra os ataques -->
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nomCategorie">Nom categorie</label>
                <input type="text" class="form-control" value="{{ $categorie->nomCategorie }}" name="nomCategorie" required>
                <input type="hidden"  value="{{ $categorie->id_categorie }}" name="{{ $categorie->id_categorie }}" >
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary form-control" value="Enregistrer">
                <br><br>
            </div>
        </form>
    </div>
@endsection
