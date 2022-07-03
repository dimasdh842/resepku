<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Bahan;
use App\Models\Langkah;

class ResepController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // get all resep data
        $all_resep = Resep::with('bahan', 'langkah')->get();

        return view('resep', compact('all_resep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambahResep');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'foto' => 'required|image|file|max:1024',
            'bahan1' => 'required',
            'bahan2' => 'required',
            'langkah1' => 'required',
            'langkah2' => 'required',
        ]);

        $foto = $request->file("foto")->store("assets");

        $data = [
            "judul" => $request->input("judul"),
            "deskripsi" => $request->input("deskripsi"),
            "foto" => $foto,
        ];
        // insert data bahan
        $resep_id = Resep::create($data)->id;

        $bahanlen = $request->input("bahancounted");
        
        for ($i=1; $i <= $bahanlen; $i++) { 
            $bahan = new Bahan;
            $bahan->nama = $request->input("bahan{$i}");
            $bahan->resep_id = $resep_id;
            $bahan->save();
        }

        // insert data langkah
        $langkahlen = $request->input("langkahcounted");

        // dd($langkahlen);
        for ($i=1; $i <= $langkahlen; $i++) { 
            $bahan = new Langkah;
            $bahan->resep_id = $resep_id;
            $bahan->nama = $request->input(("langkah{$i}"));
            $bahan->save();
        }

        return redirect('/home')->with('success', 'resep successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Resep::findOrFail($id);
        return view('detailResep', compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Resep::findOrFail($id);
        return view('editResep',compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'foto' => 'max:1024',
            'bahan1' => 'required',
            'bahan2' => 'required',
            'langkah1' => 'required',
            'langkah2' => 'required',
        ]);

        // dd($request);
        
        if(!$request->file("foto")) {
            $foto = Resep::find($id)->foto;
        } else{

            $foto = $request->file("foto")->store("assets");
        }
        
        $data = [
            "judul" => $request->input("judul"),
            "deskripsi" => $request->input("deskripsi"),
            "foto" => $foto,
        ];

        Resep::whereId($id)->update($data);

        return redirect('/home')->with('success', 'resep successfully added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Resep::find($id)->delete();
        return redirect('/home')->with('success', 'resep successfully deleted');
    }

    public function showallcard(){
        $all_resep = Resep::orderBy("id","desc")->get();
        return view('home', compact('all_resep'));
    }
    
    public function suka($id){
        $resep = Resep::find($id);
        $suka = $resep->suka;
        $suka++;
        $resep->suka = $suka;
        $resepdata = [
            "judul" => $resep->judul,
            "deskripsi" => $resep->deskripsi,
            "foto" => $resep->foto,
            "suka" => $resep->suka,

        ];
        $resepupdated = Resep::whereId($id)->update($resepdata);
        // dd($resep);
        
        $all_resep = Resep::orderBy("id","desc")->get();

        return view('home', compact('all_resep'));
    }
}
