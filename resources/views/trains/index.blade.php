@extends('layouts.app')

@section('content')
    <h1>Traukiniai</h1>
    @if(count($trains) > 0)
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
          @php
              $ldate = date('Y-m-d H:i');
          @endphp
        @foreach($trains as $train)
         @if($ldate < $train->departure_data)
          <tr>
              <td><a href="/trains/{{$train->id}}">{{$train->id}}</a></td>
            <td><a href="/trains/{{$train->id}}">{{$train->departure_city}}</a></td>
            <td><a href="/trains/{{$train->id}}">{{$train->arrival_city}}</a></td>
            <td>{{$train->departure_data}}</td>
            <td>{{$train->arrival_data}}</td>
          </tr>
          @endif
        @endforeach
        </tbody>
      </table>
    @else
        <p>No trains found</p>
    @endif
@endsection