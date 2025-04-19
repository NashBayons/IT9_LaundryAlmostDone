<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Order and Transaction</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }
    .order-transaction {
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
      height: 100vh;
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
      font-style: italic;
      text-align: center;
    }
    .sidebar .log-out {
      margin-top: auto;
      font-size: 1.2rem;
      color: #000000;
      font-style: italic;
      cursor: pointer;
    }
    .main-content {
      flex: 1;
      padding: 20px;
      overflow-y: auto;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .order-and-transaction {
      font-size: 32px;
      font-weight: 700;
      color: #000000;
      margin-bottom: 30px;
      font-style: italic;
    }
    .service-type, .payment-method {
      font-size: 20px;
      font-weight: 600;
      color: #000000;
      margin-top: 20px;
      font-style: italic;
    }
    .form-control {
      border-radius: 8px;
      border: 1px solid #d9d9d9;
      padding: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
      background-color: rgba(255, 255, 255, 0.8);
    }
    .form-control1 {
      border-radius: 8px;
      border: 1px solid #d9d9d9;
      padding: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
      background-color: rgba(255, 255, 255, 0.8);
      width: 150px;
      display: inline-block;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }
    .input-group-text {
      background-color: #d9d9d9;
      border: 1px solid #d9d9d9;
      border-radius: 8px;
      font-size: 14px;
      color: #000000;
    }
    .btn-dark {
      background-color: #2c2c2c;
      border: none;
      border-radius: 8px;
      padding: 12px;
      font-size: 16px;
      font-style: italic;
      transition: background-color 0.3s ease;
    }
    .btn-dark:hover {
      background-color: #4c4c4c;
    }
    .service-checkboxes {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 10px;
    }
    .service-checkbox {
      display: flex;
      align-items: center;
    }
    .service-checkbox input {
      margin-right: 5px;
    }
    .special-instructions {
      margin-top: 20px;
    }
    .special-instructions textarea {
      width: 100%;
      min-height: 100px;
      resize: vertical;
    }
  </style>
</head>
<body>
  <div class="order-transaction">
    <div class="sidebar">
      <img src="{{ asset('img/1ds-removebg-preview.png') }}" alt="Image">
      <nav class="nav flex-column">
        <a class="nav-link" href="{{ route('transactions.index') }}">Order/ Transaction</a>
        <a class="nav-link" href="{{ route('orders.index') }}">View Laundry</a>
        <a class="nav-link" href="{{ route('orders.index') }}">Suppliers</a>
        <a class="nav-link" href="{{ route('orders.index') }}">Items</a>
      </nav>
      <div class="log-out" onclick="logout()">Log Out</div>
    </div>
    <div class="main-content">
      <div class="order-and-transaction">Order and Transaction:</div>
      <form action="{{ route('orders.store') }}" method="POST">
        @csrf 
        <div class="form-group">
          <label for="orderName">Name of the order</label>
          <input type="text" class="form-control" id="orderName" name="order_name" placeholder="Enter order name" required>
        </div>
        <div class="form-group">
          <label for="weight">Weight</label>
          <div class="input-group">
            <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter weight" required step="0.01" min="0.1" value="1">
            <div class="input-group-append">
              <span class="input-group-text">kg</span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" class="form-control" id="date" name="date" required>
        </div>
        
        <div class="service-type">Service Type:</div>
        <div class="service-checkboxes">
          <div class="service-checkbox">
            <input type="checkbox" id="wash" name="service_type[]" value="Wash" checked>
            <label for="wash">Wash ($5/kg)</label>
          </div>
          <div class="service-checkbox">
            <input type="checkbox" id="fold" name="service_type[]" value="Fold">
            <label for="fold">Fold ($2/kg)</label>
          </div>
          <div class="service-checkbox">
            <input type="checkbox" id="ironing" name="service_type[]" value="Ironing">
            <label for="ironing">Ironing ($3/kg)</label>
          </div>
        </div>
        
        <div class="payment-method">Payment Method:</div>
        <div class="form-group">
          <select class="form-control1" id="paymentMethod" name="payment_method" required>
            <option value="Card">Card</option>
            <option value="Cash">Cash</option>
            <option value="Mobile">Mobile</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="amount">Amount:</label>
          <input type="number" class="form-control" id="amount" name="amount" required step="0.01" readonly>
        </div>
        
        <div class="form-group special-instructions">
          <label for="specialInstructions">Special Instructions:</label>
          <textarea class="form-control" id="specialInstructions" name="special_instructions" placeholder="Any special instructions for your order..."></textarea>
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-dark">Submit Order</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Order Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Order Details:</h5>
          <p><strong>Name of the Order:</strong> <span id="orderNameDisplay"></span></p>
          <p><strong>Weight:</strong> <span id="weightDisplay"></span> kg</p>
          <p><strong>Date:</strong> <span id="dateDisplay"></span></p>
          <p><strong>Service Type:</strong> <span id="serviceTypeDisplay"></span></p>
          <p><strong>Payment Method:</strong> <span id="paymentMethodDisplay"></span></p>
          <p><strong>Special Instructions:</strong> <span id="specialInstructionsDisplay"></span></p>
          <p><strong>Amount:</strong> $<span id="amountDisplay"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="confirmOrder()">Confirm Order</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // Service prices
    const servicePrices = {
      'Wash': 5,
      'Fold': 2,
      'Ironing': 3
    };

    // Set default date to today
    document.addEventListener('DOMContentLoaded', function() {
      const today = new Date();
      const formattedDate = today.toISOString().substr(0, 10);
      document.getElementById('date').value = formattedDate;
      
      // Calculate initial amount
      calculateAmount();
    });

    // Calculate amount based on weight and selected services
    function calculateAmount() {
      const weight = parseFloat(document.getElementById('weight').value) || 0;
      let totalAmount = 0;
      
      // Get all checked services
      const checkboxes = document.querySelectorAll('input[name="service_type[]"]:checked');
      
      checkboxes.forEach(checkbox => {
        const service = checkbox.value;
        totalAmount += weight * servicePrices[service];
      });
      
      document.getElementById('amount').value = totalAmount.toFixed(2);
    }

    // Listen for weight and service changes
    document.getElementById('weight').addEventListener('input', calculateAmount);
    document.querySelectorAll('input[name="service_type[]"]').forEach(checkbox => {
      checkbox.addEventListener('change', calculateAmount);
    });

    // Confirmation modal handling
    document.querySelector('form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const orderName = document.getElementById('orderName').value;
      const weight = document.getElementById('weight').value;
      const date = document.getElementById('date').value;
      const paymentMethod = document.getElementById('paymentMethod').value;
      const amount = document.getElementById('amount').value;
      const specialInstructions = document.getElementById('specialInstructions').value;
      
      // Get selected services
      const checkboxes = document.querySelectorAll('input[name="service_type[]"]:checked');
      const selectedServices = Array.from(checkboxes).map(cb => cb.nextElementSibling.textContent.split(' (')[0]).join(', ');

      // Display values in the modal
      document.getElementById('orderNameDisplay').innerText = orderName;
      document.getElementById('weightDisplay').innerText = weight;
      document.getElementById('dateDisplay').innerText = date;
      document.getElementById('serviceTypeDisplay').innerText = selectedServices;
      document.getElementById('paymentMethodDisplay').innerText = paymentMethod;
      document.getElementById('amountDisplay').innerText = amount;
      document.getElementById('specialInstructionsDisplay').innerText = specialInstructions || 'None';
      
      $('#confirmationModal').modal('show');
    });

    // Function to handle order confirmation
    function confirmOrder() {
      // Submit the form after confirmation
      document.querySelector('form').submit();
    }

    // Logout function
    function logout() {
      // Add your logout logic here
      alert('Logging out...');
      // window.location.href = '/logout'; // Uncomment this if you have a logout route
    }
  </script>
</body>
</html>