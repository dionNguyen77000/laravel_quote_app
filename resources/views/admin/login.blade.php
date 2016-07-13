@extends('layouts.master')
@section('styles')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{URL::to('src/css/main.css')}}">

@endsection
@section('content')
    <style>
        .input-group label {
            text-align: left;
        }
    </style>

    @if(count($errors) > 0)
        <section class="info-box fail">
            <ul>
                @foreach($errors->all() as $error)
                    <li><>  {{$error}}</li>
                @endforeach
            </ul>
        </section>
    @endif
    @if(Session::has('fail'))
        <section class="info-box fail">
            {{Session::get('fail')}}
        </section>
    @endif

<form action="{{route('admin.login')}}" method="post">
    <div class="input-group">
        <label for="name">Your Name</label>
        <input type="text" name="name" id="name" placeholder="Your name">
    </div>
    <div class="input-group">
        <label for="password">Your Password</label>
        <input type="password" name="password" id="password" placeholder="Your password">
    </div>
    <button type="submit">Submit</button>
    <input type="hidden" name="_token" value="{{Session::token()}}">

</form>
@endsection