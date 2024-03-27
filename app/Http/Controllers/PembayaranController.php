<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    public function index(){
        $pembayaran = Pembayaran::with('siswa','spp')->paginate(10);
        return view('admin.pembayaran.index',compact('pembayaran'));
    }

    public function store (Request $request)
    {
        $this ->validate($request,[
           'siswa_id' =>'required ',
           'tanggal_pembayaran' =>'required',
           'bulan' =>'required',
           'spp_id' =>'required',
           'nama_penginput' =>'required',
           'total_bayar'=>'required',
        ]);

        $pembayaran= Pembayaran::create([
          'siswa_id' => $request->input('siswa_id'),
          'tanggal_pembayaran' => $request->input('tanggal_pembayaran'),
          'bulan' => $request->input('bulan'),
          'spp_id' => $request->input('spp_id'),
          'nama_penginput' => $request->input('nama_penginput'),
          'total_bayar' => $request->input('total_bayar'),
        ]);

        if ($pembayaran){
            return redirect()->route('siswa.index')->with(['success'=>'Data Pembayaran Berhasil Disimpan!']);
        }else{
            return redirect()->route('siswa.index')->with(['error'=>'Data Pembayaran Tidak Dapat Disimpan!']);
        }
    }

    public function show(string $id)
    {
        $pembayaran= Pembayaran::where('siswa_id',$id)->paginate(10);
        return view('admin.pembayaran.show', compact('pembayaran'));
    }
    public function create()
    {
        $data= Pembayaran::all();
        $pdf = Pdf::loadView('admin.pembayaran.invoice', compact('data'));
        return $pdf->stream();
    }

    public function edit($id)
    {
        $Siswa = Siswa::findOrFail($id);
        $Spp = Spp::all();
        return view('admin.pembayaran.bayar', compact('Siswa', 'Spp'));
    }
}

