@extends('layouts.app')

@section('content')
@if(Auth::user()->hasRole('Administratorius'))
    <h1>Pridėti traukinį</h1>
    {!! Form::open(['route' => 'trains.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('departure_city', 'Išvykimo miestas')}}
            {{Form::text('departure_city', '', ['class' => 'form-control', 'placeholder' => 'Išvykimo miestas'])}}
        </div>
        <div class="form-group">
            {{Form::label('arrival_city', 'Atvykimo miestas')}}
            {{Form::text('arrival_city', '', ['class' => 'form-control', 'placeholder' => 'Atvykimo miestas'])}}
        </div>
        <div class="form-group">
            {{Form::label('departure_data', 'Išvykimo laikas')}}
            {{ Form::input('dateTime-local', 'departure_data', '$train->departure_data', ['id' => 'departure_data-text', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{Form::label('arrival_data', 'Atvykimo laikas')}}
            {{ Form::input('dateTime-local', 'arrival_data', '$train->arrival_data', ['id' => 'arrival_data-text', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{Form::label('total_seats', 'Vietų traukinyje')}}
            {{Form::text('total_seats', '', ['class' => 'form-control', 'placeholder' => 'iš viso vietų traukinyje'])}}
        </div>
        <div class="form-group">
            {{Form::label('ticket_price', 'Bilietio kaina')}}
            {{Form::text('ticket_price', '', ['class' => 'form-control', 'placeholder' => 'Bilieto kaina'])}}
        </div>
        {{Form::submit('Siųsti', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@else
<div class="alert alert-danger">
       Neturi tam teisės
</div>
@endif
@endsection