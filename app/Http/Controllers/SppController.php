<?php


namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    public function index()
    {
        $Spp = Spp::paginate(5);
        return view('admin.spp.index', compact('Spp'));
    }

    public function create()
    {

    }

    public function store (Request $request)
    {
        $this ->validate($request,[
           'tahun' =>'required ',
           'nominal' =>'required'
        ]);

        $Spp = Spp::create([
          'tahun' => $request->input('tahun'),
          'nominal' => $request->input('nominal'),
        ]);

        if ($Spp){
            return redirect()->route('spp.index')->with(['success'=>'Data Spp Berhasil Disimpan!']);
        }else{
            return redirect()->route('spp.index')->with(['error'=>'Data Spp Tidak Dapat Disimpan!']);
        }
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request,string $id)
    {
       $this->validate($request,[
         'tahun' =>'required',
         'nominal'=>'required'
       ]);

       $Spp = Spp::findOrFail($id);
       $Spp->update([
          'tahun' =>$request->input('tahun'),
          'nominal' =>$request->input('nominal')
       ]);

       
       if ($Spp){
        return redirect()->route('spp.index')->with(['update'=>'Data Spp Berhasil Diupdate!']);
    }else{
        return redirect()->route('spp.index')->with(['error'=>'Data Spp Tidak Dapat Disimpan!']);
    }
    }

    public function destroy(string $id)
    {
        $Spp = spp::findOrFail($id);
        $Spp->delete();

        if ($Spp){
            return redirect()->route('spp.index')->with(['delete'=>'Data spp Berhasil Dihapus!']);
        }else{
            return redirect()->route('spp.index')->with(['error'=>'Data spp Tidak Dapat Disimpan!']);
        }
    }
}
