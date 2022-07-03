@extends('layouts.app')

@section('content')
<div class="container w-50 ">
    <img src="{{asset('storage/'.$data->foto)}}" alt="image" class="w-100">
    <h2 class="title">{{$data->judul}}</h2>
    <p class="deskripsi">{{$data->deskripsi}}</p>
    <h3>Bahan-Bahan</h3>
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