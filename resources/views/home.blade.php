@extends('layouts.dashboard')
@section('title')
<title>Dashboard</title>
@endsection
@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="content-wrapper">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Aktivitas Toko</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card shadow-none bg-transparent border border-primary mb-3">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{asset('assets/assets/img/icons/unicons/wallet.png')}}"
                                                        alt="chart success" class="rounded" />
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Omset Harian</span>
                                            <h3 class="card-title mb-2 fw-semibold">Rp {{ number_format($totalRevenue,
                                                2, ',', '.') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card shadow-none bg-transparent border border-danger mb-3">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{asset('assets/assets/img/icons/unicons/chart.png')}}"
                                                        alt="chart success" class="rounded" />
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Pelanggan Baru (H-7)</span>
                                            <h3 class="card-title mb-2 fw-semibold">{{$registeredUsersCount}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card shadow-none bg-transparent border border-success mb-3">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{asset('assets/assets/img/icons/unicons/chart-success.png')}}"
                                                        alt="chart success" class="rounded" />
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Perlu Dikirim</span>
                                            <h3 class="card-title mb-2 fw-semibold">{{$shippingCount}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card shadow-none bg-transparent border border-info mb-3">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{asset('assets/assets/img/icons/unicons/chart-success.png')}}"
                                                        alt="chart success" class="rounded" />
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Total Produk</span>
                                            <h3 class="card-title mb-2 fw-semibold">{{$productCount}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection