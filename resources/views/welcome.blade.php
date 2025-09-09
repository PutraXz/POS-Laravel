@extends('layouts.app')
{{-- Sidebar Left (overlay) --}}
<aside class="sidebar-left" id="sidebarLeft">
    @include('layouts.sidebar-left')
</aside>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- Navbar (fixed at top) --}}
@include('layouts.navbar-home')

{{-- Sidebar Right (permanent, below navbar) --}}
<aside class="sidebar-right">
    @include('layouts.sidebar-right')
</aside>
@section('content')
    <div class="container">
        <form class="d-flex w-25 me-3 mt-3" style="height: 2.5rem">
            <input type="search" class="form-control bg-light text-dark border-100" placeholder="Search...">
        </form>
        <div class="button-category mb-5 mt-3">
            <button class="btn text-light me-3 btn-c">Semua</button>
            <button class="btn text-light me-3 btn-c">Makanan</button>
            <button class="btn text-light me-3 btn-c">Minuman</button>
            <button class="btn text-light me-3 btn-c">Snack</button>
            <button class="btn text-light btn-c">Mie</button>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-3 mb-4">
                    <div class="card" style="width: 20rem;">
                        <img src="{{ asset('img_product/') . '/' . $product->image }}" class="card-img-top w-60"
                            alt="...">
                        <div class="card-body">
                            <p class="card-text text-center">{{ $product->name_product }}</p>
                            <p class="card-text text-center" style="color:#9C2C77;font-weight:500">
                                {{ 'Rp' . number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
