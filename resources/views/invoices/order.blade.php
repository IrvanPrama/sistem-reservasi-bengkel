<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: sans-serif; }
        table { width:100%; border-collapse: collapse; }
        th,td { border:1px solid #ddd; padding:8px; }
        th { background:#f3f3f3; }
    </style>
</head>

<body>

<h2>Invoice</h2>

<p>
    <strong>Nama Customer:</strong> {{ $order->customer_name }} <br>
    <strong>Telp:</strong> {{ $order->customer_phone }} <br>
    <strong>Tanggal Pesanan:</strong> {{ today()->format('d-M-Y') }} <br>
</p>

<table>
    <thead>
        <tr>
            <th>SKU</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->sku }}</td>
            <td>{{ $item->product_name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>Rp {{ number_format($item->sell_price) }}</td>
            <td>Rp {{ number_format($item->total_amount) }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" style="text-align:right;">Grand Total</th>
            <th>Rp {{ number_format($order->items->sum('total_amount')) }}
        </tr>
    </tfoot>
</table>

</body>
</html>
