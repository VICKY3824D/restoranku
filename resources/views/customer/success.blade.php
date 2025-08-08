@extends('customer.layout.master')

@section('title', 'Pesanan Berhasil')

@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Rincian Pesanan</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item active text-primary">Silakan periksa rincian anda</li>
        </ol>
    </div>
    <div class="container-fluid  d-fex justify-content-center align-items-center">
            <div class="receipt border p-4 bg-white shadow mx-auto rounded" style="width: 450px; margin-top: 2rem;">
                <h4 class="text-center mb-2 fw-bold">Pesanan berhasil dibuat</h4>
                @if($order->payment_method == 'cash' && $order->status == 'pending')
                    <p class="text-center"><span class="badge bg-danger">Menunggu pembayaran</span></p>
                @elseif($order->payment_method == 'qris' && $order->status == 'pending')
                    <p class="text-center"><span class="badge bg-danger">Menunggu pembayaran</span></p>
                @else
                    <p class="text-center fs-5"><span class="badge bg-success">Pembayaran Berhasil, pesanan diproses!</span>
                    </p>
                @endif
            </div>
    </div>
    <div class="container-fluid mt-3 d-fex justify-content-center align-items-center">
        <div class="receipt border p-4 bg-white shadow mx-auto rounded" style="width: 450px;">
            <h4 class="text-center">Kode bayar:
                <br><span class="text-primary fw-bold">{{ $order->order_code }}</span>
            </h4>
            <hr>
            <h5 class="mb-3 text-center">Detail Pesanan</h5>
            <table class="table table-borderless">
                <tbody>
                    @foreach ($orderItems as $orderItem)
                        <tr>
                            <td>{{ Str::limit($orderItem->item->name, 25) }} ({{ $orderItem->quantity }}x)</td>
                            <td class="text-end">Rp. {{ number_format($orderItem->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <table class="table table-borderless border-top ">
                <tbody>
                <tr>
                    <td class="fst-italic">Subtotal</td>
                    <td class="text-end">Rp. {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="fst-italic">Pajak(10%)</td>
                    <td class="text-end">Rp. {{ number_format($order->tax, 0, ',', '.') }}</td>
                </tr>
                    <tr >
                        <td class="fw-bold fs-5">Total</td>
                        <td class="text-end fw-bold fs-5">Rp. {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            @if($order->payment_method == 'cash')
                <p class="small text-center">Tunjukkan kode bayar ini ke kasir</p>
            @elseif($order->payment_method == 'qris')
                <p class="small text-center">Pembayaran Berhasil, pesanan segera diproses!</p>
            @endif
        </div>
    </div>
@endsection
