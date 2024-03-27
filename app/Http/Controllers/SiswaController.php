<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $Siswa = Siswa::with ('kelas', 'spp')->paginate(5);
        $Kelas = Kelas::all(); 
        $Spp = Spp::all(); 
        return view('admin.siswa.index', compact('Siswa','Kelas','Spp'));
    }

    public function create()
    {

    }

    public function store (Request $request)
    {
        $this->validate($request,[
           'nisn' =>'required|unique:siswas,nisn, ',
           'nis' =>'required|unique:siswas,nis, ',
           'nama' =>'required',
           'kelas_id' =>'required',
           'alamat' =>'required',
           'no_hp' =>'required',
           'spp_id' =>'required',
           'email' =>'required',
           'password' =>'required',
        ]);

        $Siswa = Siswa::create([
          'nisn' => $request->input('nisn'),
          'nis' => $request->input('nis'),
          'nama' => $request->input('nama'),
          'kelas_id' => $request->input('kelas_id'),
          'alamat' => $request->input('alamat'),
          'no_hp' => $request->input('no_hp'),
          'spp_id' => $request->input('spp_id'),
          'email' => $request->input('email'),
          'password'=>$request->input('password')
        ]);

        if ($Siswa){
            return redirect()->route('siswa.index')->with(['success'=>'Data Siswa Berhasil Disimpan!']);
        }else{
            return redirect()->route('siswa.index')->with(['error'=>'Data Siswa Tidak Dapat Disimpan!']);
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
        $this ->validate($request,[
            'nisn' =>'required',
            'nis' =>'required',
            'nama' =>'required',
            'kelas_id' =>'required',
            'alamat' =>'required',
            'no_hp' =>'required',
            'spp_id' =>'required',
            'email' =>'required',
           'password' =>'required',
         ]);

       $Siswa = Siswa::findOrFail($id);
       $Siswa->update([
        'nisn' => $request->input('nisn'),
        'nis' => $request->input('nis'),
        'nama' => $request->input('nama'),
        'kelas_id' => $request->input('kelas_id'),
        'alamat' => $request->input('alamat'),
        'no_hp' => $request->input('no_hp'),
        'spp_id' => $request->input('spp_id'),
        'email' => $request->input('email'),
          'password' =>  Hash::make($request->input('password')),
       ]);

       
       if ($Siswa){
        return redirect()->route('siswa.index')->with(['update'=>'Data Siswa Berhasil Diupdate!']);
    }else{
        return redirect()->route('siswa.index')->with(['error'=>'Data Siswa Tidak Dapat Disimpan!']);
    }
    }

    public function destroy(string $id)
    {
        $Siswa = Siswa::findOrFail($id);
        $Siswa->delete();

        if ($Siswa){
            return redirect()->route('siswa.index')->with(['delete'=>'Data Siswa Berhasil Dihapus!']);
        }else{
            return redirect()->route('siswa.index')->with(['error'=>'Data Siswa Tidak Dapat Disimpan!']);
        }
    }

    public function ChangePassword($request,$id)
    {
      $this->validate($request,[
        'password' =>'required',
      ]);

      $siswa= Siswa::findOrFail($id);
      $siswa->update([
        'password'=>bcrypt($request->input('password')),
      ]);

      if($siswa){
        return redirect()->route('siswa.index')->with(['update'=>'Password Berhasil Diperbaharui!']);
      } else{
        return redirect()->route('siswa.index')->with(['error'=>'Password Tidak Berhasil Disimpan!']);
      }
    }
}

