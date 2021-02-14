@extends('layout.main')
@section('title', 'C&A mode')
@section('content')

<!-- ____________________________ CAROUSEL ____________________________ -->

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/carousel/1.png" alt="Primeiro Slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/carousel/2.png" alt="Segundo Slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" ssrc="img/carousel/3.png" alt="Terceiro Slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Próximo</span>
  </a>
</div>
</div>

<!-- ____________________________ ZONA GENRE ____________________________ -->

<div class="row" id="genre_container">
    <div class="col-md-4">
      <img alt="Bootstrap Image Preview" src="/img/genre/avatarHomme.png" class="rounded-circle " />
      <h2 >Pour lui</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursua mollis euismod. Donec sed odio dui.</p>
      <p><a class="btn" href="#">Voir details »</a></p>
    </div>
    <div class="col-md-4">
      <img alt="Bootstrap Image Preview" src="/img/genre/avatarFemme.png" class="rounded-circle" />
      <h2>Pour elle</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac curda magna mollis euismod. Donec sed odio dui.</p>
      <p><a class="btn" href="#">Voir details »</a></p>
    </div>
    <div class="col-md-4">
      <img alt="Bootstrap Image Preview" src="/img/genre/avatarKids.png" class="rounded-circle" />
      <h2>Pour les enfants</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac</p>
      <p><a class="btn" href="#">Voir details »</a> </p>
    </div>
</div>


@endsection