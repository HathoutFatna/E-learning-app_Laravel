@extends('Client/index')

<style>

    *{
        list-style: none;
        text-decoration: none;
    }

    #content{
        background:;
        height:auto;
        width:80%;
        margin:20px 10% 10px 10%;

    }
    .right-p{
      background:#eaeded;
      margin-top:40px;
      border-radius:20px 20px 20px 20px;
      height:300px;
      width:29.5%;
      border:0px solid #95a5a6;
        float:right;

      box-shadow: 4px 1px 10px  rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .left-p{
      height:auto;
      width:70%;
        min-height: 350px;
    }
    #b-app{
        background:#FA8072;
        float:right;
        margin:20px 10% 20px 10%;
        width:80%;
        border:0;
        font-size:20;
        color:white;
        cursor:pointer;
        border-radius:5px;

    }
    #d-titre{
        background:white;

    }
    #t-cours{
        text-align:center;
        font-size:30;
        padding-top:;
        position:relative;
        height:50px;
        width:100%;
        margin:0;
        background:;
    }

    #b-app:hover{
      background:red;
      border:0;
      color:white;
      box-shadow: 4px 1px 10px  rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    #d-pic{
        background:yellow;
        height:250px;
        width:90%;
        margin:0px 5% 10px 5%;


    }
    #d-desc{
        background:#fadbd8;
        font-size:20;
        height:auto;
        width:90%;
        margin:5px 5% 5px 5%;
        border-radius:0px 10px 10px 10px;
        position:;
        /*position:none;
        float:right;*/
    }
    .inline{
        display:inline;
    }
    .inline-block{
        display:inline-block;
    }
    #chapitres{
        background:white;
        margin-left:3.5%;
        height:auto;
        width:63%;
        padding:0px 0 10px 0;
    }
    #chap{
        background:white;
        height:30px;
        width:30%;
        padding-left:;
        font-size:18;
        margin-left:10px;
    }
    .d-chap{
        background:;
        height:auto;
        width:98%;
        margin-top:10px;
        margin-left:10px;
        font-size:18;
    }
    .t-chap{
      margin:2px;
      margin-top:10px;
    }
    .p-chap{
      background:;
      width:100%;
      height:20px;
      font-size:16;
      margin:0;
      margin-left:3%;
      margin-bottom:5px;
    }
    .a-lecon{
      background:;
      color:black;

      margin-left:20%;

    }
    .a-desc{
      background:;
      font-size:16;
      margin:2px;
      margin-left:23%;
      margin-bottom:10px;
    }

    .open-button {
        background-color:red;
        opacity: 0.9;
        color: white;
        padding: ;
        width:300px;
        height:50px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: absolute;
        margin-right:8%;
        float:right;
        bottom: 80px;
        right: 28px;

    }
    .score {
        background-color:transparent;
        opacity: 0.9;
        color: black;
        font-weight: bold;
        padding: ;
        width:300px;
        height:50px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: absolute;
        margin-right:8%;
        float:right;
        bottom: 110px;
        right: 28px;

    }
    .open-buttonSol {
        background-color:green;
        opacity: 0.9;
        color: white;
        padding: ;
        width:300px;
        height:50px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: absolute;
        margin-right:8%;
        float:right;
        bottom: 23px;
        right: 28px;

    }

    /* The popup form - hidden by default */
    .form-popup {
        display: none;
        position: fixed;
        height:auto;
        width:auto;
        top:5px;
        bottom: 5px;
        right: 10px;
        margin:50px 30% 50px 30%;
        border: 3px solid black;
        z-index:99;
        padding:5px;
        background:white;
    }

    /* Add styles to the form container */
    .form-container {
        max-width: 300px;
        padding: 10px;
        background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
        opacity: 1;
    }
    /* Popup box BEGIN */
    .hover_bkgr_fricc{
        background:rgba(0,0,0,.4);
        cursor:pointer;
        display:none;
        height:100%;
        position:fixed;
        text-align:center;
        top:0;
        width:100%;
        z-index:10000;
    }
    .hover_bkgr_fricc .helper{
        display:inline-block;
        height:100%;
        vertical-align:middle;
    }
    .hover_bkgr_fricc > div {
        background-color: #fff;
        box-shadow: 10px 10px 60px #555;
        display: inline-block;
        height: auto;
        max-width: 551px;
        min-height: 100px;
        vertical-align: middle;
        width: 60%;
        position: relative;
        border-radius: 8px;
        padding: 15px 5%;
    }
    .popupCloseButton {
        background-color: #fff;
        border: 3px solid #999;
        border-radius: 50px;
        cursor: pointer;
        display: inline-block;
        font-family: arial;
        font-weight: bold;
        position: absolute;
        top: -20px;
        right: -20px;
        font-size: 25px;
        line-height: 30px;
        width: 30px;
        height: 30px;
        text-align: center;
    }
    .popupCloseButton:hover {
        background-color: #ccc;
    }
    .trigger_popup_fricc {
        cursor: pointer;
        font-size: 20px;
        margin: 20px;
        display: inline-block;
        font-weight: bold;
    }
</style>


@section('home')
    <style> header{
            margin-top:-25px;
        }
    </style>
<div class="" id="content">
    <!-- right part -->
  <div class="right-p inline-block">
      <a href="@if(!\Auth::check()){{ route('register') }}@else {{ route('cours.edit', $cour->id) }}@endif" style="text-decoration: none;"> <button class="" id="b-app">S'inscrire au cours</button></a>
      <h2 style="margin:0;margin-left:10%;">Catégorie :</h2>
      <h3 style="width:50%;text-align:center;margin:0 25% 0 25%;padding:0;border:1px solid black;">{{ $cour->category->nom ?? '' }}</h3>
      @if($cour->enseignants)
      <h2 style="margin:0;margin-left:10%">Les enseignants :</h2>
      @foreach($cour->enseignants as $key => $item)
          <h3 style="width:50%;text-align:center;margin:0 25% 0 25%;padding:0;border:1px solid black;">{{ $item->name }}</h3>
      @endforeach
      @endif
  </div>

    <!-- left part -->
  <div class="left-p inline-block">
    <h3 class="t-cours" id="t-cours">{{ $cour->titre }}</h3>
      @if ($cour->image)
    <img class="" id="d-pic" src="{{ $cour->image->getUrl() }}" alt="" style="border:0px solid black;border-radius:0px;">
    @endif
          <div class="" id="d-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $cour->description }}</div>
  </div>
  <div class="" id="chapitres">
    @foreach($cour->coursChapitres as $key => $chapitre)

        <div class="" id="chap"><h2>Chapitre {{ $loop->iteration }}:<hr style="width:65%;margin:0;padding:0;"/></h2></div>
        <div class="d-chap" id="">
          <h3 class="t-chap" id="">&nbsp;{{ $chapitre->titre }}</h3>
          <p class="p-chap">{{ $chapitre->description }}</p>
          <div>@foreach($chapitre->chapitreLecons as $key => $lecon)
              <h4 style="margin:0;"><a href="{{ route('lecons.show', $lecon->id) }}" class="a-lecon">{{ $loop->iteration }}.&nbsp;{{$lecon->titre}}</a></h4>
              <p class="a-desc">{{ $lecon->description }}</p>
            @endforeach
          </div>
        </div>
    @endforeach
    </div>
    @if ($cour->quiz)

        @if (!is_null($quizzz))
            <div class="score">Votre Score est: {{ $quizzz->quiz_result }} / {{ $quizzz->total }} </div>
        @endif
            @if (!is_null($quizzz))
    <button class="open-button" onclick="openForm()">Repasser le quiz</button>
            <button class="open-buttonSol" onclick="openFormSol()">Voir la solution du quiz</button>
                @else
                <button class="open-button" onclick="openForm()">Passer le quiz d'évaluation</button>
            @endif
                <div class="hover_bkgr_fricc" style="text-align: left" id="myFormSol">
                    <span class="helper"></span>
                    <div>
                        <div class="popupCloseButton" onclick="closeFormSol()">&times;</div>
                        <h3>Test: {{ $cour->quiz->titre }}</h3>
                        <form action="#" method="post" class="form-container">
                            {{ csrf_field() }}
                            @foreach ($cour->quiz->questions as $question)
                                <b>{{ $loop->iteration }}. {{ $question->texte }}</b>
                                <br />
                                 @if ($question->correct_1 == 1)
                                <input type="radio" name="questions[{{ $question->id }}]" value="1" checked/> {{ $question->option_1 }}<br />
                                @else
                                    <input type="radio" name="questions[{{ $question->id }}]" value="1" /> {{ $question->option_1 }}<br />
                                @endif
                            @if($question->correct_2 == 1)
                                <input type="radio" name="questions[{{ $question->id }}]" value="2" checked/> {{ $question->option_2 }}<br />
                                @else
                                    <input type="radio" name="questions[{{ $question->id }}]" value="2" /> {{ $question->option_2 }}<br />
                                @endif

                                    @if($question->option_3)
                                    @if($question->correct_3 == 1)
                                    <input type="radio" name="questions[{{ $question->id }}]" value="3" checked/> {{ $question->option_3 }}<br />
                                    @else
                                        <input type="radio" name="questions[{{ $question->id }}]" value="3" /> {{ $question->option_3 }}<br />
                                    @endif

                                @endif
                                @if($question->option_4)
                                    @if($question->correct_4 == 1)
                                    <input type="radio" name="questions[{{ $question->id }}]" value="4" checked/> {{ $question->option_4 }}<br />
                                @else
                                        <input type="radio" name="questions[{{ $question->id }}]" value="4" /> {{ $question->option_4 }}<br />

                                    @endif

                                    @endif
                                <br />
                            @endforeach
                        </form>
                    </div>
                </div>
            <div class="hover_bkgr_fricc" style="text-align: left" id="myForm">
                <span class="helper"></span>
                <div>
                    <div class="popupCloseButton" onclick="closeForm()">&times;</div>
                    <h3>Test: {{ $cour->quiz->titre }}</h3>
                    @if (!is_null($quizzz))
                        <div class="alert alert-info">Votre Score est: {{ $quizzz->quiz_result }} / {{ $quizzz->total }} </div>
                        <h4>Refaire le test :</h4>
                    @endif
                    <form action="{{ route('cours.test', [$cour->id]) }}" method="post" class="form-container">
                        {{ csrf_field() }}

                        <input type="hidden" value="{{$cour->id}}" name="id">
                        @foreach ($cour->quiz->questions as $question)
                            <b>{{ $loop->iteration }}. {{ $question->texte }}</b>
                            <br />

                            <input type="radio" name="questions[{{ $question->id }}]" value="1" /> {{ $question->option_1 }}<br />
                            <input type="radio" name="questions[{{ $question->id }}]" value="2" /> {{ $question->option_2 }}<br />
                            @if($question->option_3)
                                <input type="radio" name="questions[{{ $question->id }}]" value="3" /> {{ $question->option_3 }}<br />
                            @endif
                            @if($question->option_4)
                                <input type="radio" name="questions[{{ $question->id }}]" value="4" /> {{ $question->option_4 }}<br />
                            @endif
                            <br />
                        @endforeach
                        <button type="submit" class="btn" value=" Submit results ">Valider</button>

                    </form>


                </div>
            </div>
@endif

</div>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

    function openFormSol() {
        document.getElementById("myFormSol").style.display = "block";
    }

    function closeFormSol() {
        document.getElementById("myFormSol").style.display = "none";
    }

</script>



@endsection
