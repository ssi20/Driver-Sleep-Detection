@extends('manager.dashboard.Nav1')
@section('content')

@php
    $did=request('d_id');
@endphp

<div class="card border-dark text-center " style="{margin:100px;}">
    <div class="card-header  align-items-center">
    <h1  class="text-center"> Assign Schedule for {{"Driver ".$did}}</h1>

    </div>
    <div class="card-body">
        @if (session()->has('flash.message'))
        <div class="alert alert-{{ session('flash.class') }}">
            {{ session('flash.message') }}
        </div>
    @endif
        {!! Form::open([ 'action'=>'ManagerController@createSchedule','method'=>'POST']) !!}  
      <form class="forms">
        <div class=row>
            <div class="form-group col-md-4">       
                <label>Set Destination</label>
                <select class="custom-select" name="dest">
                  <option value="Mumbai">Mumbai</option>
                  <option value="Satara">Satara</option>
                  <option value="Nagpur">Nagpur</option>
                  <option value="Mulund">Mulund</option>
                  <option value="Delhi">Delhi</option>
                  <option value="Thane">Thane</option>
                </select>
              </div>
        
        
      </div>
      <div class="row item-align-center">
        <div class="form-group col-md-4">
                <label>Deadline Date</label>
                <input name="deddate"  required type="date" placeholder="Deadline Date" class="form-control">
        </div>
        <div id="timepicker" class="form-group col-md-4 ">
          <label>Deadline Time</label>
          <input name="dedtime" required type="time" data-format="hh:mm:ss" class="form-control">
        </div>
      </div>
        <div class=row>
                <div class="form-group col-md-4">
                        <label>Car ID</label>
                        <input name="cid" required type="text" placeholder="Enter Car ID" class="form-control">
                </div>
        <div class="form-group col-md-4">
          <label>Remark</label>
          <input name="remark" required type="text" placeholder="Specipy Requirements" class="form-control">
        </div>
        </div>
        <br>
        <div class="form-group ">    
        	<input type="hidden" value={{$did}} name="did" />   
          <input type="submit" value="Submit" class="btn btn-primary col-2">
        </div>
      </form>
      {!!Form::close()!!}
    </div>
  </div>
  
  
  @stop