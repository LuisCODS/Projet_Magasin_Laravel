@extends('layouts.main')
@section('title', 'Liste Panier')
@section('content')


    <!-- ================================= Flash message =================================-->

    @if (session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif

    <!--  =======================================  PANIER TABLE  ======================================= -->

    <div id="container_table_produit" class="container-fluid">
        <H2>Liste des Produits</H2><br>
@if(!is_array($cart))

    Nenhum produto no carrinho

                   @else


        <div class="row">
            <div class="col-md-10">
            </div>
            <div class="col-md-2">
                <a href="{{ route('destroy-cart') }}"
                    class="btn btn-info btn-lg active"
                    role="button"
                    aria-pressed="true"><ion-icon
                    name="trash-outline"></ion-icon> Clean all</a><br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th># ID</th>
                            <th>IMAGE</th>
                            <th>TITRE</th>
                            <th>PRIX</th>
                            <th>QUANTITÉ EN STOCK</th>
                            <th>EDITER</th>
                            <th>SUPPRIMER</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id_produit=>$value)
                            <tr>
                               <td>{{ $id_produit }}</td>
                               <td><img src="{{ '/'.$value['img'] }}" height="100" /></td>
                               <td>{{ $value['nomProduit'] }}</td>
                               <td>{{ $value['qtde'] }}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>
@endsection
