 @extends('layouts.main')

 @section('content')
     <div class="container">
         <div class="row justify-content-center">
             @if ($message = Session::get('success'))
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>{{ $message }}</strong>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @endif
             @if ($message = Session::get('update'))
                 <div class="alert alert-primary alert-dismissible fade show" role="alert">
                     <strong>{{ $message }}</strong>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @endif
             @if ($message = Session::get('delete'))
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>{{ $message }}</strong>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @endif
             <div class="col-md-8">
                 <div class="card">
                     <div class="card-header">
                         <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                             class="btn btn-primary btn-sm">Tambah SPP</a>
                     </div>

                     <div class="card-body">
                         <table class="table table-hover">
                             <thead>
                                 <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">NISN | NIS</th>
                                     <th scope="col">Nama</th>
                                     <th scope="col">Kelas</th>
                                     <th scope="col">No HP</th>
                                     <th scope="col">Aksi</th>
                                 </tr>
                             </thead>
                             <tbody>

                                 @forelse($Siswa as $no => $s)
                                     <tr>
                                         <th scope="row"> {{ ++$no }}</th>
                                         <td>{{ $s->nisn }} |{{ $s->nis }}</td>
                                         <td>{{ $s->nama }}</td>
                                         <td>{{ $s->kelas->name }}</td>
                                         <td>{{ $s->no_hp }}</td>
                                         <td>
                                             <form action="{{ route('siswa.destroy', $s->id) }}" method="POST"
                                                 onsubmit="return confirm ('Apakah Anda Ingin Menghapus Data Ini?')">
                                                 <a href="#" data-bs-toggle="modal"
                                                     data-bs-target="#edit{{ $s->id }}"class="btn btn-secondary btn-sm">Edit</a>
                                                 <a href="#" data-bs-toggle="modal"
                                                     data-bs-target="#lihat{{ $s->id }}"class="btn btn-warning btn-sm">Lihat</a>
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                             </form>

                                             <div class="dropdown mt-1">
                                                 <button class="btn btn-info dropdown-toggle" type="button"
                                                     id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                     aria-expanded="false">
                                                     Status
                                                 </button>
                                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                     <li><a class="dropdown-item"
                                                             href="{{ route('pembayaran.show', $s->id) }}">Riwayat</a></li>
                                                     <li><a class="dropdown-item" href="{{route('pembayaran.edit', $s->id)}}"
                                                            >Bayar</a>
                                                     </li>
                                                 </ul>
                                             </div>
                                         </td>

                                     @empty
                                         <div class="alert alert-danger d-flex align-items-center" role="alert">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 fill="currentColor"
                                                 class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                                 viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                 <path
                                                     d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                             </svg>
                                             <div>
                                                 Data Siswa Belum Tersedia!
                                             </div>
                                         </div>
                                     </tr>
                                 @endforelse
                             </tbody>
                         </table>
                         {{ $Siswa->links() }}
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection


 @push('modal')
     <!-- Modal -->
     <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <form action="{{ route('siswa.store') }}"method="POST">
                         @csrf
                         <div class="mb-3">
                             <label class="form-label">Nama Siswa</label>
                             <input type="text"
                                 class="form-control @error('nama') 
                             is-invalid
                             @enderror"
                                 name="nama" placeholder="Masukkan Nama Dengan Benar">
                             @error('nama')
                                 <div class="alert alert-danger" role="alert">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>

                         <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                class="form-control @error('email') 
                            is-invalid
                            @enderror"
                                name="email" placeholder="Masukkan Email Dengan Benar">
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                class="form-control @error('password') 
                            is-invalid
                            @enderror"
                                name="password" placeholder="Masukkan Password Dengan Benar">
                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                         <div class="mb-3">
                             <label class="form-label">NISN</label>
                             <input type="number"
                                 class="form-control @error('nisn') 
                          is-invalid
                          @enderror"
                                 name="nisn" placeholder="Masukkan NISN Dengan Benar">
                             @error('nisn')
                                 <div class="alert alert-danger" role="alert">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>

                         <div class="mb-3">
                             <label class="form-label">NIS</label>
                             <input type="number"
                                 class="form-control @error('nisn') 
                         is-invalid
                         @enderror"
                                 name="nis" placeholder="Masukkan NIS Dengan Benar">
                             @error('nis')
                                 <div class="alert alert-danger" role="alert">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>
                         <div class="mb-3">
                             <label class="form-label">Kelas</label>
                             <select class="form-select"
                                 @error('kelas_id') 
                            is-invalid
                            @enderror
                                 name="kelas_id"aria-label="Pilih Kelas ">
                                 <option selected>Open this select menu</option>
                                 @foreach ($Kelas as $k)
                                     <option value="{{ $k->id }}">{{ $k->name }}</option>
                                 @endforeach
                             </select>
                             @error('kelas_id')
                                 <div class="alert alert-danger" role="alert">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>

                         <div class="mb-3">
                             <label class="form-label">Alamat</label>
                             <textarea class="form-control"
                                 @error('alamat') 
                                is-invalid
                                @enderror
                                 name="alamat" rows="3"></textarea>

                             @error('alamat')
                                 <div class="alert alert-danger" role="alert">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>

                         <div class="mb-3">
                             <label class="form-label">No Hp</label>
                             <input type="number"
                                 class="form-control @error('no_hp') 
                             is-invalid
                             @enderror"
                                 name="no_hp" placeholder="Masukkan No Hp Dengan Benar">
                             @error('no_hp')
                                 <div class="alert alert-danger" role="alert">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>



                         <div class="mb-3">
                             <label class="form-label">Spp</label>
                             <select class="form-select"
                                 @error('spp_id') 
                            is-invalid
                            @enderror
                                 name="spp_id"aria-label="Pilih Masa SPP ">
                                 <option selected>Open this select menu</option>
                                 @foreach ($Spp as $s)
                                     <option value="{{ $s->id }}">{{ $s->tahun }}</option>
                                 @endforeach
                             </select>
                             @error('spp_id')
                                 <div class="alert alert-danger" role="alert">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>





                         <div class="modal-footer justify-content-between">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                             <button type="submit" class="btn btn-success">Simpan</button>
                         </div>
                 </div>
                 </form>
             </div>
         </div>
     </div>

     <!-- Modal Edit -->
     @foreach ($Siswa as $s)
         <div class="modal fade" id="edit{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <form action="{{ route('siswa.update', $s->id) }}"method="POST">
                             @csrf
                             @method('PUT')
                             <div class="mb-3">
                                 <label class="form-label">Nama Siswa</label>
                                 <input type="text"
                                     class="form-control @error('nama') 
                                is-invalid
                                @enderror"
                                     name="nama" value="{{ old('nama', $s->nama) }}"
                                     placeholder="Masukkan Nama Dengan Benar">
                                 @error('nama')
                                     <div class="alert alert-danger" role="alert">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>

                             <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email"
                                    class="form-control @error('email') 
                               is-invalid
                               @enderror"
                                    name="email" value="{{ old('email', $s->email) }}"
                                    placeholder="Masukkan Email Dengan Benar">
                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password"
                                    class="form-control @error('password') 
                               is-invalid
                               @enderror"
                                    name="password" value="{{ old('password', $s->password) }}"
                                    placeholder="Masukkan Password Dengan Benar">
                                @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                             <div class="mb-3">
                                 <label class="form-label">NISN</label>
                                 <input type="number"
                                     class="form-control @error('nisn') 
                             is-invalid
                             @enderror"
                                     name="nisn" value="{{ old('nisn', $s->nisn) }}"
                                     placeholder="Masukkan NISN Dengan Benar" readonly>
                                 @error('nisn')
                                     <div class="alert alert-danger" role="alert">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>

                             <div class="mb-3">
                                 <label class="form-label">NIS</label>
                                 <input type="number"
                                     class="form-control @error('nisn') 
                            is-invalid
                            @enderror"
                                     name="nis"value="{{ old('nis', $s->nis) }}"
                                     placeholder="Masukkan NIS Dengan Benar" readonly>
                                 @error('nis')
                                     <div class="alert alert-danger" role="alert">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>


                             <div class="mb-3">
                                 <label class="form-label">Kelas</label>
                                 <select class="form-select"
                                     @error('kelas_id') 
                               is-invalid
                               @enderror
                                     name="kelas_id"aria-label="Pilih Kelas ">
                                     <option selected>{{ $s->kelas_id }}</option>
                                     @foreach ($Kelas as $k)
                                         <option value="{{ $k->id }}">{{ $k->name }}</option>
                                     @endforeach
                                 </select>
                                 @error('kelas_id')
                                     <div class="alert alert-danger" role="alert">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>

                             <div class="mb-3">
                                 <label class="form-label">Alamat</label>
                                 <textarea class="form-control"
                                     @error('alamat') 
                                   is-invalid
                                   @enderror
                                     name="alamat" rows="3">{{ $s->alamat }}</textarea>

                                 @error('alamat')
                                     <div class="alert alert-danger" role="alert">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>

                             <div class="mb-3">
                                 <label class="form-label">No Hp</label>
                                 <input type="number"
                                     class="form-control @error('no_hp') 
                                is-invalid
                                @enderror"
                                     name="no_hp" value="{{ old('no_hp', $s->no_hp) }}"
                                     placeholder="Masukkan No Hp Dengan Benar">
                                 @error('no_hp')
                                     <div class="alert alert-danger" role="alert">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>



                             <div class="mb-3">
                                 <label class="form-label">Spp</label>
                                 <select class="form-select"
                                     @error('spp_id') 
                               is-invalid
                               @enderror
                                     name="spp_id"aria-label="Pilih Masa SPP ">
                                     <option selected>{{ $s->spp_id }}</option>
                                     @foreach ($Spp as $s)
                                         <option value="{{ $s->id }}">{{ $s->tahun }}</option>
                                     @endforeach
                                 </select>
                                 @error('spp_id')
                                     <div class="alert alert-danger" role="alert">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>





                             <div class="modal-footer justify-content-between">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                 <button type="submit" class="btn btn-success">Simpan</button>
                             </div>
                     </div>
                     </form>
                 </div>
             </div>
         </div>
     @endforeach

     <!-- Modal tampil -->
     @foreach ($Siswa as $s)
         <div class="modal fade" id="lihat{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Detail Data Siswa</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <p> Nama Siswa:{{ $s->nama }}</p>
                         <p>NISN/NIS : {{ $s->nisn }} | {{ $s->nis }}</p>
                         <p>Alamat Siswa : {!! $s->alamat !!}</p>
                         <p>Nomor : {{ $s->no_hp }}</p>
                         <p>Kelas : {{ $s->kelas->name }}</p>
                         <p>Tahun SPP : {{ $s->spp->tahun }}</p>
                         <p>Nominal SPP :<span
                                 class="btn btn-danger">{{ 'Rp.' . number_format($s->spp->nominal, 2, '.', '.') }}</span>
                         </p>
                     </div>
                 </div>
             </div>
     @endforeach


 @endpush
