<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Convertation;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function index()
    {

        $transactions = Transaction::all();
        $convertations = Convertation::all();

        return view('admin.main', compact('transactions', 'convertations'));

    }
}
