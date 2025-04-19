@extends('layouts.employee-layout')

@section('title', 'View Your Order')

@section('content')
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
@endsection

@push('styles')
<style>
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
@endpush
