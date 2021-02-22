@extends('layouts.main')
@section('title', 'Create produit')
@section('content')
<!-- Flash message -->
@if(session('msg'))
    <p class="msg">{{ session('msg') }}</p>
@endif
<!-- ============================== FORM SEARCHE PRODUIT  ============================== -->
<div id="search_container" class="col-md-12">
    <h3>Cherche un produit</h3>
    <form action="{{ route('list-all') }}" method="GET">
        @csrf
        <input type="text" name="search" id="search" class="form-control" placeholder="Cherche...">
    </form>
</div>
<!-- ============================== MSN  SEARCHE PRODUIT  ============================== -->
@if( count($produits) == 0 && $search)
       <p>Aucune produit trouvé avec le mot: <b>{{ $search }}</b> <br><a href="{{ route('list-all') }}">Voir nos produits! </a></p>
@elseif(count($produits) == 0)
    <p>Aucun produit disponible! </p>
@endif

<!-- @error('qnt')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror -->
<!-- ============================== CONTAINER PRODUIT ============================== -->
<div  class="col-md-12 ">
    <!--  CONTAINER CARD  -->
    <div id="cards_container" class="row">
        @foreach($produits as $produit)
        <div id="divCardBorder" class="col-md-3 ">
            <img class="card-img-top" src="{{ $produit->img }}" alt="{{ $produit->nomProduit }}">
            <div class="card-body">
                <h5 class="card-title">{{ $produit->nomProduit }}</h5>
                <p class="card-text">{{ $produit->getFormatPrice() }}</p>
                @if(Auth::user())
                    <!-- <a href="/cart/add/{{ $produit->id_produit }}"><ion-icon id="panier" name="cart-outline"></ion-icon></a><br> -->
                    <form action="{{ route('store-cart') }}" method="POST">
                    @csrf
                            <!-- Quantité <input type="number" id="qnt" name="qnt" min="1" max="20"  placeholder="0" pattern="[0-9]{1,2}?"
                            value="{{ old('qnt') }}" class="@error('qnt') is-invalid @enderror" require ><br><br> -->
                            <!-- @error('qnt')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror -->
                            <input type="hidden"  name="id_produit"    value="{{ $produit->id_produit }}">
                            <input type="submit"  class="btn btn-primary form-control" value="Add cart"><br><br>
                    </form>
                @endif
                <a href="/produit/{{ $produit->id_produit }}" class="btn btn-primary form-control">Details</a><br>
            </div>
        </div>

        @endforeach
    </div>
</div>
@endsection
