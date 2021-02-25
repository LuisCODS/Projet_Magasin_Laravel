@extends('layouts.main')
@section('title', 'Liste Adresses')
@section('content')

    <!-- ================================= Flash message =================================-->

    @if (session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif

    <!--  =======================================  ADRESSE TABLE  ======================================= -->

    <div id="container_table_adresse" class="container">
        <H2>Mes adresses</H2><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hove center">
                    <thead class="thead-light">
                        <tr>
                            <th>Numero Civic</th>
                            <th>Rue</th>
                            <th>Quartier</th>
                            <th>Pays</th>
                            <th>Code Postal</th>
                            <th>Ville</th>
                            <th>Principale</th>
                            <th>ACTION</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adresses as $adresse)
                            <tr>
                                <td>{{ $adresse->nbCivic }}</td>
                                <td>{{ $adresse->rue }}</td>
                                <td>{{ $adresse->quartie }} </td>
                                <td>{{ $adresse->pays }}</td>
                                <td>{{ $adresse->codePostal }}</td>
                                <td>{{ $adresse->ville }}</td>
                                <td>{{ $adresse->defaulAdresse == '1' ? 'Oui' : 'Non' }}</td>
                                <td><a href="{{ route('edit-adresse', [$adresse->id]) }}"
                                        class="btn btn-primary">Editer</a></td>
                                <td><a href="{{ route('destroy-adresse', [$adresse->id]) }}"
                                        class="btn btn-danger">Supprimer</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
