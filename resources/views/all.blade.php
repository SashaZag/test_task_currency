@extends('layouts.app')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Transactions/Convertations</th>
    </tr>
  </thead>
  <tbody>
  @foreach($transactions as $transaction)
    <tr>
      <td>User Id:{{$transaction->user_id}} Amount:{{$transaction->amount}} Card number:{{$transaction->card_number}} Date:{{$transaction->created_at}}</td>
    </tr>
 @endforeach
 @foreach($convertations as $convertation)
    <tr>
      <td>User Id:{{$convertation->user_id}} Amount From:{{$convertation->amount_from}} Amount:{{$convertation->amount}} From-To:{{$convertation->from_to}} Date:{{$convertation->created_at}}</td>
    </tr>
 @endforeach
  </tbody>
</table>
@endsection