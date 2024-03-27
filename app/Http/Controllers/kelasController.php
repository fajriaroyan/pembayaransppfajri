<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class kelasController extends Controller
{
    public function index()
    {
        $Kelas = Kelas::paginate(5);
        return view('admin.kelas.index', compact('Kelas'));
    }

    public function create()
    {

    }

    public function store (Request $request)
    {
        $this ->validate($request,[
           'name' =>'required ',
           'kopetensi_keahlian' =>'required'
        ]);

        $kelas = Kelas::create([
          'name' => $request->input('name'),
          'kopetensi_keahlian' => $request->input('kopetensi_keahlian'),
        ]);

        if ($kelas){
            return redirect()->route('kelas.index')->with(['success'=>'Data kelas Berhasil Disimpan!']);
        }else{
            return redirect()->route('kelas.index')->with(['error'=>'Data kelas Tidak Dapat Disimpan!']);
        }
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, $id)
    {
       $this->validate($request,[
         'name' =>'required',
         'kopetensi_keahlian'=>'required'
       ]);

       $kelas = Kelas::findOrFail($id);
       $kelas->update([
          'name' =>$request->input('name'),
          'kopetensi_keahlian' =>$request->input('kopetensi_keahlian')
       ]);

       
       if ($kelas){
            return redirect()->route('kelas.index')->with(['update'=>'Data Kelas Berhasil Diupdate!']);
        }else{
            return redirect()->route('kelas.index')->with(['error'=>'Data Kelas Tidak Dapat Disimpan!']);
        }
    }

    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        if ($kelas){
            return redirect()->route('kelas.index')->with(['delete'=>'Data Kelas Berhasil Dihapus!']);
        }else{
            return redirect()->route('Kelas.index')->with(['error'=>'Data Kelas Tidak Dapat Disimpan!']);
        }
    }
}





