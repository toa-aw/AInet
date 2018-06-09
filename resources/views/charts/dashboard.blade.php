@extends('layouts.master');

@section('title', 'Dashboard');

@section('content')

<div id="stocks-div"></div>

{{ $lava->render('LineChart', 'Stocks', 'stocks-div') }}

@endsection