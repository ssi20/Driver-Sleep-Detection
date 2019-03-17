<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="refresh" content="5">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Drive</title>
    
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
    
    
    <style type="text/css">
        h1{
            display:inline;
            text-align:center;
        }
        #header_link{
            text-decoration:none;
            float:right;
            display:block;
            margin-right:0px;
            clear:left;
            padding:1%;
            
        }
		
        
       
    
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f0f0f0;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>
<script>
var audio = new Audio();
audio.src ='http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=Hello%20World.';
audio.play();
</script>
@include('pages.nav')
       
         <div class="container-fluid">
                <ul  class="nav nav-pills nav-stacked">
                    <li><a href="#">Session Ongoing</a></li>
                    
                </ul>
            </div>
            <h1 id="demo"></h1>
            <p id="demo1"></p>
        <div id="load">
        <ul class="list-group" >  
            <li class="list-group-item" >
                <div class="row" >
                <div class="col-md-2"><strong>s_id</strong></div>
                <div class="col-md-2"><strong>s_time</strong> </div>
                <div class="col-md-2"><strong>latitude</strong></div>
                <div class="col-md-2"><strong>longitude</strong></div>
                <div class="col-md-2"><strong>place</strong></div>
                <div class="col-md-2"><strong>status</strong></div>
                </div>
            </li>
            
            @foreach ($data as $trip)
                <li class="list-group-item" >
                    <div class="row" > 
                    <div class="col-md-2"><?php echo $trip->s_id;?></div>
                    <div class="col-md-2"><?php echo $trip->s_time;?></div>
                    @if($trip->latitude==NULL && $trip->latitude==NULL)
                         <?php $mess=""?>
                            @if($trip->drowse==1)
                                <?php $mess=$mess." Driver is drowsing."?>
                            @endif
                            @if($trip->visibility==1)
                                <?php $mess = $mess.' Driver not visible.'?>
                            @endif
                            @if($trip->picture==1)
                                <?php $mess = $mess.' Driver showing picture.'?>
                            @endif
                            @if($trip->glare==1)
                                <?php $mess = $mess.' Driver is wearing glare.'?>
                            @endif
                        <!-- <script>
                         
                         var audio = new Audio();
                            audio.src ='http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=Hello%20World.';
                            audio.play();

                        </script> -->
                        <?php 
                        $addr="";
                        $addr=$add->cityName.", ".$add->regionName.", ".$add->zipCode;?>
                        <?php
                        App\sesion::where('id', $trip->id)
                                    ->update(['latitude' => $add->latitude,
                                              'longitude'=> $add->longitude,
                                              'place'=>$addr,
                                              'status'=>$mess]); 
                        ?>
                    @endif
                    
                    <div class="col-md-2"><?php echo $trip->latitude;?></div>                              
                    <div class="col-md-2"><?php echo $trip->longitude;?></div> 
                    <div class="col-md-2"><?php echo $trip->place;?></div>
                    <div class="col-md-2"><?php echo $trip->status;?></div>  
                </li>
            @endforeach
        </ul>  
        </div>  
        
    </div>
        <script>
        var countDownDate = new Date("<?php echo $end?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;


        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";
        
        // If the count down is finished, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
            document.getElementById("load").contentWindow.location.reload(true);
        }
        }, 1000);
        </script>
</body>
</html>



















