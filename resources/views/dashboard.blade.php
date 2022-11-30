@extends('layouts.nav')
@section('content')
<h1 class="text-center m-3"> Book's</h1>
<div class="row">
    @foreach($data as $view)
    <div class="col">
        <div class="card" style="width: 18rem;">
            <img src="{{asset('storage/'.$view->cover)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h3 class="card-title">{{$view->judul}}</h3>
                <p class="card-text">{{$view->sinopsis}}</p>
                <p class="card-text">Penerbit : <i>{{$view->Penerbit}}</i></p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    </div>
    @endforeach
</div>
@endsection