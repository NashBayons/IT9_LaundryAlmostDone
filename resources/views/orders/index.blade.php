<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Your Order</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
          rgba(142, 176, 239, 0.1) 45.691317319869995%,
          rgba(36, 89, 188, 0.2) 96.88477516174316%
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
    .view-your-order {
      color: #000000;
      font-family: "Inter-Italic", sans-serif;
      font-size: 48px;
      font-style: italic;
      margin-bottom: 20px;
    }
    .order-table {
      background: #d9d9d9;
      border-radius: 20px;
      padding: 20px;
      width: 100%;
    }
    .order-table table {
      width: 100%;
      border-collapse: collapse;
    }
    .order-table th,
    .order-table td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #000000;
    }
    .order-table th {
      font-family: "Inter-Italic", sans-serif;
      font-size: 24px;
      font-style: italic;
      color: #000000;
    }
    .order-table td {
      font-family: "Inter-Regular", sans-serif;
      font-size: 18px;
      color: #000000;
    }
    .order-table .view-button {
      background: #2c2c2c;
      color: #f5f5f5;
      border-radius: 8px;
      padding: 8px 16px;
      text-align: center;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="view-order-status-customer">
    <div class="sidebar">
      <img src="{{ asset('img/1ds-removebg-preview.png') }}" alt="Image">
      <nav class="nav flex-column">
        <a class="nav-link" href="{{ route('transactions.index') }}">Order/ Transaction</a>
        <a class="nav-link" href="{{ route('orders.index') }}">View Laundry</a>
      </nav>
      <div class="log-out">Log Out</div>
    </div>
    <div class="main-content">
      <div class="view-your-order">View Your Order:</div>
      <div class="order-table">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>OrderType</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
              <tr>
                <td>{{ $order->date }}</td>
                <td>{{ $order->service_type }}</td>
                <td>{{ $order->status }}</td>
                <td><div class="view-button">View</div></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>