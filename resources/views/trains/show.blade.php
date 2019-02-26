@php
use \App\Http\Controllers\TrainsController;
@endphp
@extends('layouts.app')

@section('content')
    <div class="row">
            <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Traukinio nr</th>
                        <th scope="col">Išvykimo miestas</th>
                        <th scope="col">Atvykimo miestas</th>
                        <th scope="col">Išvykimo laikas</th>
                        <th scope="col">Atvykimo laikas</th>                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{$train->id}}</td>
                        <td><a href="/trains/{{$train->id}}">{{$train->departure_city}}</a></td>
                        <td><a href="/trains/{{$train->id}}">{{$train->arrival_city}}</a></td>
                        <td>{{$train->departure_data}}</td>
                        <td>{{$train->arrival_data}}</td>
                        <!--<td>{{ TrainsController::getAvailableSeat($train->id) }}</td>-->
                      </tr>
                    </tbody>
                  </table>
                   <div class="col-lg-2">           
                  {!! Form::open(['action' => 'TrainsController@bookingNow', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                      <div class="form-group">
                          {{Form::label('seat_no', 'Vietos numeris')}}
                          <select name="seat_no"  class="form-control">
                              @php                   
                                 $train_total_seats=$train->total_seats;                  
                                 for($i = 1; $i<=$train_total_seats; $i++){
                                    if(!in_array($i, $busy_seats)){
                                      echo"<option value='$i'>$i</option>";                        
                                    }
                                 }
                              @endphp
                              </select>
                              {{Form::label('ticket_price', 'Bilietio kaina')}}
                              
                              {{Form::text('ticket_price',  $train->ticket_price, ['class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => 'Bilietio kaina'])}}
                          {{Form::hidden('train_id',  $train->id, ['class' => 'form-control', 'placeholder' => 'iš viso vietų traukinyje'])}}
                          {{Form::hidden('status',  1, ['class' => 'form-control', 'placeholder' => 'iš viso vietų traukinyje'])}}
                      </div>
                       
                      {{Form::submit('Uzsakyti', ['class'=>'btn btn-primary'])}}
                     
                      {!! Form::close() !!}
                     <br>
                     
                     <!--<a href="/trains/{{$train->id}}/edit" class="btn btn-default">Redaguoti</a>-->
                     
                    </div>
 </div>
@endsection