<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Receipt</title>
    <style>
        @font-face {
            font-family: 'DejaVuSans';
            src: url('{{ public_path('fonts/DejaVuSans.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'DejaVuSans', sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }

        .receipt-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .receipt-details {
            margin: 20px 0;
        }

        .line-items {
            width: 100%;
            border-collapse: collapse;
        }

        .line-items th,
        .line-items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="receipt-header">
        <h1>Reinz Grill & Restobar</h1>
        <p>Naawan, Misamis Oriental</p>
        <p>Phone: +639672445966 </p>
        <p>Receipt #: INV-{{ $order->id }}</p>
        <p>Date: {{ $order->created_at->format('F d, Y') }}</p>
    </div>

    <div class="receipt-details">
        <h2>Customer Information</h2>
        <p>{{ $order->user->name }}</p>
        <p>{{ $order->user->email }}</p>
    </div>

    <table class="line-items">
        <thead>
            <tr>
                <th>Item Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->dishes as $dish)
                <tr>
                    <td>{{ $dish->name }}</td>
                    <td>{{ $dish->pivot->quantity }}</td>
                    <td>Php.{{ number_format($dish->price, 2) }}</td>
                    <td>Php.{{ number_format($dish->price * $dish->pivot->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p>Total: Php. {{ number_format($order->total, 2) }}</p>
    </div>
</body>

</html>
