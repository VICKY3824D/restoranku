@extends('admin.layouts.master')
@section('title', 'Detail Pesanan')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}">
@endsection

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Pesanan</h3>
                <p class="text-subtitle text-muted">Informasi detail pesanan yang masuk</p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kode Pesanan : {{ $order->order_code }} </h4>
                <p class="fst-italic">Dibuat Pada : {{ $order->created_at->format('d-m-Y H:i') }}</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>Nama Pelanggan : {{ $order->user->fullname ?? 'Guest' }}</p>
                        <p>Total(+pajak) : Rp. {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                        <p>Status :
                            @if($order->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                            @elseif($order->status == 'settlement')
                                    <span class="badge bg-success">Dibayar</span>
                            @elseif($order->status == 'cooked')
                                    <span class="badge bg-info">Dimasak</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>No. Meja : {{ $order->table_number }}</p>
                        <p>Metode Pembayaran :
                            @if($order->payment_method == 'cash')
                                    <span class="badge bg-secondary">Tunai</span>
                            @elseif($order->payment_method == 'qris')
                                    <span class="badge bg-primary">QRIS</span>
                            @endif
                        </p>
                        <p>Catatan : {{ \Illuminate\Support\Str::limit($order->notes ?? '-', 20) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar menu yang dipesan</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama menu</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $orderItem)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('img_item_upload/'. $orderItem->item->img) }}" style="width: 65px; height: 65px;" class="img-fluid rounded-2" alt="" onerror="this.onerror=null;this.src='{{ $orderItem->item->img }}';">
                                </td>
                                <td>{{ $orderItem->item->name }}</td>
                                <td>Rp.{{ number_format($orderItem->item->price, 0, ',', '.') }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>Rp.{{ number_format($orderItem->price, 0, ',', '.') }}</td>
                            </tr>

                        @endforeach
                    </tbody>
                    <tr class="table-info">
                        <th colspan="5" class="text-end">Subtotal</th>
                        <th>Rp. {{ number_format($order->subtotal, 0, ',', '.') }}</th>
                    </tr>
                    <tr class="table-info-secondary">
                        <th colspan="5" class="text-end">Pajak</th>
                        <th>Rp. {{ number_format($order->tax, 0, ',', '.') }}</th>
                    </tr>
                    <tr class="table-info">
                        <th colspan="5" class="text-end">Total</th>
                        <th>Rp. {{ number_format($order->grand_total, 0, ',', '.') }}</th>
                    </tr>
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
