@extends('layout.template')
@section('konten')
@if ($errors->any())
<div class="pt-3">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{$item}}</li>
            @endforeach
        </ul>

    </div>

</div>
    
@endif

<form action='{{url('toko')}}' method='post' enctype="multipart/form-data">
    @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{url('toko')}}"class="btn btn-danger"><i class="ti ti-arrow-left"></i></a>
            <div class="mb-3 row">
                <label for="kode_barang" class="col-sm-2 col-form-label">KODE BARANG</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name='kode_barang' id="kode_barang" value="{{Session::get('kode_barang')}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">NAMA BARANG</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama_barang' id="nama_barang" value="{{Session::get('nama_barang')}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="kategori_id" class="col-sm-2 col-form-label">KATEGORI</label>
                <div class="col-sm-10">
                <select class="form-control" name="kategori_id" id="kategori_id">
                    <option disabled value>pilih kategori</option>
                    @foreach ($data as $item)
                    <option value="{{$item->id}}">{{$item->kategori}}</option>            
                    @endforeach 
                </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="gambar_barang" class="col-sm-2 col-form-label">GAMBAR</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name='gambar_barang'>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="harga_barang" class="col-sm-2 col-form-label">HARGA</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='harga_barang' id="harga_barang" value="{{Session::get('harga_barang')}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="stok_barang" class="col-sm-2 col-form-label">STOK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='stok_barang' id="stok_barang" value="{{Session::get('stok_barang')}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="submit" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
            </div>
        </div>
</form>
    
@endsection
