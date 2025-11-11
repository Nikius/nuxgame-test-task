@extends('layouts.app')

@section('title', 'History')

@section('content')
    <h1>History</h1>
    @if($games->count() > 0)
        @foreach($games as $game)
            <p>Your score is: {{$game->result}}</p>
        @endforeach
    @else
        <p>You have not played any games yet</p>
    @endif
    <p>
        <a href="javascript:history.back()">Back</a>
    </p>
@endsection
