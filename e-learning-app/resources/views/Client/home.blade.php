@extends('Client/index')
<link rel="stylesheet" href="{{ asset('css/latif/card.css') }}">
<link rel="stylesheet" href="{{ asset('css/latif/slider.css') }}">
<script src="{{ asset('js/latif/slider.js') }}"></script>
<style>
#contact{
  Margin-left:45%;
  background-color:white;
  color:#0e3368;
  border:2px solid #0e3368;
  border-radius:5px;
  padding:10px 30px 10px 30px;
  font-size:20px;
}
#contact:hover{
  background-color:#0e3368;
  color:white;
  border:2px solid #0e3368;
  transform:scale(1.25);
}
.divc{
  height:200px;
  width:90%;
  background:white;
  margin:10px 5% 10px 5%;
}
.inlined{
  display:inline-block;
}
</style>
@section('home')


<!-- title cards -->
<div class="new-slider">
        <figure class="out">
            <img src="{{ asset('img/slider.svg') }}" alt=""/>
        </figure>
        <figure class="out">
            <img src="{{ asset('img/slider.svg') }}" alt=""/>
        </figure>
    <figure class="out">
        <img src="{{ asset('img/slider.svg') }}" alt=""/>
    </figure>

        <div class="arrow-new left-a" onclick="sliderOpacity(this)" data-direccion="left" data-index="0">
            <i class="fa fa-arrow-left"></i>
        </div>
        <div class="arrow-new right-a" onclick="sliderOpacity(this)" data-direccion="right" data-index="0">
            <i class="fa fa-arrow-right"></i>
        </div>
</div>
<!--<div  style="background:;height:450px;width:96%;margin:20px 2% 20px 2%;" ><img style="height: 450px;width: 100%" src="{{ asset('img/slider.svg') }}"/> </div>-->
<div class="divc">
  <div class="inlined" style="height:150px;width:150px;margin:25px;position:absolute;border-radius:20px;"><img src="data:image/jpeg;base64,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" alt="" style="height:150px; width:150px;border-radius:20px;"></div>
    <div class="inlined">
    <h2 style="display:block;margin-left:19%;">Votre avenir commence ici !</h2>
    <p  style="display:block;margin-left:19%;width:70%">
      Dirassati est une plateforme E-learning qui offres des milliers de cours en ligne gratuits dans plusieurs domaines et catégories, On vous permet donc de commencer votre carrière educatifs et professionnels.</p>
    </div></div>
<div class="divc">
  <div class="inlined" style="height:150px;width:150px;margin:25px;position:flex;float:right;border-radius:20px;"><img src="data:image/png;base64,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" alt="" style="height:150px; width:150px;border-radius:20px;"></div>
  <h2 style="margin-left:5%;">Améliorer vos compétences !</h2>
  <p class="inlined" style="margin-left:5%;width:70%">Passez des tests d'évaluations à la fin de chaque cours pour améliorer vos connaissances et connaître votre niveau d'apprentissage sur la plateforme Dirassati.</p>
</div>
<div class="divc">
    <div class="inlined" style="height:150px;width:150px;margin:25px;position:absolute;border-radius:20px;"><img src="data:image/jpeg;base64,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" alt="" style="height:150px; width:150px;border-radius:20px;"></div>
    <div class="inlined">
        <h2 style="display:block;margin-left:30%;">Atteindre vos objectifs personnels et professionnels !</h2>
        <p  style="display:block;margin-left:30%;width:70%">
            Inscrivez-vous maintenant pour recevoir des recommandations personnalisées du catalogue complet Dirassati.</p>
    </div></div>

<!-- title cards -->
<div id="title_card" style="width:58%;background:white; margin-top:10px;padding-left:20px;padding-left:42%">
  <h2>Nos Cours proposés</h2>
</div>

<!-- course card -->
  <section id="card-select">
    <div>
      <div>
        <div class="col-sm-12">
          <ul class="cards-list">

              @foreach($cours as $cour)
                  <li class="card card--course card--partner card--partner_sibur">
                      <div class="card__front">
                          <div class="card__cover" style="@if($cour->image)background-image: url({{ $cour->image->getUrl() }})@endif;"></div>
                          <div class="card__content">
                              <ul class="card-labels">
                                  <li class="card__label card__label--collection_sibur">{{ $cour->category->nom ?? '' }}</li>
                              </ul>
                              <div class="card__title">
                                  {{ $cour->titre }}
                              </div>
                              <!-- <ul class="card__speakers">
                                    <li class="card__speaker">------</li>
                                  </ul> -->
                              <div class="card__details card__details--fixed_bottom">
                    <span class="card__details-item">
                      <i class="fa fa-clone"></i>  {{ $cour->coursChapitres->count() }} Chapitres
                    </span>
                              </div>
                          </div>
                      </div>
                      <div class="card__backward">
                          <div class="card__content">
                              <ul class="card-labels">
                                  <li class="card__label card__label--collection_sibur">{{ $cour->titre }}</li>
                              </ul>
                              <div class="card__desc">
                                  <p>{{ $cour->description }}</p>
                              </div>
                              <p>Les Professeurs :</p>
                              <ul class="card-labels">

                                  @foreach($cour->enseignants as $key => $item)
                                      <li class="card__label card__label--collection_sibur">{{ $item->name }}</li>
                                  @endforeach

                              </ul>
                              <div class="card-controls--bottom">
                                  <a href="{{ route('cours.show', $cour->id) }}" class="card__btn card__btn--default">Accéder Au Cours</a>
                              </div>
                          </div>
                      </div>
                  </li>
              @endforeach

          </ul>
        </div>
      </div>
    </div>
  </section>
<!-- Nos professeurs -->
  <div style="background:white;height:150px;width:100%">
    <p style="font-size:30;Margin-left:37%; color:#0e3368">Nous sommes là pour vous aider.</p>
      <a href="mailto:Dirassati@gmail.com"> <button id="contact">Nous Contacter</button></a>
  </div>

    @endsection
