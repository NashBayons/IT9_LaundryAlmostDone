<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Tracking - FreshFold Laundry Service</title>
    <style>
        :root {
            --primary-color: #079CD6;
            --secondary-color: #2F356D;
            --accent-color: #17E8FF;
            --text-color: #333;
            --light-text: #fff;
        }
        
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: #f5f5f5;
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
        
        /* Content */
        .content {
            max-width: 1000px;
            margin: 100px auto 50px;
            padding: 0 20px;
        }
        
        .tracking-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .tracking-header {
            background-color: var(--primary-color);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .tracking-header h1 {
            margin: 0;
            font-size: 2rem;
        }
        
        .order-id {
            display: inline-block;
            background-color: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 20px;
            margin-top: 10px;
            font-size: 1.1rem;
        }
        
        .tracking-body {
            padding: 30px;
        }
        
        /* Progress Tracker */
        .progress-tracker {
            margin-bottom: 40px;
        }
        
        .progress-bar {
            height: 12px;
            background-color: #e0e0e0;
            border-radius: 6px;
            margin: 20px 0;
            overflow: hidden;
            position: relative;
        }
        
        .progress {
            height: 100%;
            background-color: var(--primary-color);
            width: {{ $statusProgress }}%;
            transition: width 1s;
        }
        
        .status-steps {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            position: relative;
        }
        
        .status-step {
            flex: 1;
            text-align: center;
            position: relative;
        }
        
        .status-point {
            width: 20px;
            height: 20px;
            background-color: #e0e0e0;
            border-radius: 50%;
            margin: 0 auto 10px;
            position: relative;
            z-index: 2;
        }
        
        .status-step.active .status-point {
            background-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(7, 156, 214, 0.2);
        }
        
        .status-label {
            font-size: 0.9rem;
            color: #777;
            white-space: nowrap;
        }
        
        .status-step.active .status-label {
            color: var(--primary-color);
            font-weight: bold;
        }
        
        /* Order Details */
        .order-details {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        
        .details-column {
            flex: 1;
            min-width: 250px;
        }
        
        .detail-section {
            margin-bottom: 25px;
        }
        
        .detail-section h3 {
            margin-bottom: 15px;
            color: var(--secondary-color);
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }
        
        .detail-item {
            margin-bottom: 12px;
        }
        
        .detail-label {
            font-weight: 600;
            margin-right: 10px;
        }
        
        /* Order Items */
        .order-items {
            margin-top: 30px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .items-table th, 
        .items-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .items-table th {
            font-weight: 600;
            color: var(--secondary-color);
        }
        
        .total-row td {
            font-weight: 600;
            color: var(--secondary-color);
            border-top: 2px solid #eee;
        }
        
        /* Action Button */
        .action-buttons {
            margin-top: 30px;
            text-align: center;
        }
        
        .action-button {
            display: inline-block;
            padding: 12px 25px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .action-button:hover {
            background-color: #0689ba;
        }
        
        /* Footer */
        footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 50px;
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .status-received { background-color: #6c757d; color: white; }
        .status-sorting { background-color: #17a2b8; color: white; }
        .status-washing { background-color: #ffc107; color: #333; }
        .status-drying { background-color: #fd7e14; color: white; }
        .status-folding { background-color: #20c997; color: white; }
        .status-quality_check { background-color: #6f42c1; color: white; }
        .status-ready { background-color: #28a745; color: white; }
        .status-delivered { background-color: #343a40; color: white; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .order-details {
                flex-direction: column;
            }
            
            .items-table {
                font-size: 0.9rem;
            }
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

    <div class="content">
        <div class="tracking-container">
            <div class="tracking-header">
                <h1>Order Tracking</h1>
                <div class="order-id">Order #{{ $order->id }}</div>
            </div>
            
            <div class="tracking-body">
                <div class="progress-tracker">
                    <h2>Current Status: <span class="status-badge status-{{ $order->status }}">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span></h2>
                    
                    <div class="progress-bar">
                        <div class="progress"></div>
                    </div>
                    
                    <div class="status-steps">
                        @php
                            $statuses = ['received', 'sorting', 'washing', 'drying', 'folding', 'quality_check', 'ready', 'delivered'];
                            $currentIndex = array_search(strtolower($order->status), $statuses);
                        @endphp
                        
                        @foreach($statuses as $index => $status)
                            <div class="status-step {{ $index <= $currentIndex ? 'active' : '' }}">
                                <div class="status-point"></div>
                                <div class="status-label">{{ ucfirst(str_replace('_', ' ', $status)) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="order-details">
                    <div class="details-column">
                        <div class="detail-section">
                            <h3>Order Information</h3>
                            <div class="detail-item">
                                <span class="detail-label">Receipt Number:</span>
                                <span>{{ $order->receipt_number }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Order Date:</span>
                                <span>{{ $order->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Expected Completion:</span>
                                <span>{{ $order->expected_completion_date->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="details-column">
                        <div class="detail-section">
                            <h3>Customer Information</h3>
                            <div class="detail-item">
                                <span class="detail-label">Name:</span>
                                <span>{{ $order->customer->name }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Phone:</span>
                                <span>{{ $order->customer->phone }}</span>
                            </div>
                            @if($order->customer->email)
                            <div class="detail-item">
                                <span class="detail-label">Email:</span>
                                <span>{{ $order->customer->email }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="order-items">
                    <h3>Order Items</h3>
                    <table class="items-table">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->service->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                            @endforeach
                            
                            <tr class="total-row">
                                <td colspan="3" align="right">Total:</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="action-buttons">
                    <a href="{{ url('/') }}" class="action-button">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 FreshFold Laundry Service. All rights reserved.</p>
    </footer>
</body>
</html>