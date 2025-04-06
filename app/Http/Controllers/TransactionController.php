<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        return view('transactions.index'); // Reference the correct view
    }

    public function create(): View
    {
        return view('transactions.create'); // Reference the create view
    }
}