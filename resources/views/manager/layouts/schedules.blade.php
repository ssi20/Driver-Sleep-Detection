
@extends('manager.dashboard.Nav1')
@section('content')

<div class=card>
  
</div>


<div class="card-body text-dark">
                  <div class="table-responsive">
                    <table class="table table-striped  ">
                      <thead class="thead-dark">
                        <tr>
                          <th>Driver ID</th>
                          <th>Driver Name</th>
                          <th>Car ID</th>
                          <th>Destination</th>
                          <th>Deadline</th>
                          <th></th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      	<?php $i=1; ?> 
                        
                        @foreach ($pl as $p)
                           
                        
                        <tr>
                          <th scope="row">{{$p->d_id}}</th>
                          <td class="text-dark">{{ "Driver ".$i }}</td>
                          <td class="text-dark">{{ $p->car_id}}</td>
                        @if (empty($p->dest_name))
                          <td class="text-danger">Yet to be assigned.</td>
                        @else
                          <td  class="text-dark">{{$p->dest_name}}</td>
                        @endif
                        
                        @if (empty($p->dest_name))
                          <td class="text-danger">Yet to be assigned.</td>
                        @else
                          <td class="text-dark">{{$p->end}}</td>
                        @endif
                        
                        @if (empty($p->dest_name))
                        <td><a href="create&d_id={{$p->d_id}}" class="btn btn-outline-dark col-8"><b>Create Schedule</b> </a></td>
                        @else
                        <td><a href="monitor&d_id={{$p->d_id}}" class="btn btn-outline-primary col-8"> <b>Monitor Driver</b> </a></td>
                        @endif
                      
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            @stop