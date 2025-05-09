<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Default to last 30 days if no date range is specified
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(30);

        // Apply filters if they exist in the request
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
        }

        // Get filtered orders
        $orders = Order::whereBetween('date', [$startDate, $endDate])->get();

        // Calculate totals
        $totals = $this->calculateTotals($orders);

        // Prepare chart data
        $chartData = [
            'pieChart' => $this->getPieChartData($orders),
            'lineChart' => $this->getLineChartData($startDate, $endDate)
        ];

        return view('admin.dashboard', compact('orders', 'totals', 'chartData', 'startDate', 'endDate'));
    }

    protected function calculateTotals($orders)
    {
        return [
            'Wash' => $orders->where('service_type', 'Wash')->sum('amount'),
            'Fold' => $orders->where('service_type', 'Fold')->sum('amount'),
            'Ironing' => $orders->where('service_type', 'Ironing')->sum('amount'),
            'All' => $orders->sum('amount'),
        ];
    }

    protected function getPieChartData($orders)
    {
        return [
            'labels' => ['Wash', 'Fold', 'Ironing'],
            'data' => [
                $orders->where('service_type', 'Wash')->sum('amount'),
                $orders->where('service_type', 'Fold')->sum('amount'),
                $orders->where('service_type', 'Ironing')->sum('amount')
            ],
            'colors' => [
                'rgba(23, 232, 255, 0.7)',
                'rgba(7, 156, 214, 0.7)',
                'rgba(36, 89, 188, 0.7)'
            ]
        ];
    }

    protected function getLineChartData($startDate, $endDate)
    {
        $daysDifference = $startDate->diffInDays($endDate);
        
        // Determine the best grouping based on date range
        if ($daysDifference <= 7) {
            // Daily data for 1 week
            return $this->getDailySalesData($startDate, $endDate);
        } elseif ($daysDifference <= 30) {
            // Weekly data for 1 month
            return $this->getWeeklySalesData($startDate, $endDate);
        } else {
            // Monthly data for longer periods
            return $this->getMonthlySalesData($startDate, $endDate);
        }
    }

    protected function getDailySalesData($startDate, $endDate)
    {
        $labels = [];
        $data = [];
        
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $labels[] = $currentDate->format('M j');
            $data[] = Order::whereDate('date', $currentDate)->sum('amount');
            $currentDate->addDay();
        }
        
        return [
            'labels' => $labels,
            'data' => $data,
            'color' => 'rgba(23, 232, 255, 1)'
        ];
    }

    protected function getWeeklySalesData($startDate, $endDate)
    {
        // Similar implementation for weekly data
        // ...
    }

    protected function getMonthlySalesData($startDate, $endDate)
    {
        // Similar implementation for monthly data
        // ...
    }
}