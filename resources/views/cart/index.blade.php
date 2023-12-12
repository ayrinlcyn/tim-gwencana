@extends('layout.template')

@section('konten')
    <div class="my-3 p-3">
        <h2>Keranjang Belanja Anda</h2>

        @if (empty($cartItems))
            <p>Keranjang Anda kosong.</p>
        @else
            @php
                $totalHarga = 0;
            @endphp

            @foreach ($cartItems as $cartItem)
                <div class="m-2 mx-auto" style="width: 80%;">
                    <div class="bg-dark-subtle rounded-3 p-2 d-flex align-items-center">
                        <img src="{{ asset($cartItem['toko']->gambar_barang) }}" alt="Gambar Barang" class="img-thumbnail me-2" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="d-flex">
                            <h4>{{ $cartItem['toko']->nama_barang }}</h4>
                        </div>
                        <div class="d-flex mx-auto">
                            <p class="ms-5">Jumlah: <span id="quantity_{{ $cartItem['toko']->id }}">{{ $cartItem['quantity'] }}</span></p>
                            <p class="ms-5">Rp. {{ $cartItem['toko']->harga_barang }}</p>
                        </div>
                        <form class="update-cart-form d-flex ms-5">
                            @csrf
                            <input type="hidden" name="itemId" value="{{ $cartItem['id'] }}">
                            <label for="quantity">Ubah Jumlah:</label>
                            <div class="input-group ms-5">
                                <button type="button" class="btn quantity-btn" data-action="decrement"><i class="ti ti-circle-minus"></i></button>
                                <input type="number" name="quantity" value="{{ $cartItem['quantity'] }}" min="1" style="width: 40px; height:40px;" class="form-control-sm quantity-input rounded-3">
                                <button type="button" class="btn quantity-btn" data-action="increment"><i class="ti ti-circle-plus"></i></button>
                            </div>
                            <button type="button" class="btn btn-warning btn-sm update-cart-btn ms-2 rounded-3">Update</button>
                        </form>
                        <form action="{{ route('cart.removeItem', ['id' => $cartItem['id']]) }}" method="POST" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg"><i class="ti ti-trash"></i></button>
                        </form>
                    </div>
                </div>

                @php
                    $totalHarga += $cartItem['toko']->harga_barang * $cartItem['quantity'];
                @endphp
            @endforeach
            <div class="container">
                <div class="row justify-content-center ">
                    <div class="mt-3 bg-dark-subtle rounded-3 d-flex">
                        <div style="width: 80%;">
                            <h5 class="pt-3">Total Harga: Rp. {{ $totalHarga }}</h5>
                        </div>
                        {{-- <div class="text-end p-2" style="width: 20%;">
                            <a href="{{ route('checkout') }}" class="btn btn-primary">Lanjutkan pemesanan</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        @endif
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateButtons = document.querySelectorAll('.update-cart-btn');
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const quantityBtns = document.querySelectorAll('.quantity-btn');

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.update-cart-form');
                const quantityInput = form.querySelector('.quantity-input');
                const itemId = form.querySelector('input[name="itemId"]').value;
                const newQuantity = quantityInput.value;

                fetch('{{ route("cart.updateQuantity") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        itemId: itemId,
                        quantity: newQuantity,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Quantity updated successfully') {
                        document.getElementById(`quantity_${itemId}`).innerText = newQuantity;
                    } else {
                        console.error('Failed to update quantity.');
                    }
                })
                .catch(error => {
                    console.error('Error updating quantity:', error);
                });
            });
        });

        quantityBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const input = this.parentElement.querySelector('.quantity-input');
                const action = this.dataset.action;
                let newValue;

                if (action === 'increment') {
                    newValue = parseInt(input.value, 10) + 1;
                } else if (action === 'decrement') {
                    newValue = parseInt(input.value, 10) - 1;
                    newValue = newValue < 1 ? 1 : newValue;
                }

                input.value = newValue;
            });
        });
    });
</script>
@endsection