@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - Bidan Fina')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>
            </div>
        </div>

        <!-- Cards Row -->
        <div class="row">
            <!-- Products Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Produk
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Layanan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $items->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-stethoscope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reservations Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Reservasi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $reservations }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonials Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Testimoni
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $testimonials }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-star fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Recent Services -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Layanan Terbaru</h6>
                    </div>
                    <div class="card-body">
                        @if ($items->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Layanan</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items->take(5) as $service)
                                            <tr>
                                                <td>{{ $service->name }}</td>
                                                <td>Rp {{ number_format($service->price ?? 0, 0, ',', '.') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.services.show', $service) }}"
                                                        class="btn btn-sm btn-info">Lihat</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center text-muted">Belum ada layanan.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Produk
                            </a>
                            <a href="{{ route('admin.services.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Tambah Layanan
                            </a>
                            <a href="{{ route('admin.galleries.create') }}" class="btn btn-info">
                                <i class="fas fa-plus"></i> Tambah Galeri
                            </a>
                            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-warning">
                                <i class="fas fa-plus"></i> Tambah Testimoni
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
