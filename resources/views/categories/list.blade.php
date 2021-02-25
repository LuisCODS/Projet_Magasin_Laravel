@extends('layouts.main')
@section('title', 'Liste categorie')
@section('content')
    <!-- ================================= Flash message =================================-->

    {{-- @if (session('msg'))
        <p class="msg">{{ session('error') }}</p>
    @endif --}}
    @include('flash-message')
    @yield('content')
    
    <!--  ======================= Liste des Categories ================================ -->

    <div id="container_table_categorie" class="container">
        <H2>Liste des Categories</H2><br>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <table class="table table-bordered table-hover center">
                    <thead class="thead-light">
                        <tr>
                            <th># ID</th>
                            <th>TITRE</th>
                            <th>EDITER</th>
                            <th>SUPPRIMER</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $cat)
                            <tr>
                                <td>{{ $cat->id_categorie }}</td>
                                <td>{{ $cat->nomCategorie }}</td>
                                <td>
                                    <a href="{{ route('edit-categorie', [$cat->id_categorie]) }}"
                                        class="btn btn-primary">Editer
                                     </a>
                                </td>
                                <td>
                                    <a href="{{ route('destroy-categorie', [$cat->id_categorie]) }}"
                                        class="btn btn-danger">Supprimer
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
