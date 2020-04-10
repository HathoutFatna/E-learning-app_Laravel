@extends('Client/index')
<style>
    *{
        text-decoration:none;
        list-style: none;
    }
    #kolch{
        background:;
        margin:10px 10% 10px 10px;
        height:auto;
        width:85%;

    }
    .inline-block{
        display:inline-block;
    }
    .inline{
        display:inline;
    }
    .page{
        padding: 5px 10px;
    }
    .left-p{
        background:white;
        float:left;
        height:auto;
        width:23%;
        margin-right:2%;
        padding:15px;
        box-shadow: 4px 1px 10px  rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .left-p p{
        margin:0;
        font-size:20px;
        text-decoration: underline;
        text-transform: capitalize;
    }
    .left-p li{
        font-size:18px;
        text-transform: capitalize;
        margin:0;

    }
    .right-p{
        background:;

        height: auto;
        width:70%;
        padding:10px;
        box-shadow: 4px 1px 10px  rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .right-p h2{
        text-transform: capitalize;
        margin:0;
    }
    .right-p #desc{
        background:white;
        padding:2px;
        border-radius:5px;
        word-wrap:break-word;
    }
    .right-p #text{
        background:white;
        padding:2px;
        word-wrap:break-word;
        box-shadow: 4px 1px 10px  rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>

@section('lecon_detail')
<div id="kolch">
    <div class="left-p inline-block">
        <div>
            <p> Chapitre : {{$lecon->chapitre->titre}}</p>
            <ul>
                @foreach($lecon->chapitre->chapitreLecons as $key => $ll)
                <li><a href="{{ route('lecons.show', $ll->id) }}"
                @if ($ll->id == $lecon->id)  style="font-weight: bold;background-color:#3B83B1;color:white;padding:0 5px 0 5px;border-radius:3px;" @endif>{{ $ll->titre }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="right-p inline-block">
        <div>
        <h2>{{ $lecon->titre }}</h2>
            <hr/>
            <h4>Les images</h4>
            @foreach($lecon->images as $key => $media)
                <a href="{{ $media->getUrl() }}" target="_blank">
                    <img src="{{ $media->getUrl() }}" width="350px" height="200px" >
                </a>
            @endforeach
            <hr/>
            <h4>Les fichiers</h4>

            @foreach($lecon->fichiers as $key => $media)
                <a href="{{ $media->getUrl() }}" target="_blank">
                    fichier {{ $loop->iteration }}
                </a>
            @endforeach
            <hr/>

        <p id="desc"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $lecon->description }}</p>
            <br/>
        <p id="text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $lecon->texte_long }}</p>


        <hr/>

        @if($previous_lecon)
            <p style="background:#3B83B1;border-radius: 5px;color:white; " class="inline page"> <a href="{{ route('lecons.show', $previous_lecon->id) }} " style="text-decoration: none;color: white;" >
                    << Leçon précédente : {{ $previous_lecon->titre }}</a></p>
        @endif
        @if($next_lecon)
            <p style="background:#3B83B1;border-radius: 5px;color:white; margin-left: 100px;" class="inline page"> <a href="{{ route('lecons.show', $next_lecon->id) }}"  style="text-decoration: none; color: white;">
                    Leçon suivante : {{ $next_lecon->titre }} >></a></p>
        @endif
        </div>

    </div>
</div>
@endsection




















