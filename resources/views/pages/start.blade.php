<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- <meta http-equiv="refresh" content="3 "> -->
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
@include('pages.nav')

        <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                console.log(position);
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                $.ajax({
                    url:'http://cyrus.com/start',
                    type:'get',
                    data:{latitude:lat,longitude:lng},

                    
                    success:function(data)
                    {
                        alert('success');
                    }

                });
            });
        }

        </script>
        ​
<div class="container-fluid" >
    <div class="row content" >
        <div class="col-sm-3 sidenav" style="background-color: #555">
            <ul  class="nav nav-pills nav-stacked" >
                <li><a href="#">Session Ongoing</a></li>

            </ul><br>
            <div class="input-group"  >
                <input type="text" class="form-control" placeholder="Search Blog..">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
            </div>
        </div>
        <div class="split up" >
            <div class="centered">
                <h1 id="demo"></h1>
                    <p id="demo1"></p>
                    
                    <script>

                        var countDownDate = new Date("Mar 19, 2019 00:00:00").getTime();

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
                        }
                        }, 1000);
                    </script>
                </p>    
            </div>
        </div>
        <div class="split down" >
            <div class="centered">
                <ul class="list-group" >  
                    <li class="list-group-item" >
                        <div class="row" >
                        <div class="col-md-2"><strong>s_id</strong></div>
                        <div class="col-md-2"><strong>s_time</strong> </div>
                        <div class="col-md-1"><strong>latitude</strong></div>
                        <div class="col-md-1"><strong>longitude</strong></div>
                        <div class="col-md-1"><strong>status</strong></div>
                        </div>
                    </li>
                    @foreach ($data as $trip)
                        <li class="list-group-item" >
                            <div class="row" > 
                            <div class="col-md-2"><?php echo $trip->s_id;?></div>
                            <div class="col-md-2"><?php echo $trip->s_time;?></div>
                            <div class="col-md-2"><?php echo $trip->latitude;?></div>                              
                            <div class="col-md-2"><?php echo $trip->longitude;?></div>  
                            <div class="col-md-2"><?php echo $trip->status;?></div>  
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


   
    <script type='text/javascript'>
     $(document).ready(function(){

       // Fetch all records
       $('#but_fetchall').click(function(){
	 fetchRecords(0);
       });

       // Search by userid
       $('#but_search').click(function(){
          var userid = Number($('#search').val().trim());
				
	  if(userid > 0){
	    fetchRecords(userid);
	  }

       });

     });
    
     function fetchRecords(id){
       $.ajax({
         url: 'session/'+id,
         type: 'get',
         dataType: 'json',
         success: function(response){

           var len = 0;
           $('#userTable tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
             len = response['data'].length;
           }

           if(len > 0){
             for(var i=0; i<len; i++){
               var id = response['data'][i].s_id;
               

               var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                  
               "</tr>";

               $("#userTable tbody").append(tr_str);
             }
           }else if(response['data'] != null){
              var tr_str = "<tr>" +"<td align='center'>1</td>" +"</tr>";

              $("#userTable tbody").append(tr_str);
           }else{
              var tr_str = "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +  "</tr>";

              $("#userTable tbody").append(tr_str);
           }

         }
       });
     }
     </script>
     
   
</body>
</html>