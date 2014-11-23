@extends('layout')
@section('content')

<style>
.circle{width:100px;height:100px;border-radius:50px;font-size:15px;color:#fff;line-height:100px;text-align:center;background:#000;margin: 0 auto;}
</style>
<div class="well">
@if($data['name'] == "Error")
	<div class="alert alert-danger">Whoops! You don't have sufficient privilages to view this page.</div>
@else
	@foreach($records as $u)
	<?php
		$pieces = explode("-", $u['hooks']);
	?>
		<h1 class="text-left">Viewing Room <b>{{{$u['name']}}}</b></h1>
	</div>
	<hr/>
	<div class="col-md-4">
		<div class="circle" id="one">{{{$pieces[1]}}}</div>
	</div>
	<div class="col-md-4">
		<div class="circle" id="two">{{{$pieces[2]}}}</div>
	</div>
	<div class="col-md-4">
		<div class="circle" id="three">{{{$pieces[3]}}}</div>
	</div>
	@endforeach

	<script>
		$(document).ready(function() {
			@foreach($circles as $c)
				var ONEvotes = {{{$c['ONEvotes']}}};
				var TWOvotes = {{{$c['TWOvotes']}}};
				var THREEvotes = {{{$c['THREEvotes']}}};
				var ONEcolor = "{{{$c['ONEcolor']}}}";
				var TWOcolor = "{{{$c['TWOcolor']}}}";
				var THREEcolor = "{{{$c['THREEcolor']}}}";
			@endforeach
			$('#one').css('width', ONEvotes*20+20).css('height', ONEvotes*20+20);
			$('#two').css('width', TWOvotes*20+20).css('height', TWOvotes*20+20);
			$('#three').css('width', THREEvotes*20+20).css('height', THREEvotes*20+20);
		});
	</script>
@endif
@stop