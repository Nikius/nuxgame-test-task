@extends('layouts.app')

@section('title', 'Registration')

@section('content')
    <h1>Registration</h1>
    <p>Enter your data for get personal access link</p>
    @if ($errors->any())
        <p>Error(s):</p>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="auth/register">
        @csrf
        <div>
            <label>Username: <input type="text" name="username" required/></label>
        </div>
        <div>
            <label>Phonenumber: <input type="tel" name="phonenumber" required/></label>
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
@endsection
