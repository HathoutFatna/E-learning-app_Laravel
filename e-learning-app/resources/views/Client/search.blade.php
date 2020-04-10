@extends('Client/index')
<link rel="stylesheet" href="{{ asset('css/latif/card.css') }}">
<style>
    .filtre{
        float:right;
        margin-right:15%;

    }
    .inline{
        display:inline;
        margin-top:5px;
        font-size:18;
    }
    .inlineb{
        display:inline-block;

    }
    .btnn{
        cursor:pointer;
        background:white;
        border:2px solid black;
        padding:5px 20px 5px 20px;
        border-radius:5px;
    }
    .btnn:hover{
        transform:scale(1.25);
    }
    .select{
        background:#CFCFCF;
        color:black;
        border:0;
        font-size:15;
        padding:2px 20px 2px 20px;
    }
    #card-select{
        margin-left:10px;
        margin-right:10px;
    }
</style>
@section('course')

    <div style="height:auto;width:90%;background:;margin:0 5% 10px 5%;">
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

                                        <!-- @if($cour->image)
                                            {{ $cour->image->getUrl() }}
                                                <a href="{{ $cour->image->getUrl() }}" target="_blank">
                            <img src="{{ asset('storage\8\5e28b75f7df08_javascript1.jpg')}}" alt="hhh">
                        </a>
                @endif-->
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
    </div>
    <div style="width:90%;background:;margin:0 5% 10px 5%;">
        <button class="inlineb btnn" style="margin-right:35%;float:right;">Page Suivante</button>
        <button class="inlineb btnn" disabled="disabled" style="margin-left:40%;border-radius:5px;">Page Précedente</button>
    </div>
@endsection

