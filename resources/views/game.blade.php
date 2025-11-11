@extends('layouts.app')

@section('title', 'Game')

@section('content')
    <h1>Game</h1>
    <p>
        <form method="POST" action="/auth/regenerate-link">
            @csrf
            <input type="hidden" name="uuid" value="{{$uuid}}">
            <div>
                <button type="submit">Regenerate Link</button>
            </div>
        </form>
        <form method="POST" action="/auth/deactivate-link">
            @csrf
            <input type="hidden" name="uuid" value="{{$uuid}}">
            <div>
                <button type="submit">Deactivate Link</button>
            </div>
        </form>
    </p>
    <p>
        <form method="POST" action="/game/play">
            @csrf
            <input type="hidden" name="uuid" value="{{$uuid}}">
            <div>
                <button type="submit">Imfeelinglucky</button>
            </div>
        </form>
    </p>
    <p>
        <form method="POST" action="/game/history">
            @csrf
            <input type="hidden" name="uuid" value="{{$uuid}}">
            <div>
                <button type="submit">History</button>
            </div>
        </form>
    </p>
@endsection
