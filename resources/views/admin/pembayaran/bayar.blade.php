@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <marquee behavior="left" direction="left">Pembayaran SPP</marquee>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pembayaran.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Siswa</label>
                                <input type="text"
                                    class="form-control @error('nama')
                               is-invalid
                               @enderror"
                                    name="nama" value="{{ old('nama', $Siswa->nama) }}"
                                    placeholder="Masukkan Nama Dengan Benar"readonly>
                            </div>

                            <div class="mb-3">
                                <input type="text"
                                    class="form-control @error('siswa_id')
                               is-invalid
                               @enderror"
                                    name="siswa_id" value="{{ old('siswa_id', $Siswa->id) }}"
                                    placeholder="Masukkan Siswa Dengan Benar" hidden>
                                @error('siswa_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Tanggal Pembayaran</label>
                                <input type="date"
                                    class="form-control @error('tanggal_pembayaran')
                               is-invalid
                               @enderror"
                                    name="tanggal_pembayaran" placeholder="Masukkan Tanggal Pembayaran Dengan Benar">
                                @error('tanggal_pembayaran')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bulan</label>
                                <select class="form-select"
                                    @error('bulan')
                              is-invalid
                              @enderror
                                    name="bulan"aria-label="Pilih Bulan ">
                                    <option selected>Masukkan Bulan Pembayaran</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>
                                @error('bulan')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Spp</label>
                                <select
                                    class="form-select @error('spp_id')
                                  is-invalid
                                  @enderror"
                                    name="spp_id" aria-label="Pilih Masa SPP">
                                    <option selected>Yang Harus Dibayarkan</option>
                                    @foreach ($Spp as $s)
                                        <option value="{{ $s->id }}">{{ $s->nominal }}</option>
                                    @endforeach
                                </select>
                                @error('spp_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>




                            <div class="mb-3">
                                <label class="form-label">Jumlah Bayar</label>
                                <input type="number"
                                    class="form-control @error('total_bayar')
                                  is-invalid
                                  @enderror"
                                    name="total_bayar" placeholder="Masukkan Jumlah Bayar Dengan Benar">
                                @error('total_bayar')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Administrator</label>
                                <input type="text"
                                    class="form-control @error('nama_penginput')
                               is-invalid
                               @enderror"
                                    name="nama_penginput"value="{{ Auth::user()->name }}"
                                    placeholder="Masukkan Tanggal Pembayaran Dengan Benar"readonly>

                                @error('nama_penginput')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
