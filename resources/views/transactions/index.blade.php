<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Order and Transaction</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    :root {
      --primary-color: #079CD6;
      --secondary-color: #2F356D;
      --accent-color: #17E8FF;
      --light-bg: rgba(255, 255, 255, 0.9);
    }
    
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
      overflow: hidden;
      display: flex;
    }
    
    .sidebar {
      background: rgba(217, 217, 217, 0.7);
      width: 250px;
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 100vh;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .sidebar img {
      width: 100%;
      max-width: 150px;
      margin-bottom: 30px;
    }
    
    .sidebar .nav-link {
      color: var(--secondary-color);
      font-size: 1.1rem;
      margin: 12px 0;
      font-weight: 500;
      text-align: center;
      padding: 8px 15px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    
    .sidebar .nav-link:hover {
      background: rgba(7, 156, 214, 0.2);
      color: var(--primary-color);
    }
    
    .sidebar .nav-link.active {
      background: var(--primary-color);
      color: white;
    }
    
    .sidebar .log-out {
      margin-top: auto;
      font-size: 1.1rem;
      color: var(--secondary-color);
      font-weight: 500;
      cursor: pointer;
      padding: 8px 15px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    
    .sidebar .log-out:hover {
      background: rgba(255,0,0,0.1);
      color: #d9534f;
    }
    
    .main-content {
      flex: 1;
      padding: 30px;
      overflow-y: auto;
      background: var(--light-bg);
      border-radius: 15px 0 0 15px;
      box-shadow: -2px 0 10px rgba(0,0,0,0.1);
    }
    
    .order-and-transaction {
      font-size: 28px;
      font-weight: 700;
      color: var(--secondary-color);
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .order-and-transaction::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 4px;
      background: var(--primary-color);
      border-radius: 2px;
    }
    
    .form-container {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      margin-bottom: 30px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      font-weight: 600;
      color: var(--secondary-color);
      margin-bottom: 8px;
      display: block;
    }
    
    .form-control {
      border-radius: 8px;
      border: 1px solid #d9d9d9;
      padding: 10px 15px;
      font-size: 15px;
      transition: all 0.3s ease;
      background-color: white;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(7, 156, 214, 0.25);
    }
    
    .input-group-text {
      background-color: #f8f9fa;
      border: 1px solid #d9d9d9;
      border-radius: 8px;
      font-size: 15px;
      color: var(--secondary-color);
    }
    
    .btn-submit {
      background-color: var(--primary-color);
      border: none;
      border-radius: 8px;
      padding: 12px 25px;
      font-size: 16px;
      font-weight: 600;
      color: white;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .btn-submit:hover {
      background-color: #057baa;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Service Type Card */
    .service-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      margin-top: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      border: 1px solid #e9ecef;
    }
    
    .service-card-title {
      font-size: 18px;
      font-weight: 600;
      color: var(--secondary-color);
      margin-bottom: 15px;
      display: flex;
      align-items: center;
    }
    
    .service-card-title i {
      margin-right: 10px;
      color: var(--primary-color);
    }
    
    .service-options {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 15px;
    }
    
    .service-option {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 15px;
      border-radius: 8px;
      background: #f8f9fa;
      transition: all 0.3s ease;
      cursor: pointer;
      border: 2px solid transparent;
    }
    
    .service-option:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-color: var(--primary-color);
    }
    
    .service-option.selected {
      background: rgba(7, 156, 214, 0.1);
      border-color: var(--primary-color);
    }
    
    .service-icon {
      font-size: 24px;
      margin-bottom: 10px;
      color: var(--primary-color);
    }
    
    .service-name {
      font-weight: 600;
      margin-bottom: 5px;
      color: var(--secondary-color);
    }
    
    .service-price {
      font-size: 14px;
      color: #6c757d;
    }
    
    .payment-method-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      margin-top: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      border: 1px solid #e9ecef;
    }
    
    .payment-options {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }
    
    .payment-option {
      flex: 1;
      min-width: 120px;
      padding: 12px;
      border-radius: 8px;
      background: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 2px solid transparent;
    }
    
    .payment-option.selected {
      background: rgba(7, 156, 214, 0.1);
      border-color: var(--primary-color);
    }
    
    .payment-option i {
      font-size: 20px;
    }
    
    .payment-option .fa-credit-card { color: #28a745; }
    .payment-option .fa-money-bill-wave { color: #17a2b8; }
    .payment-option .fa-mobile-alt { color: #6f42c1; }
    
    /* Special Instructions */
    .special-instructions {
      margin-top: 20px;
    }
    
    .special-instructions textarea {
      width: 100%;
      min-height: 100px;
      resize: vertical;
      border-radius: 8px;
      padding: 15px;
      border: 1px solid #d9d9d9;
      transition: all 0.3s ease;
    }
    
    .special-instructions textarea:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(7, 156, 214, 0.25);
    }
    
    /* Amount Display */
    .amount-display {
      background: white;
      border-radius: 12px;
      padding: 20px;
      margin-top: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      border: 1px solid #e9ecef;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .amount-label {
      font-weight: 600;
      color: var(--secondary-color);
      font-size: 18px;
    }
    
    .amount-value {
      font-size: 24px;
      font-weight: 700;
      color: var(--primary-color);
    }
    
    /* Modal Styles */
    .modal-header {
      border-bottom: none;
      padding-bottom: 0;
    }
    
    .modal-title {
      color: var(--secondary-color);
      font-weight: 700;
    }
    
    .modal-body {
      padding-top: 0;
    }
    
    .detail-item {
      margin-bottom: 12px;
      display: flex;
    }
    
    .detail-label {
      font-weight: 600;
      color: var(--secondary-color);
      min-width: 150px;
    }
    
    .detail-value {
      color: #495057;
    }
    
    .modal-footer {
      border-top: none;
      padding-top: 0;
    }
    
    @media (max-width: 768px) {
      .order-transaction {
        flex-direction: column;
      }
      
      .sidebar {
        width: 100%;
        height: auto;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        padding: 15px;
      }
      
      .sidebar img {
        margin-bottom: 15px;
        max-width: 120px;
      }
      
      .sidebar .nav-link {
        margin: 5px 10px;
        padding: 6px 12px;
      }
      
      .sidebar .log-out {
        margin-top: 0;
        margin-left: auto;
      }
      
      .main-content {
        border-radius: 0;
      }
      
      .service-options {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <div class="order-transaction">
    <div class="sidebar">
      <img src="{{ asset('img/1ds-removebg-preview.png') }}" alt="Company Logo">
      <nav class="nav flex-column">
        <a class="nav-link active" href="{{ route('transactions.index') }}">Order/Transaction</a>
        <a class="nav-link" href="{{ route('orders.index') }}">View Laundry</a>
      </nav>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="log-out">Loging Out</button>
    </form>
    </div>
    <div class="main-content">
      <div class="order-and-transaction">Order and Transaction</div>
      
      <form action="{{ route('orders.store') }}" method="POST" class="form-container">
        @csrf 
        
        <div class="form-group">
          <label for="orderName">Customer Name</label>
          <input type="text" class="form-control" id="orderName" name="order_name" placeholder="Enter customer name" required>
        </div>
        
        <div class="form-group">
          <label for="weight">Laundry Weight</label>
          <div class="input-group">
            <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter weight" required step="0.01" min="0.1" value="1">
            <div class="input-group-append">
              <span class="input-group-text">kg</span>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="date">Order Date</label>
          <input type="date" class="form-control" id="date" name="date" required>
        </div>
        
        <!-- Service Type Card -->
        <div class="service-card">
          <div class="service-card-title">
            <i class="fas fa-concierge-bell"></i> Service Type
          </div>
          <div class="service-options">
            <div class="service-option" onclick="toggleService(this, 'Wash')">
              <i class="fas fa-tshirt service-icon"></i>
              <div class="service-name">Wash</div>
              <div class="service-price">$5/kg</div>
              <input type="checkbox" id="wash" name="service_type[]" value="Wash" checked hidden>
            </div>
            
            <div class="service-option" onclick="toggleService(this, 'Fold')">
              <i class="fas fa-people-arrows service-icon"></i>
              <div class="service-name">Fold</div>
              <div class="service-price">$2/kg</div>
              <input type="checkbox" id="fold" name="service_type[]" value="Fold" hidden>
            </div>
            
            <div class="service-option" onclick="toggleService(this, 'Ironing')">
              <i class="fas fa-iron service-icon"></i>
              <div class="service-name">Ironing</div>
              <div class="service-price">$3/kg</div>
              <input type="checkbox" id="ironing" name="service_type[]" value="Ironing" hidden>
            </div>
          </div>
        </div>
        
        <!-- Payment Method Card -->
        <div class="payment-method-card">
          <div class="service-card-title">
            <i class="fas fa-credit-card"></i> Payment Method
          </div>
          <div class="payment-options">
            <div class="payment-option selected" onclick="selectPayment(this, 'Card')">
              <i class="fab fa-cc-visa"></i>
              <span>Card</span>
              <input type="radio" name="payment_method" value="Card" checked hidden>
            </div>
            
            <div class="payment-option" onclick="selectPayment(this, 'Cash')">
              <i class="fas fa-money-bill-wave"></i>
              <span>Cash</span>
              <input type="radio" name="payment_method" value="Cash" hidden>
            </div>
            
            <div class="payment-option" onclick="selectPayment(this, 'Mobile')">
              <i class="fas fa-mobile-alt"></i>
              <span>Mobile</span>
              <input type="radio" name="payment_method" value="Mobile" hidden>
            </div>
          </div>
        </div>
        
        <!-- Amount Display -->
        <div class="amount-display">
          <div class="amount-label">Total Amount:</div>
          <div class="amount-value">$<span id="amount">0.00</span></div>
          <input type="hidden" id="amountInput" name="amount">
        </div>
        
        <!-- Special Instructions -->
        <div class="form-group special-instructions">
          <label for="specialInstructions">Special Instructions</label>
          <textarea class="form-control" id="specialInstructions" name="special_instructions" placeholder="Any special instructions for your order..."></textarea>
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-submit">Submit Order</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Order Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="mb-3"><i class="fas fa-info-circle text-primary mr-2"></i>Please review your order details:</h6>
          
          <div class="detail-item">
            <div class="detail-label">Customer Name:</div>
            <div class="detail-value" id="orderNameDisplay"></div>
          </div>
          
          <div class="detail-item">
            <div class="detail-label">Weight:</div>
            <div class="detail-value" id="weightDisplay"> kg</div>
          </div>
          
          <div class="detail-item">
            <div class="detail-label">Order Date:</div>
            <div class="detail-value" id="dateDisplay"></div>
          </div>
          
          <div class="detail-item">
            <div class="detail-label">Services:</div>
            <div class="detail-value" id="serviceTypeDisplay"></div>
          </div>
          
          <div class="detail-item">
            <div class="detail-label">Payment Method:</div>
            <div class="detail-value" id="paymentMethodDisplay"></div>
          </div>
          
          <div class="detail-item">
            <div class="detail-label">Special Instructions:</div>
            <div class="detail-value" id="specialInstructionsDisplay">None</div>
          </div>
          
          <div class="detail-item">
            <div class="detail-label">Total Amount:</div>
            <div class="detail-value font-weight-bold text-primary">$<span id="amountDisplay"></span></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Edit Order</button>
          <button type="button" class="btn btn-primary" onclick="confirmOrder()">
            <i class="fas fa-check mr-2"></i>Confirm Order
          </button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <script>
    const servicePrices = {
      'Wash': 5,
      'Fold': 2,
      'Ironing': 3
    };

    // Initialize date to today
    document.addEventListener('DOMContentLoaded', function() {
      const today = new Date();
      const formattedDate = today.toISOString().substr(0, 10);
      document.getElementById('date').value = formattedDate;
      
      calculateAmount();
    });

    // Calculate total amount based on weight and selected services
    function calculateAmount() {
      const weight = parseFloat(document.getElementById('weight').value) || 0;
      let totalAmount = 0;
      
      document.querySelectorAll('input[name="service_type[]"]:checked').forEach(checkbox => {
        const service = checkbox.value;
        totalAmount += weight * servicePrices[service];
      });
      
      document.getElementById('amount').textContent = totalAmount.toFixed(2);
      document.getElementById('amountInput').value = totalAmount.toFixed(2);
    }

    // Toggle service selection
    function toggleService(element, service) {
      const checkbox = element.querySelector('input[type="checkbox"]');
      checkbox.checked = !checkbox.checked;
      
      if (checkbox.checked) {
        element.classList.add('selected');
      } else {
        element.classList.remove('selected');
      }
      
      calculateAmount();
    }

    // Select payment method
    function selectPayment(element, method) {
      document.querySelectorAll('.payment-option').forEach(opt => {
        opt.classList.remove('selected');
      });
      
      element.classList.add('selected');
      document.querySelector(`input[value="${method}"]`).checked = true;
    }

    // Weight input listener
    document.getElementById('weight').addEventListener('input', calculateAmount);

    // Form submission handler
    document.querySelector('form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Get form values
      const orderName = document.getElementById('orderName').value;
      const weight = document.getElementById('weight').value;
      const date = document.getElementById('date').value;
      const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
      const amount = document.getElementById('amount').textContent;
      const specialInstructions = document.getElementById('specialInstructions').value;
      
      // Get selected services
      const selectedServices = Array.from(document.querySelectorAll('input[name="service_type[]"]:checked'))
        .map(cb => {
          return cb.parentElement.querySelector('.service-name').textContent;
        }).join(', ');

      // Update modal display
      document.getElementById('orderNameDisplay').textContent = orderName;
      document.getElementById('weightDisplay').textContent = weight + ' kg';
      document.getElementById('dateDisplay').textContent = date;
      document.getElementById('serviceTypeDisplay').textContent = selectedServices || 'None';
      document.getElementById('paymentMethodDisplay').textContent = paymentMethod;
      document.getElementById('amountDisplay').textContent = amount;
      document.getElementById('specialInstructionsDisplay').textContent = specialInstructions || 'None';
      
      // Show modal
      $('#confirmationModal').modal('show');
    });

    // Confirm order
    function confirmOrder() {
      document.querySelector('form').submit();
    }

    // Logout function
    function logout() {
      if (confirm('Are you sure you want to log out?')) {
        window.location.href = "{{ route('logout') }}";
      }
    }
  </script>
</body>
</html>