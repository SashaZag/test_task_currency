@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}

<form method="GET" action="{{route('currency.submit')}}">
  <div class="form-group">
    <label for="exampleInputEmail1">From currency</label>
    <select name="from">
        @foreach($currencySymbols['results'] as $symbol => $decodedName):
        <option value="{{$decodedName['id']}}">{{$decodedName['currencyName']}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">To currency</label>
    <select name="to">
        @foreach($currencySymbols['results'] as $symbol => $decodedName):
        <option value="{{$decodedName['id']}}">{{$decodedName['currencyName']}}</option>
        @endforeach
    </select>

    <input type="text" name="amount" id="" value="" >Amount
  </div>
  <button type="submit" class="btn btn-primary">Convert</button>
</form>
@isset($_GET['value'])
<div class="form-group">
<form method="POST" action="{{route('make.transaction')}}"> 
    @csrf
    <input type="text" name="amount" id="" value="{{$_GET['value']}}" >Amount
    <input type="test" name="card_number">Card number
    <button type="submit" class="btn btn-primary">Make transaction</button>
</form>
</div>
@endisset

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
