@extends('layouts.employee-layout')

@section('content')
<div class="container">
    <h2>Stock In from Purchase Order</h2>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($purchaseOrders->isNotEmpty())
    <form method="GET" action="{{ route('employee.stock-in.form') }}">
        <div class="form-group">
            <label for="purchase_order_id">Select Purchase Order</label>
            <select name="purchase_order_id" onchange="this.form.submit()" class="form-control">
                <option value="">-- Select --</option>
                @foreach($purchaseOrders as $po)
                    <option value="{{ $po->id }}" {{ request('purchase_order_id') == $po->id ? 'selected' : '' }}>
                        Order #{{ $po->order_number }} ({{ $po->supplier->name }})
                    </option>
                @endforeach
            </select>
        </div>
    </form>
@endif

@if($selectedOrder)
    {{-- Display items from selected purchase order --}}
    <form action="{{ route('employee.stock-in.from-po.submit', $selectedOrder->id) }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Ordered Qty</th>
                    <th>Already Stocked</th>
                    <th>Remaining</th>
                    <th>Stock In Now</th>
                </tr>
            </thead>
            <tbody>
                @foreach($selectedOrder->items as $poItem)
                    @php
                        $remaining = $poItem->quantity - $poItem->stocked_in_quantity;
                    @endphp
                    @if($remaining > 0)
                    <tr>
                        <td>{{ $poItem->inventoryItem->name }}</td>
                        <td>{{ $poItem->quantity }}</td>
                        <td>{{ $poItem->stocked_in_quantity }}</td>
                        <td>{{ $remaining }}</td>
                        <td>
                            <input type="number" name="items[{{ $poItem->id }}][quantity]" class="form-control" max="{{ $remaining }}" min="1" required>
                            <input type="hidden" name="items[{{ $poItem->id }}][id]" value="{{ $poItem->id }}">
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Stock In Selected Items</button>
    </form>
@endif
@endsection
