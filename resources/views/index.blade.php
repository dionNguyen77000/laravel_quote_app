@extends('layouts.master')

@section('title')
    Trending Quotes
@endsection

@section('styles')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{URL::to('src/css/main.css')}}">

@endsection

@section('content')
    @if(!empty(Request::segment(1)))
        <section class="filter-bar">
            A filter has been set ! <a href="{{route('index')}}">show all quotes</a>
        </section>
    @endif
    @if(count($errors) > 0)
       
        <section class="info-box fail">
            <ul>
                @foreach($errors->all() as $error)
                       <li><>  {{$error}}</li>
                @endforeach
            </ul>
        </section>
    @endif
    @if(Session::has('success'))
        <section class="info-box success">
            {{Session::get('success')}}
        </section>
    @endif
    <section class="quotes">
        <h1> Latest Quotes</h1>
        @for($i = 0; $i < count($quotes); $i++)
        <article class="quote{{ $i % 3 === 0 ? ' first-in-line' : (($i + 1)%3 ===0 ? ' last-in-line' : '')}}">
                <div class="delete"><a href="{{route('delete', ['quote_id' => $quotes[$i]->id])}}">x</a></div>
                {{$quotes[$i]-> quote}}
                <div class="info">Created by<a href="{{route('index', ['author'=>$quotes[$i]-> author -> name])}}"> {{$quotes[$i]-> author -> name}}</a> on  {{$quotes[$i]-> created_at}}.</div>
        </article>
        @endfor
        <div class="pagination">
            @if($quotes->currentPage()!==1)
                Previous <a href="{{$quotes->previouspageUrl()}}"> <span class="fa fa-caret-left"></span></a>
            @endif
            @if($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
                   Next <a href="{{$quotes->nextPageUrl()}}"><span class="fa fa-caret-right"></span></a>
            @endif
        </div>

    </section>
    <section class="edit-quote">
        <h1>Add a Quote</h1>
        <form action="{{route('create')}}" method ="post">
            <div class="input-group">
                <label for="author">Your Name</label>
                <input type="text" name="author" id="author" placeholder="your name">
            </div>
            <div class="input-group">
                <label for="email">Your Email</label>
                <input type="text" name="email" id="email" placeholder="your email"></input>
            </div>
            <div class="input-group">
                <label for="">Your Quote</label>
                <textarea name="quote" id="quote" rows=5 placeholder="your quote"></textarea>
            </div>
            <button type="submit" class="btn"> Submit Quote</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </section>

@endsection