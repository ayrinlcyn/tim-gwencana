<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\toko;
use App\Models\Kategori;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class tokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 12;

        $data = toko::with('kategori')
            ->when(strlen($katakunci), function ($query) use ($katakunci) {
                $query->where('kode_barang', 'like', "%$katakunci%")
                    ->orWhere('nama_barang', 'like', "%$katakunci%");
            })
            ->orderBy('kode_barang', 'desc')
            ->paginate($jumlahbaris);

        return view('toko.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Kategori::all();
        return view('toko.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|numeric|unique:toko,kode_barang',
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_barang' => 'required',
            'stok_barang' => 'required',
        ], [
            'kode_barang.required' => 'KODE BARANG WAJIB DI ISI',
            'kode_barang.numeric' => 'KODE BARANG WAJIB DI ISI ANGKA',
            'kode_barang.unique' => 'KODE BARANG SUDAH TERDAFTAR',
            'nama_barang.required' => 'NAMA BARANG WAJIB DI ISI',
            'kategori_id.required' => 'KATEGORI BARANG WAJIB DI ISI',
            'harga_barang.required' => 'HARGA BARANG WAJIB DI ISI',
            'gambar_barang.required' => 'GAMBAR BARANG WAJIB DI ISI',
            'gambar_barang.image' => 'GAMBAR HARUS BERUPA FILE GAMBAR',
            'gambar_barang.mimes' => 'FORMAT GAMBAR HARUS JPEG, PNG, JPG, ATAU GIF',
            'gambar_barang.max' => 'UKURAN GAMBAR TIDAK BOLEH MELEBIHI 2 MB',
            'stok_barang.required' => 'STOK BARANG WAJIB DI ISI',
           
        ]);

        $imageName = time() . '.' . $request->gambar_barang->extension();
        $request->gambar_barang->move(public_path('gambarbarang'), $imageName);
        $imagePath = 'gambarbarang/' . $imageName;

        $data = [
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'gambar_barang' => $imagePath,
            'harga_barang' => $request->harga_barang,
            'stok_barang' => $request->stok_barang,
        ];

        if ($request->stok_barang >= 1) {
            toko::create($data);
            // Kurangi stok di tabel 'toko'
            toko::where('kode_barang', $request->kode_barang)->decrement('stok_barang', 1);
        } else {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi.');
        }        

        return redirect()->route('toko.index')->with('success', 'Berhasil menambahkan data');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function actionView(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 12;

        $data = toko::with('kategori')
            ->when(strlen($katakunci), function ($query) use ($katakunci) {
                $query->where('kode_barang', 'like', "%$katakunci%")
                    ->orWhere('nama_barang', 'like', "%$katakunci%");
            })
            ->orderBy('kode_barang', 'desc')
            ->paginate($jumlahbaris);

    return view('toko.action')->with('data', $data);
    }


public function updateCartQuantity(Request $request)
{
    $itemId = $request->input('itemId');
    $quantity = $request->input('quantity');


    return response()->json(['message' => 'Quantity updated successfully']);
}

    public function edit(int $id)
    {
        $data1 = Kategori::all();
        $data = toko::find($id);
        return view('toko.edit', ['data' => $data, 'kategori' => $data1])->with('data', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'harga_barang' => 'required',
            'stok_barang' => 'required|numeric|min:0',
        ], [
            'nama_barang.required' => 'NAMA BARANG WAJIB DI ISI',
            'kategori_id.required' => 'KATEGORI BARANG WAJIB DI ISI',
            'harga_barang.required' => 'HARGA BARANG WAJIB DI ISI',
            'stok_barang.required' => 'STOK BARANG WAJIB DI ISI',
        ]);
    
        $data = [
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'harga_barang' => $request->harga_barang,
            'stok_barang' => $request->stok_barang,
        ];
    
        // Handle file upload
        if ($request->hasFile('gambar_barang')) {
            $imageName = time() . '.' . $request->gambar_barang->extension();
            $request->gambar_barang->move(public_path('gambarbarang'), $imageName);
            $imagePath = 'gambarbarang/' . $imageName;
    
            $data['gambar_barang'] = $imagePath;
        }
    
        toko::where('id', $id)->update($data);
    
        return redirect()->route('toko.action')->with('success', 'Berhasil update data');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        toko::where('id',$id)->delete();   
        return redirect()->to('toko')->with('success','Berhasil melakukan delete data');
    }
}   
