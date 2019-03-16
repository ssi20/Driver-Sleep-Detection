
@extends('manager.dashboard.Nav1')

​@section('content')
@php
        $did=request('d_id');
@endphp
@include('manager.layouts.count') 
<div id=map class=text-center></div>
<head>
<link rel="stylesheet" href="{{Url::to('css/style.pink.css')}}" id="theme-stylesheet">
</head>
@include('manager.layouts.driverstatus')
​   <div >
<input type=hidden name=id id=n value="{{$did}}">
<input type=hidden name=prev id=pr >
<input type=hidden name=count id=count >
<div id=p1></div>
    </div>
    

    <script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQcPOqTbByHzN1o5yCjDHOPhzUcDsc8NU&libraries=places">
</script>
    <script>
    $(function worker(){
        // don't cache ajax or content won't be fresh
        $.ajaxSetup ({
            cache: false,
            complete: function() {
              // Schedule the next request when the current one's complete
              setTimeout(worker, 20);
            }
        });
        // var ajax_load = "<img src='http://automobiles.honda.com/images/current-offers/small-loading.gif' alt='loading...' />";
        
        // // load() functions
        // var loadUrl = "http://fiddle.jshell.net/dvb0wpLs/show/";
        
        // $("#result").html(ajax_load).load(loadUrl);
        id=$('#n').val();
        var route = '{{ route('status') }}';
        $.ajax({
                url: route+'?id='+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                console.log(response);

                var dr=response['dr'][0].d;
                var pic=response['pic'][0].p;
                var vis=response['vis'][0].v;
                var glare=response['glare'][0].g;
                temp=$('#pr').val();
                //console.log(temp);
                
                if(dr!=0 && dr>=3){
                    $('#map').html("<button href='#' value='Submit' class='btn btn-danger col-2'>Take Action</button>")
                }

                if(dr!=0 && dr%3==0 && dr-temp!=0){
                    alert("<h2 class=text-danger>Driver "+id+" is falling asleep while drving. Please take some appropriate action.</h2>")
                }
                $('#pr').val(dr);
                
                $('#number1').html(dr);
                $('#number2').html(vis);
                $('#number3').html(pic);
                $('#number4').html(glare);

                var len = 0;
                var place;
                $('#userTable tbody').empty(); // Empty <tbody>
                if(response['data'] != null){
                    len = response['data'].length;
                }

                if(len > 0){
                    for(var i=0; i<len; i++){
                        var lat=response['data'][i].latitude;
                        var long=response['data'][i].longitude;
                        cnt=$('#count').val();
                        //if(len>cnt){
                            
                        //}
                        $('#count').val(len);

                    var time = response['data'][i].s_time;
                    var pla=response['data'][i].place;
                    var status=response['data'][i].status;
                    var tr_str = "<tr>" +
                        "<td align='center' class='text-dark h4'>" + place + "</td>" +
                        "<td align='center' class='text-dark h4'>" + time + "</td>" +
                        "<td align='center'  class='text-danger h4'>" + status + "</td>" +
                        
                        
                    "</tr>";

                    $("#userTable tbody").append(tr_str);
                    }
                    

                }else if(response['data'] != null){
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class=h1>No record found.</td>" +  "</tr>";

                    $("#userTable tbody").append(tr_str);
                    
                }else{
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class=h1> No record found.</td>" +  "</tr>";

                    $("#userTable tbody").append(tr_str);
                    
                }

                

                }
            });
    
    // end  
    });
 </script>
    
      
@stop