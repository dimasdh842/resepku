@extends('layouts.app')

@section('content')
<div class="container w-50 ">
    <h2 class="title">Resep Terbaru</h2>

    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{asset('storage/'.$all_resep->foto)}}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{$all_resep->judul}}</h5>
            <p class="card-text">{{$all_resep->deskripsi}}</p>
            <a href="#" class="btn btn-grey w-100">Suka</a>
        </div>
    </div>

    @foreach($data->bahan as $b)
    <li class="nav-item">
        {{$b->nama}}
    </li>
    @endforeach
    <br>
    <h3>Langkah-langkah</h3>
    @foreach($data->langkah as $b)
    <li class="nav-item">
        {{$b->nama}}
    </li>
    @endforeach
</div>
@endsection