@extends('layout.main')
@section('title', 'C&A mode')
@section('content')

<!-- ____________________________ CAROUSEL ____________________________ -->

<!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="/img/carousel/1.png" alt="Primeiro Slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/img/carousel/2.png" alt="Segundo Slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" ssrc="/img/carousel/3.png" alt="Terceiro Slide">
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
</div> -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="/img/carousel/1.png" alt="Primeiro Slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/img/carousel/2.png" alt="Segundo Slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src=".../800x400?auto=yes&bg=555&fg=333&text=Terceiro Slide" alt="Terceiro Slide">
    </div>
  </div>
</div>
<!-- ____________________________ ZONA GENRE ____________________________ -->

<div class="row" id="genre_container">
    <div class="col-md-4">
      <img alt="Bootstrap Image Preview" src="/img/genre/avatarHomme.png" class="rounded-circle " />
      <h2 >Pour lui</h2>
      <p>Découvrez les nouveaux styles dont votre garde-robe a besoin parmi notre gamme de vêtements pour homme. Vous y trouverez une foule d'articles de tous les jours, dont des hauts et des t-shirts, ainsi que des tenues de détente et des sous-vêtements confortables. Un événement officiel en vue? Ne cherchez pas plus loin que nos blazers et complets pour homme pour un look branché. </p>
      <p><a class="btn" href="#">Voir details »</a></p>
    </div>
    <div class="col-md-4">
      <img alt="Bootstrap Image Preview" src="/img/genre/avatarFemme.png" class="rounded-circle" />
      <h2>Pour elle</h2>
      <p>Actualisez vos styles au quotidien avec notre gamme de vêtements pour femme. Vos pièces les plus tendance sont réunies au même endroit. Découvrez nos basiques de tous les jours, comme les hauts pour femme et les jupes, ainsi que les tricots indispensables et les vêtements de détente confortables pour les jours de farniente. Vous prévoyez sortir? </p>
      <p><a class="btn" href="#">Voir details »</a></p>
    </div>
    <div class="col-md-4">
      <img alt="Bootstrap Image Preview" src="/img/genre/avatarKids.png" class="rounded-circle" />
      <h2>Pour les enfants</h2>
      <p>Besoin de nouveaux essentiels de tous les jours pour enfant? Vous trouverez ici une vaste sélection de hauts et t-shirts pour enfant aux couleurs vives et aux motifs adorables qui leur plairont. Associez leur cardigan ou leur chandail préféré à nos jeans et pantalons pour enfant - vous trouverez une foule de coupes et de styles, y compris des pantalons chinos et des pantalons cargo...</p>
      <p><a class="btn" href="#">Voir details »</a> </p>
    </div>
</div>


@endsection