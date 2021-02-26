@extends('layouts.main')
@section('title', 'Create adress')
@section('content')

    <!-- ================== Flash message sucess ================== -->

    @if (session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif

    <!-- ==================  CREATE ADRESSE  ================== -->

    <div id="createAdresseContainer" class="col-xs-12 col-sm-12 col-md-12 ">
        <h2>Nouvelle Adresse</h2>
        <br>
        <br>
        <form action="{{ route('save-adresse') }}" method="POST" enctype="multipart/form-data">
            <!-- Prevencao contra os ataques -->
            @csrf
            @if ('showCheckBox')
                <div class="form-group">
                    <input type="checkbox" name="defaulAdresse" value="checked">
                    Cocher si adresse principale
                </div>
            @endif

            <div class="form-group">
                <label for="nbCivic">Numero Civic</label>
                <input type="text" class="form-control" id="nbCivic" name="nbCivic" placeholder="Entre 1 et 8 chiffres"
                    pattern="^[0-9]{1,8}+?" value="{{ old('nbCivic') }}" class="@error('nbCivic') is-invalid @enderror">
                @error('nbCivic')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="rue">Rue</label>
                <input type="text" class="form-control" name="rue" value="{{ old('rue') }}"  pattern="^[A-Za-z\s]+$"
                placeholder="Seulement des chaînes"
                    class="@error('rue') is-invalid @enderror">
                @error('rue')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="quartie">Quartier</label>
                <input type="text" class="form-control" id="quartie" name="quartie" value="{{ old('quartie') }}"
                        placeholder="Seulement des chaînes" pattern="^[A-Za-z\s]+$"
                    class="@error('quartie') is-invalid @enderror">
                @error('quartie')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="pays">Pays</label>
                <input type="text" class="form-control" id="pays" name="pays" value="{{ old('pays') }}"
                placeholder="Seulement des chaînes" pattern="^[A-Za-z\s]+$"
                    class="@error('pays') is-invalid @enderror">
                @error('pays')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="codePostal">Code Postal</label>
                <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="A0A-0A0 "
               pattern="[A-Za-z][0-9][A-Za-z][-][0-9][A-Za-z][0-9]"

                    value="{{ old('codePostal') }}" class="@error('nbCivic') is-invalid @enderror">
                @error('codePostal')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" value="{{ old('ville') }}"
                placeholder="Seulement des chaînes" pattern="^[A-Za-z\s]+$"
                    class="@error('ville') is-invalid @enderror">
                @error('ville')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- <div class="form-group">
           <input type="checkbox" id="defaulAdresse" name="defaulAdresse"
           value="{{ old('defaulAdresse') }}" class="@error('defaulAdresse') is-invalid @enderror"> <label for="defaulAdresse">Cochez si adresse principale</label>
           @error('defaulAdresse')
                   <div class="alert alert-danger">{{ $message }}</div>
           @enderror
          </div> -->

            <div class="form-group">
                <input type="submit" class="btn btn-primary form-control" value="Enregistrer">
                <br>
                <br>
            </div>
        </form>
    </div>
@endsection
