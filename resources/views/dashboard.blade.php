@extends('layouts.dashboard-layout')
@include('layouts.navbar-home')

<aside class="sidebar-dashboard show" id="sidebarLeft">
    @include('layouts.sidebar-dashboard')
</aside>
@section('content')
    <h4>Dashboard</h4>
    <div class="card-transaksi">
        <div class="row g-5">
            <div class="col-3">
                <div class="card" style="">
                    <div class="card-body">
                        <p class="card-text">Total Penjualan</p>
                        <p class="card-text fw-bold" style="font-weight:500">Rp. 50.000</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="">
                    <div class="card-body">
                        <p class="card-text">Transaksi</p>
                        <p class="card-text" style="font-weight:500">Rp. 50.000</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="">
                    <div class="card-body">
                        <p class="card-text">Laba Kotor</p>
                        <p class="card-text" style="font-weight:500">Rp. 50.000</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="">
                    <div class="card-body">
                        <p class="card-text">Labar Bersih</p>
                        <p class="card-text" style="font-weight:500">Rp. 50.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-diagram my-4">
        <div class="row">
            <div class="col-4">
                <div class="card" style="">
                    <div class="card-body">
                        <p class="card-text">Laba Kotor</p>
                        <p class="card-text" style="font-weight:500">Rp. 50.000</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="">
                    <div class="card-body">
                        <p class="card-text">Laba Kotor</p>
                        <p class="card-text" style="font-weight:500">Rp. 50.000</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="">
                    <div class="card-body">
                        <p class="card-text">Laba Kotor</p>
                        <p class="card-text" style="font-weight:500">Rp. 50.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="total-transaksi">
        <div class="row">
            <div class="col-12">
                <div class="card" style="">
                    <div class="card-body">
                        <p class="card-text">Laba Kotor</p>
                        <p class="card-text" style="font-weight:500">Rp. 50.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
