@extends('layouts.master')

@section('content')
  <div class="centered">
      @foreach($actions as $action)
          <a href="{{route('niceaction',['action'=> lcfirst($action->name)])}}">{{$action->name}}</a>
      @endforeach
    
      <br>
      @if(count($errors) > 0)
          <div>
              <ul>
                  @foreach($errors->all() as $error)
                      {{$error}}
                  @endforeach
              </ul>
          </div>
      @endif
      <form class="" action="{{route('benice')}}" method="post">
          <label for="select-action">I want to...</label>
          <select id="select-action" name="action">
              <option value="greet">greet</option>
              <option value="hug">hug</option>
              <option value="kiss">kiss</option>
          </select>
          <input type="text" name="name" value="">
          <button type="submit"> Do a nice action!</button>
          <input type="hidden" value="{{Session::token()}}" name="_token">
      </form>
  </div>
@endsection
