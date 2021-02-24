@extends('layouts.main')
@section('title', 'Mes Adresses')
@section('content')
    <!-- ================================= Flash message =================================-->
    @if (session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif
    <!--  =======================================  ADRESSE TABLE  ======================== -->
    <div  class="container-fluid">

        {{-- IF NO  ARRAY  --}}
        @if (count($adresses) <= 0)
            <H2>Vous n'avez pas d'adresse au systeme!</H2>
        @else
            <H2>Mon adresser</H2><br>

            <div class="row">
                <div class="col-md-10">
                </div>
                <div class="col-md-2">
                    {{-- BOUTTON   --}}
                    <a href="" class="btn btn-info btn-lg active" role="button" aria-pressed="true">
                        <ion-icon name="trash-outline"></ion-icon> Clean All
                    </a><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th># ID</th> --}}
                                <th>#</th>
                                <th># </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adresses as $adresse)
                                <tr>
                                    <td>{{ $adresse->quartie }} $</td>
                                    <td>
                                        {{-- BOUTTON ADD + --}}
                                        <a href="" class="btn btn-secondary btn-lg active"
                                            role="button" aria-pressed="true">
                                            <ion-icon name="add-outline"></ion-icon>
                                        </a>
                                         {{-- BOUTTON REMOVE  --}}
                                        <a href="" class="btn btn-secondary btn-lg active"
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
        @endif
    </div>
@endsection
