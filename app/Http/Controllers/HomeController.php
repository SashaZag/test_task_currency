<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CurrencyController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($converted = null)
    {
        $currencyController = new CurrencyController;
        $currencySymbols = $currencyController->getSymbols();

        return view('home', compact('currencySymbols'));
    }
}