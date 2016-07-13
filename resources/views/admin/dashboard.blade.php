@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{URL::to('src/css/main.css')}}">
@endsection
@section('content')
    <ul>
    @foreach($authors as $author)
        <li>{{$author->name}} ({{$author->email}}</li>
    @endforeach
    </ul>
@endsection