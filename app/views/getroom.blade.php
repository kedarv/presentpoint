@extends('layout')
@section('content')
<div class="well">
@if($data['name'] == "Error")
	<div class="alert alert-danger">Whoops! You don't have sufficient privilages to view this page.</div>
@else
	@foreach($records as $u)
		<h1 class="text-left">Viewing Room <b>{{{$u['name']}}}</b></h1>
	@endforeach
@endif
</div>
@stop