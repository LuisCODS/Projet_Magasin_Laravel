@extends('layouts.main')
@section('title', 'Mon adresse ')
@section('content')

    <!-- ================== Flash message sucess ================== -->

    @if (session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif

    <!-- ==================  SHOW ADRESSE  ================== -->

    <div id="createAdresseContainer" class="col-md-6 offset md-3">
        <h2>Mon Adresse</h2>
        <br>
        <br>
        <h1>{{ $adresse->id_adresse }}</h1>
        <form action="{{ route('update-adresse', [$adresse->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $adresse->id }}">

            <div class="form-group">
                <input type="checkbox" name="defaulAdresse" value="checked">
                Cocher si adresse principale
            </div>

            <div class="form-group">
                <label for="nbCivic">Numero Civic</label>
                <input type="text" class="form-control" id="nbCivic" name="nbCivic" value="{{ $adresse->nbCivic }}"
                    class="@error('nbCivic') is-invalid @enderror">
                @error('nbCivic')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="rue">Rue</label>
                <input type="text" class="form-control" id="rue" name="rue" value="{{ $adresse->rue }}"
                    class="@error('rue') is-invalid @enderror">
                @error('rue')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="quartie">Quartier</label>
                <input type="text" class="form-control" id="quartie" name="quartie" value="{{ $adresse->quartie }}"
                    class="@error('quartie') is-invalid @enderror">
                @error('quartie')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="pays">Pays</label>
                <input type="text" class="form-control" id="pays" name="pays" value="{{ $adresse->pays }}"
                    class="@error('pays') is-invalid @enderror">
                @error('pays')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="codePostal">Code Postal</label>
                <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="H2E1X2 "
                    value="{{ $adresse->codePostal }}" class="@error('nbCivic') is-invalid @enderror">
                @error('codePostal')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" value="{{ $adresse->ville }}"
                    class="@error('ville') is-invalid @enderror">
                @error('ville')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary form-control" value="Editer">
                <br>
                <br>
            </div>
        </form>
    </div>
@endsection
