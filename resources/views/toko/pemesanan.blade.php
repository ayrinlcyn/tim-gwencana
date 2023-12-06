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

<form action='' method='post' enctype="multipart/form-data">
    @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href=""class="btn btn-secondary"><< Kembali</a>
            <div class="mb-3 row">
                <label for="tanggal_pemesanan" class="col-sm-2 col-form-label">tanggal pemesanan</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name='tanggal_pemesanan' id="tanggal_pemesanan" value="">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="toko_id" class="col-sm-2 col-form-label">pesanan/label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='toko_id' id="pesanan" value="">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jumlah_pemesanan" class="col-sm-2 col-form-label">jumlah barang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="jumlah_pemesanan">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="total_harga" class="col-sm-2 col-form-label">total harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='harga_barang' id="total_harga" value="">
                </div>
            </div>
        </div>
</form>
    
@endsection
