@extends('layouts.app')

@section('content')

<div class="container">
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
    <div class="card mt-5">
        <div class="card-body">
            <h3 class="">All data</a></h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Judul</th>
                        <th>deskripsi</th>
                        <th>foto</th>
                        <th>bahan-bahan</th>
                        <th>langkah-langkah</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_resep as $a)
                    <tr>
                        <td> {{$a->id}}</td>
                        <td> {{$a->judul}}</td>
                        <td> {{$a->deskripsi}}</td>
                        <td> <img src="{{asset('storage/'.$a->foto)}}" width="60"></td>
                        <td>
                            @foreach($all_resep as $b)
                            @foreach($b->bahan as $bahan)
                            @if($bahan->resep_id == $a->id)
                            <li>{{$bahan->nama}}</li>
                            @endif
                            @endforeach
                            @endforeach
                        </td>
                        <td>
                            @foreach($all_resep as $b)
                            @foreach($b->langkah as $langkah)
                            @if($langkah->resep_id == $a->id)
                            <li>{{$langkah->nama}}</li>
                            @endif
                            @endforeach
                            @endforeach
                        </td>
                        <td>
                            <a href="resep/{{$a->id}}/edit" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Edit</a>
                            <a href="{{route('resep.show',$a->id)}}" class="btn btn-primary">detail</a>
                            <a class="btn btn-danger" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                                Hapus
                            </a>

                            <form id="delete-form" action="{{ route('resep.destroy',$a->id) }}" method="post" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection