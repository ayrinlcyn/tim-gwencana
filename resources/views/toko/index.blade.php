@extends('layout.template')
@section('konten')

<div class="my-3 p-3">
    <div class="row">
        <?php $i = $data->firstItem() ?>
        @foreach ($data as $item)
            <div class="col-md-3 mb-3 rounded-2">
                <div class="bg-dark-subtle rounded-3 p-2 d-flex align-items-center">
                    <img src="{{ asset($item->gambar_barang) }}" alt="Gambar Barang" width="" class="img-thumbnail me-2" style="width: 150px; height: 150px; object-fit: cover;">
                    <div>
                        <h5 class="card-text">{{$item->nama_barang}}</h5>
                        <p class="card-text">Rp.{{$item->harga_barang}}</p>
                        <div class="d-flex justify-content-between">
                            <p class="card-text">Kode: <br> {{$item->kode_barang}}</p>
                            <p class="card-text">Stok: <br> {{$item->stok_barang}} </p>
                        </div> 
                        <form action="{{ route('tambah.ke.keranjang', ['id' => $item->id]) }}" method="post">
                            @csrf
                            <input type="hidden" name="toko_id" value="{{ $item->id }}">
                            <label for="quantity">Jumlah:</label>
                            <input type="number" name="quantity" value="0" min="0" style="width: 50px" class="form-control-sm">
                            <button type="submit" class="btn btn-primary btn-sm">Add</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php $i++ ?>
        @endforeach
    </div>
    {{$data->withQueryString()->links()}}
</div>

@endsection