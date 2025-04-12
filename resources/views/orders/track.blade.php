<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Tracking - FreshFold Laundry Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #079CD6;
        }
        .section {
            margin-bottom: 25px;
        }
        .label {
            font-weight: bold;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            color: white;
            background-color: #17a2b8;
            font-size: 0.9rem;
        }
        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 15px 0;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .nav-links {
            display: flex;
            gap: 25px;
        }
        
        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="logo">FreshFold</a>
            <div class="nav-links">
                <a href="{{ url('/#home') }}">Home</a>
                <a href="{{ url('/#about') }}">About</a>
                <a href="{{ url('/#guides') }}">Guides</a>
                <a href="{{ url('/#services') }}">Services</a>
                <a href="{{ url('/#view-laundry') }}">View Laundry</a>
                <a href="{{ url('/#contact') }}">Contact</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Order Tracking</h1>

        <div class="section">
            <p><span class="label">Order Name:</span> {{ $order->order_name }}</p>
            <p><span class="label">Weight:</span> {{ $order->weight }} kg</p>
            <p><span class="label">Service Type:</span> {{ $order->service_type }}</p>
            <p><span class="label">Payment Method:</span> {{ $order->payment_method }}</p>
            <p><span class="label">Amount:</span> ${{ number_format($order->amount, 2) }}</p>
            <p><span class="label">Order Date:</span> {{ \Carbon\Carbon::parse($order->date)->format('M d, Y') }}</p>
            <p><span class="label">Status:</span> <span class="badge">{{ ucfirst($order->status) }}</span></p>
        </div>

        <div style="text-align:center;">
            <a href="{{ route('orders.index') }}" style="text-decoration:none; background:#079CD6; color:white; padding:10px 20px; border-radius:5px;">Back to Orders</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 FreshFold Laundry Service. All rights reserved.</p>
    </footer>
</body>
</html>