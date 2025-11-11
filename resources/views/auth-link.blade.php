@extends('layouts.app')

@section('title', 'Auth Link')

@section('content')
    <h1>Auth Link</h1>
    <p>There is your access link:</p>
    <a href="{{$link}}">{{$link}}</a>
    <p>Link will expire after {{$expire_date}}</p>
@endsection
