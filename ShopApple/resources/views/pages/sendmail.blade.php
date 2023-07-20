<!DOCTYPE html>
<html>
<head>
    <title>Order Comfirm</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <!-- Add Bootstrap classes to HTML elements -->
    <div class="container">
        <p style="font-style: bold" class="mt-5">Hi {{ $customer_name }},</p>

        <p>Thank you for ordering at the Apple Store. Here is your order information:</p>

        <ul>
            <li>Name: {{ $customer_name }}</li>
            <li>Address: {{ $shipping_address }}</li>
            <li>Phone: {{ $shipping_phone }}</li>
            <li>Note: {{ $shipping_note }}</li>
            @if($payment_method == 2)
            <li>Payment: Paypal</li>
            @elseif($payment_method == 1)
            <li>Payment: Cash</li>
            @endif
        </ul>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Storage</th>
                    <th>Color</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart_items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price) }} VNĐ</td>
                    <td>{{ $item->options->storage }}</td>
                    <td>{{ $item->options->color }}</td>
                    <td>{{ number_format($item->subtotal) }} VNĐ</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{ $total }} VNĐ</td>
                </tr>
            </tfoot>
        </table>

        <p>We will contact you as soon as possible to confirm your order and deliver it to you.</p>

        <p>Best regards,</p>
        <strong>Apple Store</strong>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
