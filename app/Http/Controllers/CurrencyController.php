<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convertation;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class CurrencyController extends Controller
{
    protected $access_key = 'apiKey=2116d202f25fa2a79bf7';
    protected $url = 'http://free.currconv.com/api/v7/';

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function requestSetup($endpoint, array $params = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        

        if(is_null($params))
        {
            $this->url = $this->url.$endpoint.''.$this->access_key.'';
            curl_setopt($ch, CURLOPT_URL, $this->url);
        } else {
        $from = $params['from'];
        $to = $params['to'];
        $query = $from.'_'.$to;
        $this->url = $this->url.$endpoint.'?q='.$query.'&compact=ultra&'.$this->access_key;
        curl_setopt($ch, CURLOPT_URL, $this->url);
        }
        $data = curl_exec($ch);

        $result = json_decode($data, true);
        curl_close($ch);

        return $result;
    }

    public function getCurrencies(Request $request)
    {
        
        // set API Endpoint, access key, required parameter
        // Decode JSON response:

        $data = $request->all();
        $res = $this->requestSetup('convert', $data);
        $coeff = array_values($res)[0];
        $value = $coeff * $data['amount'];

        $convertation = new Convertation;
        $convertation->amount = $value;
        $convertation->amount_from = $data['amount'];
        $convertation->from_to = array_keys($res)[0];
        $convertation->user_id = Auth::user()->id;
        $convertation->save();
        // return view('home', compact('value'));
        return redirect()->route('home', ['value' => $value]);
    }

    public function getSymbols()
    {
        $res = $this->requestSetup('currencies?');
        return $res;
    }

    public function makeTransaction(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'card_number' => 'required|max:16',
        ]);
        $transaction = new Transaction;
        $data = $request->all();

        $transaction->user_id = Auth::user()->id;
        $transaction->amount = $data['amount'];
        $transaction->card_number = $data['card_number'];

        $transaction->save();

        return redirect()->route('home');
    }
}
