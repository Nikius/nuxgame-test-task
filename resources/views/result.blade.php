@extends('layouts.app')

@section('title', 'Result')

@section('content')
    <h1>You are @if($result > 0) Win @else Loose @endif!</h1>
    <p>Your score is: {{$result}}</p>
    <p>
        <a href="javascript:history.back()">Back</a>
    </p>
@endsection
