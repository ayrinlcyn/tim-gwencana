@extends('layout.template')

@section('konten')

<div class="my-3 p-3 ">
    <div class="row justify-content-center">
        <?php $i = $data->firstItem() ?>
        @foreach ($data as $item)
        <div class="col-md-3 mb-3">
            <div class="bg-dark-subtle rounded-3 p-2 d-flex align-items-center">
                <img src="{{ asset($item->gambar_barang) }}" alt="Gambar Barang" class="img-thumbnail me-2" style="width: 150px; height: 150px; object-fit: cover;">
                <div>
                    <p class="card-text">{{$item->nama_barang}}</p>
                    <p class="card-text">{{$item->harga_barang}}</p>
                    <p class="card-text">{{$item->kategori->kategori}}</p>
                    <div class="d-flex justify-content-between">
                        <p class="card-text me-4">Kode: <br> {{$item->kode_barang}}</p>
                        <p class="card-text">Stok: <br> {{$item->stok_barang}} </p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ url('toko/'.$item->id.'/edit') }}" class="btn btn-warning btn-sm"><i class=" ti ti-edit"></i>Edit</a>
                    
                        <form onsubmit="return confirm('Yakin akan menghapus data?')" action="{{ url('toko/'.$item->id) }}" class="d-inline" method="post">
                            @csrf
                            @method("DELETE")
                    
                            <button type="submit" name="submit" class="btn btn-danger btn-sm ms-2">
                                <i class=" ti ti-trash"></i>Del
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++ ?>
        @endforeach
    </div>
    {{$data->withQueryString()->links()}}
</div>

@endsection
