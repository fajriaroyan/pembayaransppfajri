<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index(){
        $user = User::paginate(10);
        return view('admin.petugas.index',compact('user'));
    }

    public function store (Request $request)
    {
        $this ->validate($request,[
           'name' =>'required ',
           'email' =>'required',
           'password' =>'required',
           'role'=>'required',
        ]);

        $user= User::create([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'password' => Hash::make($request->input('password')),
          'role'=> $request->input('role'),
         
        ]);

        if ($user){
            return redirect()->route('petugas.index')->with(['success'=>'Data Petugas Berhasil Disimpan!']);
        }else{
            return redirect()->route('petugas.index')->with(['error'=>'Data Petugas Tidak Dapat Disimpan!']);
        }
    }

    public function update (Request $request,$id)
    {
        $this ->validate($request,[
           'name' =>'required ',
           'email' =>'required',
           'password' =>'required',
           'role'=>'required',
        ]);

        $user=User::findOrFail($id);
        $user->update([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'password' => Hash::make($request->input('password')),
          'role'=> $request->input('role'),
         
        ]);

        if ($user){
            return redirect()->route('petugas.index')->with(['update'=>'Data Petugas Berhasil Diupdate!']);
        }else{
            return redirect()->route('petugas.index')->with(['error'=>'Data Petugas Tidak Dapat Disimpan!']);
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

    public function destroy(string $id)
    {
        $petugas = User::findOrFail($id);
        $petugas->delete();

        if ($petugas){
            return redirect()->route('petugas.index')->with(['delete'=>'Data Petugas Berhasil Dihapus!']);
        }else{
            return redirect()->route('petugas.index')->with(['error'=>'Data Petugas Tidak Dapat Disimpan!']);
        }
    }

}
