<div class="p-3">
    <div class="text-invoice d-flex justify-content-between my-3">
        <h5>Invoice</h5>
        <h5>#001</h5>
    </div>

    @forelse($cart as $item)
        <div class="mb-3">
            <div class="card" style="width:19rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 d-flex align-items-center">
                            <img src="{{ asset('img_product/'.$item['image']) }}" class="img-fluid w-100 rounded" alt="">
                        </div>
                        <div class="col-7">
                            <div class="card-title">{{ $item['name'] }}</div>

                            <div class="text-items d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold" style="color:#9C2C77">
                                    Rp {{ number_format($item['price']*$item['qty'],0,',','.') }}
                                </h6>
                                <button class="btn btn-link p-0 text-danger cart-remove" data-id="{{ $item['id'] }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>

                            <div class="card-title d-flex align-items-center">
                                <button class="btn rounded btn-sm cart-dec" data-id="{{ $item['id'] }}" style="background-color:#9C2C77">
                                    <i class="fa-solid fa-minus text-white"></i>
                                </button>
                                <span class="mx-3 fw-bold cart-qty" data-id="{{ $item['id'] }}">{{ $item['qty'] }}</span>
                                <button class="btn rounded btn-sm cart-inc" data-id="{{ $item['id'] }}" style="background-color:#9C2C77">
                                    <i class="fa-solid fa-plus text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Keranjang kosong.</p>
    @endforelse

    <hr>
    <button class="btn w-100 my-3 text-light text-start" style="background-color:#9C2C77">% Promo & Diskon</button>

    <div class="d-flex justify-content-between"><span>Subtotal</span><span>Rp {{ number_format($tot['subtotal'] ?? 0,0,',','.') }}</span></div>
    <div class="d-flex justify-content-between"><span>Diskon</span><span>- Rp {{ number_format($tot['diskon'] ?? 0,0,',','.') }}</span></div>
    <div class="d-flex justify-content-between"><span>Pajak</span><span>Rp {{ number_format($tot['pajak'] ?? 0,0,',','.') }}</span></div>
    <hr style="border:none;border-top:3px dashed #9C2C77;opacity:inherit">
    <div class="d-flex justify-content-between fw-bold"><span>Total</span><span>Rp {{ number_format($tot['total'] ?? 0,0,',','.') }}</span></div>

    <button class="btn w-100 mt-3 text-light" style="background-color:#9C2C77">Pilih Metode Pembayaran</button>
</div>
