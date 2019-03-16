<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


@php
        $did=request('d_id');
@endphp
<head>
  <meta charset="UTF-8">
  <title>ec </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="{{ URL::to('css/count.css')}}">

  
</head>

<body>

  <div class="sectiontitle">
  <h2> <u >{{"Driver ".$did." - Summary"}}</u></h2>
    <span></span>
</div>
<div id="projectFacts" class="sectionClass">
    <div class="fullWidth eight columns">
        <div class="projectFactsWrap ">
            <div class="item wow fadeInUpBig animated animated" data-number="12" style="visibility: visible;">
                <i class="fas fa-dizzy"></i>
                <p id="number1" class="number">12</p>
                <span></span>
                <p>Drowsiness Detected</p>
            </div>
            <div class="item wow fadeInUpBig animated animated" data-number="56" style="visibility: visible;">
                <i class="fas fa-moon-o"></i>
                <p id="number2" class="number">55</p>
                <span></span>
                <p>Dark Environment</p>
            </div>
            <div class="item wow fadeInUpBig animated animated" data-number="359" style="visibility: visible;">
                <i class="fas fa-file-image"></i>
                <p id="number3" class="number">359</p>
                <span></span>
                <p>Improvised Image</p>
            </div>
            <div class="item wow fadeInUpBig animated animated" data-number="246" style="visibility: visible;">
                <i class="fas fa-sun"></i>
                <p id="number4" class="number">246</p>
                <span></span>
                <p>Glare</p>
            </div>
        </div>
    </div>
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="{{ URL::to('js/count.js')}}" ></script>




</body>
