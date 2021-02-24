@extends('layouts.main')
@section('title', 'Liste categorie')

    <!-- ================================= Flash message =================================-->

    @if (session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif

@section('content')
    <!--  ======================= Liste des Categories ================================ -->

    <div id="container_table_categorie" class="container">
        <H2>Liste des Categories</H2><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover center">
                    <thead class="thead-light">
                        <tr>
                            <th># ID</th>
                            <th>TITRE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $cat)
                            <tr>
                                <td>{{ $cat->id_categorie }}</td>
                                <td>{{ $cat->nomCategorie }}</td>
                                <td><a href="{{ route('edit-categorie', [$cat->id_categorie]) }}"
                                        class="btn btn-primary">Editer</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
