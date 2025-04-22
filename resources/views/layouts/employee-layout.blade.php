<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }
    .view-order-status-customer {
      background: linear-gradient(
          137.15deg,
          rgba(23, 232, 255, 0) 0%,
          rgba(23, 232, 255, 0.2) 100%
        ),
        linear-gradient(to left, rgba(7, 156, 214, 0.2), rgba(7, 156, 214, 0.2)),
        linear-gradient(
          119.69deg,
          rgba(93, 141, 230, 0) 0%,
          rgba(142, 176, 239, 0.1) 45.69%,
          rgba(36, 89, 188, 0.2) 96.88%
        ),
        linear-gradient(to left, rgba(47, 53, 109, 0.2), rgba(47, 53, 109, 0.2));
      height: 100vh;
      box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
      overflow: hidden;
      display: flex;
    }
    .sidebar {
      background: rgba(217, 217, 217, 0.5);
      width: 250px;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .sidebar img {
      width: 100%;
      max-width: 150px;
      margin-bottom: 20px;
    }
    .sidebar .nav-link {
      color: #000000;
      font-size: 1.2rem;
      margin: 10px 0;
      text-align: center;
    }
    .sidebar .log-out {
      margin-top: auto;
      font-size: 1.2rem;
      color: #ffffff;
    }
    .main-content {
      flex: 1;
      padding: 20px;
    }
  </style>
  @stack('styles')
</head>
<body>
  <div class="view-order-status-customer">
    <div class="sidebar">
      <img src="{{ asset('img/1ds-removebg-preview.png') }}" alt="Image">
      <nav class="nav flex-column">
        <a class="nav-link" href="{{ route('transactions.index') }}">Order/ Transaction</a>
        <a class="nav-link" href="{{ route('orders.index') }}">View Laundry</a>
        <a class="nav-link" href="{{ route('employee.supplier.index') }}">Supplier</a>
        <a class="nav-link" href="{{ route('employee.items.index') }}">Items</a>
        <a class="nav-link" href="{{ route('employee.stock-in.form') }}">Stock In</a>
        <a class="nav-link" href="{{ route('employee.purchase-orders.create') }}">Purhcase Order</a>
      </nav>
      <div class="log-out">Log Out</div>
    </div>
    <div class="main-content">
      @yield('content')
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  @stack('scripts')
</body>
</html>
