@extends('layouts.app')

@section('content')
<div class="container w-50">
    <h2 class="text-main">Tuliskan Resepmu...</h2>


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
    @endif

    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif

    <form action="{{route('resep.update',$data->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-3">
            <label for="nama">Judul </label>
            <input type="text" name="judul" id="nama" class="form-control" value="{{$data->judul}}">
        </div>
        <div class="form-group mb-3">
            <label for="deskripsi">Deskripsi </label>
            <textarea type="text" name="deskripsi" id="deskripsi" class="form-control">{{$data->deskripsi}}
            </textarea>
        </div>
        <div class="form-group mb-3 " id="bahan">
            <label for="bahan1">Bahan-Bahan </label>
            <?php $i = 1; ?>
            @foreach($data->bahan as $b)
            <input type="text" name="{{'bahan'.$i}}" id="{{'bahan'.$i}}" class="form-control mb-3" value="{{$b->nama}}">
            <?php $i++; ?>
            @endforeach
            
        </div>
        <a href="#" id="addbahan" class="link">+ Item Bahan</a>
        
        <?php $f = 1; ?>
        <div class="form-group my-3 " id="langkah">
            <label for="langkah1">Langkah-Langkah </label>
            @foreach($data->langkah as $l)
            <input type="text" name="{{'langkah'.$f}}" id="{{'langkah'.$f}}" class="form-control mb-3" value="{{$l->nama}}">
            <?php $f++; ?>
            @endforeach

        </div>
        <a href="#" class="link link-langkah">+ Item Langkah</a>
        <div class="form-group my-3">
            <label for="foto">Foto </label> <br>
            <img src="{{asset('storage/'.$data->foto)}}" width="150" class="my-3">
            <input type="file" name="foto" id="foto" class="form-control" value="{{$data->foto}}">
        </div>
        <button type="submit" id="submit" class="btn bg-main text-light w-100 mt-3">Terbitkan Resep</a>
    </form>
</div>
<script>
    let i = 2
    document.getElementById('addbahan').addEventListener("click", e => {
        e.preventDefault()
        i++
        let input = document.createElement('input');
        input.setAttribute("name", "bahan" + i)
        input.setAttribute("type", "text")
        input.setAttribute("id", "bahan" + i)
        input.classList.add("form-control")
        input.classList.add("mb-3")
        document.getElementById("bahan").appendChild(input)
    })

    let f = 2
    document.querySelector('.link-langkah').addEventListener("click", e => {
        e.preventDefault()
        f++
        let input = document.createElement('input');
        input.setAttribute("name", "langkah" + f)
        input.setAttribute("type", "text")
        input.setAttribute("id", "langkah" + f)
        input.classList.add("form-control")
        input.classList.add("mb-3")
        document.getElementById("langkah").appendChild(input)
    })

    document.getElementById("submit").addEventListener("click", e => {

        let input = document.createElement('input');
        input.setAttribute("name", "langkahcounted")
        input.setAttribute("type", "hidden")
        input.setAttribute("value", f)
        document.getElementById("langkah").appendChild(input)

        let input2 = document.createElement('input');
        input2.setAttribute("name", "bahancounted")
        input2.setAttribute("type", "hidden")
        input2.setAttribute("value", i)
        document.getElementById("bahan").appendChild(input2)
        e.target.submit()

    })
</script>
@endsection