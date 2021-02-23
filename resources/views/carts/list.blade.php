@extends('layouts.main')
@section('title', 'Liste Panier')
@section('content')
    <!-- ================================= Flash message =================================-->
    @if (session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif
    <!--  =======================================  PANIER TABLE  ======================== -->
    <div id="container_table_produit" class="container-fluid">

        {{-- IF NO  ARRAY  --}}
        @if (!is_array($cart))
            <H2>Votre panier est vide!</H2>
        @else
            <H2>Mon panier</H2><br>

            <div class="row">
                <div class="col-md-10">
                </div>
                <div class="col-md-2">
                    <a href="{{ route('destroy-cart') }}" class="btn btn-info btn-lg active" role="button"
                        aria-pressed="true">
                        <ion-icon name="trash-outline"></ion-icon> Clean all
                    </a><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th># ID</th>
                                <th>IMAGE</th>
                                <th>PRIX</th>
                                <th>TITRE</th>
                                <th>QUANTITÉ</th>
                                <th>EDITER</th>
                                <th>SUPPRIMER</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id_produit => $value)
                                <tr>
                                    <td>{{ $id_produit }}</td>
                                    <td><img src="{{ '/' . $value['img'] }}" height="100" /></td>
                                       <td>${{ $value['prix'] }}</td>
                                    <td>{{ $value['nomProduit'] }}</td>
                                    <td>{{ $value['qtde'] }}</td>
                                    <td>
                                        <a href="" class="btn btn-secondary btn-lg active"
                                            role="button" aria-pressed="true">
                                            <ion-icon name="add-outline"></ion-icon>
                                        </a>
                                        <a href="" class="btn btn-secondary btn-lg active"
                                            role="button" aria-pressed="true">
                                            <ion-icon name="remove-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-info btn-lg active"
                                            role="button" aria-pressed="true">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
