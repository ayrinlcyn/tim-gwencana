@extends('layout.template')
@section('konten')

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                <div class="pb-3">
                  <form class="d-flex" action="{{url('toko')}}" method="get">
                      <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
                  </form>
                </div>
                
                <!-- TOMBOL TAMBAH DATA -->
                <div class="pb-3">
                  <a href='{{url('toko/create')}}' class="btn btn-primary">+ Tambah Data</a>
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-2">KODE BARANG</th>
                            <th class="col-md-2">NAMA BARANG</th>
                            <th class="col-md-2">KATEGORI</th>
                            <th class="col-md-2">GAMBAR</th>
                            <th class="col-md-2">HARGA</th>
                            <th class="col-md-2">STOK</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem() ?>
                        @foreach ($data as $item)
                        <tr>
                            <td class="py-5">{{$i}}</td>
                            <td class="py-5">{{$item->kode_barang}}</td>
                            <td class="py-5">{{$item->nama_barang}}</td>
                            <td class="py-5">{{$item->kategori->kategori}}</td>
                            <td class="py-5"><img src="{{ asset($item->gambar_barang) }}" alt="Gambar Barang" width="100"></td>
                            <td class="py-5">{{$item->harga_barang}}</td>
                            <td class="py-5">{{$item->stok_barang}}</td>

                            <td>
                                <a href='{{url('toko/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Yakin akan menghapus data?')" action="{{url('toko/'.$item->id)}}" class="d-inline" method="post">
                                    @csrf
                                    @method("DELETE")
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">
                                    Del
                                </button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++ ?>               
                        @endforeach
                    </tbody>
                </table>
               {{$data->withQueryString()->links()}}
          </div>
          <!-- AKHIR DATA -->
       
@endsection