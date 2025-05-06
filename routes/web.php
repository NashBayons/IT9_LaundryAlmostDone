<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Inventory\StockController;
use App\Http\Controllers\Employee\Supplier_Controller;
use App\Http\Controllers\Inventory\ReceiveOrderController;
use App\Http\Controllers\Employee\Items_Controller;  // Added this line

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::resource('orders', OrderController::class);

    // Transaction 
    Route::resource('transactions', TransactionController::class);

});

Route::middleware(['auth', 'admin'])->prefix('admin')->group( function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('employees', EmployeeController::class)
        ->names([
            'index' => 'admin.employee.index',
            'create' => 'admin.employee.create',
            'store' => 'admin.employee.store',
            'show' => 'admin.employee.show',
            'edit' => 'admin.employee.edit',
            'update' => 'admin.employee.update',
            'destroy' => 'admin.employee.destroy',
        ]);

    Route::resource('suppliers', SupplierController::class)
    ->names([
        'index' => 'admin.suppliers.index',
        'create' => 'admin.suppliers.create',
        'store' => 'admin.suppliers.store',
        'show' => 'admin.suppliers.show',
        'edit' => 'admin.suppliers.edit',
        'update' => 'admin.suppliers.update',
       'destroy' => 'admin.suppliers.destroy',
    ]);    
        
    // Fixed inventory route - added proper controller reference and names
    Route::resource('inventory', InventoryController::class)
        ->names([
            'index' => 'admin.inventory.index',
            'create' => 'admin.inventory.create',
            'store' => 'admin.inventory.store',
            'show' => 'admin.inventory.show',
            'edit' => 'admin.inventory.edit',
            'update' => 'admin.inventory.update',
            'destroy' => 'admin.inventory.destroy',
        ]);    
    
});

Route::middleware(['auth'])->prefix('employee')->name('employee.')->group(function () {
    Route::resource('supplier', Supplier_Controller::class)->names([
        'index' => 'supplier.index',
        'create' => 'supplier.create',
        'store' => 'supplier.store',
        'show' => 'supplier.show',
        'edit' => 'supplier.edit',
        'update' => 'supplier.update',
        'destroy' => 'supplier.destroy',
    ]);
    
    Route::resource('inventoryitem', Items_Controller::class)->names([
        'index' => 'items.index',
        'create' => 'items.create',
        'store' => 'items.store',
        'show' => 'items.show',
        'edit' => 'items.edit',
        'update' => 'items.update',
        'destroy' => 'items.destroy',
    ]);

    Route::get('/stock/in', [StockController::class, 'stockInForm'])->name('stock-in.form');
    Route::post('/stock/in', [StockController::class, 'stockIn'])->name('stock-in');
    Route::get('/stock-in', [StockController::class, 'index'])->name('stock_in_index');
    Route::get('/stock-in/purchase-order/{id}', [StockController::class, 'stockInFromReceiveOrderForm'])->name('stock-in.from-ro');
    Route::post('/stock-in/purchase-order/{id}', [StockController::class, 'stockInFromReceiveOrderSubmit'])->name('stock-in.from-ro.submit');


    Route::resource('receive-orders', ReceiveOrderController::class)->names([
        'index' => 'receive-orders.index',
        'create' => 'receive-orders.create',
        'store' => 'receive-orders.store',
        'show' => 'receive-orders.show',
        'edit' => 'receive-orders.edit',
        'update' => 'receive-orders.update',
        'destroy' => 'receive-orders.destroy',
    ]);

    Route::get('/stock-out/create', [StockController::class, 'stockOutForm'])->name('stock-out.form');
    Route::post('/stock-out', [StockController::class, 'stockOutSubmit'])->name('stock-out');
    Route::get('/stock-out', [StockController::class, 'stockOutIndex'])->name('stock_out_index');
});

Route::get('/track-order', [App\Http\Controllers\OrderTrackingController::class, 'trackOrder'])
->name('track.order');

require __DIR__.'/auth.php';