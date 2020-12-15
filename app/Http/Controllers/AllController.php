<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Convertation;

class AllController extends Controller
{
    public function allRecords()
    {

        $transactions = Transaction::all();
        $convertations = Convertation::all();
        
        return view('all', compact('transactions', 'convertations'));
    }
}
