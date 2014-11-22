@extends('layout')
@section('content')
<div class="well">
<h1 class="text-left">Viewing Room</h1>
@if($data['name'] == "Error")
	<div class="alert alert-danger">Whoops! You don't have sufficient privilages to view this page.</div>
@else
	Details here
@endif
</div>
@stop