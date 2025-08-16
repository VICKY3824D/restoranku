@extends('admin.layouts.master')
@section('title', 'Daftar Pesanan')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}">
@endsection

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Pesanan</h3>
                <p class="text-subtitle text-muted">Informasi pesanan yang masuk</p>
            </div>
{{--            <div class="col-12 col-md-6 order-md-2 order-first">--}}
{{--                <a href="{{ route('admin.items.create') }}" class="btn btn-primary float-start float-lg-end">--}}
{{--                    <i class="bi bi-plus"></i>--}}
{{--                    Tambah Menu--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p></p><i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>No. Meja</th>
                            <th>Metode Pembayaran</th>
                            <th>Catatan</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->user->fullname ?? 'Guest' }}</td>
                                <td>Rp. {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($order->status == 'settlement')
                                        <span class="badge bg-info">Dibayar</span>
                                    @elseif($order->status == 'cooked')
                                        <span class="badge bg-success">Dimasak</span>
                                    @endif
                                </td>
                                <td>{{ $order->table_number }}</td>
                                <td>
                                    @if($order->payment_method == 'cash')
                                        <span class="badge bg-secondary">Tunai</span>
                                    @elseif($order->payment_method == 'qris')
                                        <span class="badge bg-primary">QRIS</span>
                                    @endif
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($order->notes ?? '-', 20) }}</td>
                                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-primary">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-white">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection

@section('script')
    <script src="{{ asset('assets/admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/admin/static/js/pages/simple-datatables.js') }}"></script>
@endsection
