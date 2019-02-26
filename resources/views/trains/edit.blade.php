@extends('layouts.app')

@section('content')
    <h1>Redaguoti traukinį</h1>
    {!! Form::open(['action' => ['TrainsController@update', $train->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('departure_city', 'Išvykimo miestas')}}
            {{Form::text('departure_city', $train->departure_city, ['class' => 'form-control', 'placeholder' => 'Išvykimo miestas'])}}
        </div>
        <div class="form-group">
            {{Form::label('arrival_city', 'Atvykimo miestas')}}
            {{Form::text('arrival_city',  $train->arrival_city, ['class' => 'form-control', 'placeholder' => 'Atvykimo miestas'])}}
        </div>

        <div class="form-group">
            {{Form::label('departure_data', 'Išvykimo laikas')}}
            {{Form::text('departure_data', $train->departure_data, ['class' => 'form-control', 'placeholder' => 'Atvykimo miestas'])}}
        </div>

        <div class="form-group">
            {{Form::label('arrival_data', 'Atvykimo laikas')}}
            {{Form::text('arrival_data', $train->arrival_data, ['class' => 'form-control', 'placeholder' => 'Atvykimo miestas'])}}
        </div>
        <div class="form-group">
            {{Form::label('total_seats', 'Vietų traukinyje')}}
            {{Form::text('total_seats',  $train->total_seats, ['class' => 'form-control', 'placeholder' => 'iš viso vietų traukinyje'])}}
        </div>
        <div class="form-group">
            {{Form::label('ticket_price', 'Bilietio kaina')}}
            {{Form::text('ticket_price',  $train->ticket_price, ['class' => 'form-control', 'placeholder' => 'Bilietio kaina'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Siųsti', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection