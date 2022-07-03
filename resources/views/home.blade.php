@extends('layouts.app')

@section('content')
<div class="container w-70 ">
    <h2 class="title">Resep Terbaru</h2>

    <div class="card-group">
    <div class="row">
    @foreach($all_resep as $a)
            <div class="col-md-4 col-lg-4">
                <div class="card m-2">
                    <img class="card-img-top" width="50" src="{{asset('storage/'.$a->foto)}}" alt="Card image cap">
                <div class="card-body">
                    <span class="text-dark ">{{$a->suka ? $a->suka : '0'}} Orang Menyukai Ini</span>
                    <h5 class="card-title text-main my-2"><b>{{$a->judul}}</b></h5>
                    <p class="card-text">{{$a->deskripsi}}</p>
                    <a href="{{route('suka.update',$a->id)}}" class="btn btn-grey w-100">Suka</a>
                </div>
            </div>
            </div>
            @endforeach
    </div>
    </div>
</div>
@endsection