<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        /* Define your styles here */
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #333;
        }
        .invoice {
            margin: 20px auto;
            width: 600px;
            border: 1px solid #ccc;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .details .row .label {
            font-weight: bold;
            width: 100px;
        }
        .items {
            margin-bottom: 20px;
        }
        .items .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .items .row .label {
            width: 100px;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <img src="https://dummyimage.com/200x100/ccc/fff" alt="Logo">
            <div class="title">Invoice</div>
        </div>
        <div class="details">
            <div class="row">
                <div class="label">Invoice No:</div>
                <div class="value">{{ $invoice->invoice_no }}</div>
            </div>
            <div class="row">
                <div class="label">Date:</div>
                <div class="value">{{ $invoice->date }}</div>
            </div>
            <div class="row">
                <div class="label">Customer:</div>
                <div class="value">{{ $invoice->customer_name }}</div>
            </div>
            <div class="row">
                <div class="label">Address:</div>
                <div class="value">{{ $invoice->customer_address }}</div>
            </div>
        </div>
        <div class="items">
            <div class="row header">
                <div class="label">Item</div>
                <div class="label">Quantity</div>
                <div class="label">Price</div>
                <div class="label">Total</div>
            </div>
            @foreach ($invoice -> items as $item)
            <div class="row">
                <div class="label">{{ $item->name }}</div>
                <div class="label">{{ $item->quantity }}</div>
                <div class="label">{{ $item->price }}</div>
                <div class="label">{{ $item->subtotal }}</div>
            </div>
            @endforeach
        </div>
        <div class="total">
            <div class="row">
                <div class="label">Subtotal:</div>
                <div class="value">{{ $invoice->subtotal }}</div>
            </div>
            <div class="row">
                <div class="label">Total:</div>
                <div class="value">{{ $invoice->total }}</div>
            </div>
        </div>
    </div>
</body>
