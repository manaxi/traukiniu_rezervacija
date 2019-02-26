@php
use \App\Http\Controllers\TrainsController;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                 @if(Auth::user()->hasRole('Vadybininkas'))
                
                 <h3>Traukiniai</h3>
                 @if(count($trains) > 0)
                     <table class="table table-striped">
                         <tr>
                             <th>Traukinio nr</th>
                             <th>Išvykimo miestas</th>
                             <th>Atvykimo miestas</th>
                             <th>Laisvų vietų</th>
                             <th>Užsakyta biletų už</th>
                         </tr>
                         @foreach($trains as $train)
                             <tr>
                                 <td><a href="/trains/{{$train->id}}">{{$train->id}}</a></td>
                                 <td>{{$train->departure_city}}</td>
                                 <td>{{$train->arrival_city}}</td>
                                 <td>{{ TrainsController::getAvailableSeat($train->id) }}</td>
                                 <td>{{TrainsController::getTrainPrice($train->id)}}</td>
                             </tr>
                         @endforeach
                     </table>
                     @if(count($trains) > 0)
                     Iš viso uždirbote: {{TrainsController::totalPrice()}} eurus
                    @endif
                 @else
                     <p>Traukinių dar nėra pridėta</p>
                 @endif

                 @endif

                    @if(Auth::user()->hasRole('Administratorius'))
                    <a href="/trains/create" class="btn btn-primary">Pridėti traukinį</a>
                                   
                    <h3>Traukiniai</h3>
                    @if(count($trains) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Traukinio nr</th>
                                <th>Išvykimo miestas</th>
                                <th>Atvykimo miestas</th>
                                <th>Laisvų vietų</th>
                                <th></th>
                                <td></td>
                            </tr>
                            @foreach($trains as $train)
                                <tr>
                                    <td><a href="/trains/{{$train->id}}">{{$train->id}}</a></td>
                                    <td>{{$train->departure_city}}</td>
                                    <td>{{$train->arrival_city}}</td>
                                    <td>{{ TrainsController::getAvailableSeat($train->id) }}</td>
                                    <td><a href="/trains/{{$train->id}}/edit" class="btn btn-default">Redaguoti</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['TrainsController@destroy', $train->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Trinti', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>Traukinių dar nėra pridėta</p>
                    @endif
                    @endif
                    <h3>Rezervuoti traukiniai</h3>
                    <table class="table table-striped">
                        <tr>
                            <th>Traukinio nr</th>
                            <th>Rezervuota vieta</th>
                            <th></th>
                        </tr>
                        @foreach($booked as $booking)
                        <tr>
                            <td><a href="/trains/{{$booking->train_id}}">{{$booking->train_id}}</a></td>
                            <td>{{$booking->seat_no}}</td>
                            <td>
                                    {!!Form::open(['action' => ['BookingController@destroy', $booking->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Trinti', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
