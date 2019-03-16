@extends('pages.Nav1')
@section('content')

<?php $products = session('cart'); ?>


​
<div class="container-fluid">
    
​
         <div class="col-sm-12" >
            <h4><small >Drives to do</small></h4>
            <hr>
            <ul class="list-group" >  
                 <li class="list-group-item" >
                 <div class="row" >
                 <div class="col-md-3"><strong>Destination</strong></div>
                 <div class="col-md-3"><strong>End Time</strong> </div>
                 <div class="col-md-3"><strong>Car number</strong></div>
                 <div class="col-md-3"></div>
                </div>
                 </li>
             <?php $idd=2 ?>
             <?php 
             $val=date("Y-m-d h:i:s");
             ?>
             
                 @foreach ($trip as $trip)
                    @if(($trip->d_id==$idd) && ($val<$trip->end))
                   
                        <li class="list-group-item" >
                            <div class="row" > 
                            <div class="col-md-3"><?php echo $trip->dest_name;?></div>
                            <div class="col-md-3"><?php echo $trip->end;?></div>
                            <div class="col-md-3"><?php echo $trip->car_id;?></div>                              
                            <div id="header_link" style="float:right" ><a href="{{URL::to('/start/'.$trip->id)}}"><button type="submit" style="float:right" class="btn btn-primary">Start</button></a></div>
                        </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
@stop














