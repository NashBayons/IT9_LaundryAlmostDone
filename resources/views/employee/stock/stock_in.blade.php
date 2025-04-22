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

    {{-- Select Purchase Order --}}
    <form method="GET" action="{{ route('employee.stock-in.form') }}" class="mb-4">
        <div class="form-group">
            <label for="purchase_order_id">Select Purchase Order</label>
            <select name="purchase_order_id" id="purchase_order_id" class="form-control" required onchange="this.form.submit()">
                <option value="">-- Choose Purchase Order --</option>
                @foreach($purchaseOrders as $order)
                    <option value="{{ $order->id }}" {{ request('purchase_order_id') == $order->id ? 'selected' : '' }}>
                        Order #{{ $order->order_number }} | {{ $order->supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if($purchaseOrders->isNotEmpty())
        <form method="POST" action="{{ route('employee.stock-in.from-po.submit', $purchaseOrder->id) }}">
            @csrf

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Ordered Quantity</th>
                        <th>Already Stocked In</th>
                        <th>Stock In Now</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchaseOrder->items as $poItem)
                        @php
                            $remaining = $poItem->quantity - $poItem->stocked_in_quantity;
                        @endphp
                        <tr>
                            <td>{{ $poItem->inventoryItem->name }}</td>
                            <td>{{ $poItem->quantity }}</td>
                            <td>{{ $poItem->stocked_in_quantity }}</td>
                            <td>
                                <input type="hidden" name="items[{{ $loop->index }}][id]" value="{{ $poItem->id }}">
                                <input type="number" name="items[{{ $loop->index }}][quantity]" class="form-control" min="0" max="{{ $remaining }}" value="0">
                            </td>
                            <td>{{ number_format($poItem->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Stock In Items</button>
        </form>
    @endif
</div>
@endsection
