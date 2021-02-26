@extends('layouts.main')
@section('title', 'Liste Panier')
@section('content')
    <!-- ================================= Flash message =================================-->
    @if (session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif
    <!--  =======================================  PANIER TABLE  ======================== -->
    <div id="container_table_produit" class="container-fluid">
        {{-- IF NO  CART --}}
        @if (!is_array($cart))
            <H2>Votre panier est vide!</H2>
        @else
            <H2>Mon panier</H2><br>
            <div class="row">
                <div class="col-md-10">
                </div>
                {{-- BOUTTON CLEAN ALL --}}
                <div class="col-md-2">
                    <a href="{{ route('destroy-cart') }}" class="btn btn-info btn-lg active" role="button"
                        aria-pressed="true">
                        <ion-icon name="trash-outline"></ion-icon> Clean All
                    </a><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{-- TABLE PANIER --}}
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th># ID</th> --}}
                                <th>IMAGE</th>
                                <th>PRIX UNITAIRE</th>
                                <th>TITRE</th>
                                <th>QUANTITÉS</th>
                                <th>SOUS - TOTAL</th>
                                <th>EDITER</th>
                                <th>SUPPRIMER</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sous_total = 0;
                                $grand_total = 0;
                                $total = 0;
                                $tvq = 0;
                                $tps = 0;
                            @endphp

                            @foreach ($cart as $id_produit => $value)
                                <tr>
                                    {{-- <td>{{ $id_produit }}</td> --}}
                                    <td><img src="{{ '/' . $value['img'] }}" height="100" /></td>
                                    <td>{{ $value['prix'] }} $</td>
                                    <td>{{ $value['nomProduit'] }}</td>
                                    <td>{{ $value['qtde'] }}</td>
                                    <td>{{ $value['qtde'] * $value['prix'] }} $</td>

                                    @php $sous_total =  $sous_total + $value['qtde'] * $value['prix']  ; @endphp

                                    <td>
                                        {{-- BOUTTON ADD + --}}
                                        <a href="/cart/add/{{ $id_produit }}" class="btn btn-secondary btn-lg active"
                                            role="button" aria-pressed="true">
                                            <ion-icon name="add-outline"></ion-icon>
                                        </a>
                                        {{-- BOUTTON REMOVE --}}
                                        <a href="/cart/remove/{{ $id_produit }}" class="btn btn-secondary btn-lg active"
                                            role="button" aria-pressed="true">
                                            <ion-icon name="remove-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        {{-- BOUTTON REMOVE ONE --}}
                                        <a href="/cart/remove-item/{{ $id_produit }}" class="btn btn-info btn-lg active"
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
            <!--  =======================================  DETAILS COMMANDE ======================== -->
            <div id="container_commade_panier" class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            {{-- PAYPAL IMAGE --}}
                            <div class="col-md-6">
                                <img src="{{ '/img/paypal-paiement-en-ligne.jpg' }}" alt="Paypal Image" height="250" />
                            </div>
                            {{-- DETAILS COMMANDE --}}
                            <div class="col-md-6">
                                <h3> Details de la commande</h3><br>
                                {{-- TABLE COMMANDE --}}
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sous-total </th>
                                            <th></th>
                                            <th></th>
                                            <td>{{ $sous_total }} $</td>
                                        </tr>
                                    </thead>
                                    <?php
                                    $tvq = ($sous_total * 9.975) / 100;
                                    $tps = ($sous_total * 5) / 100;
                                    $grandTotal = $sous_total + $tvq + $tps;
                                    ?>
                                    <tbody>
                                        <tr>
                                            <th>tvq</th>
                                            <td></td>
                                            <td></td>
                                            <td> {{ round($tvq, 2) }} $ </td>
                                        </tr>
                                        <tr>
                                            <th>tps</th>
                                            <td></td>
                                            <td></td>
                                            <td> {{ round($tps, 2) }} $</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td></td>
                                            <td></td>
                                            <td> {{ round($grandTotal, 2) }} $ </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a type="button" href="{{ route('checkout-cart') }}" class="btn btn-info btn-lg btn-block">Passer la commande</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
