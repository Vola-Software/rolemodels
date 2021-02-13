@extends('layouts.app')

@section('content')
    <div class="container">
    	<h1 class="col-12 text-center py-8">{{ $pageContent['title'] }}</h1>
    	<div class="col-12 py-2">
    		{!! $pageContent['content'] !!}
    	</div>
    </div>
@endsection
