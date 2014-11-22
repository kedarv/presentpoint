@extends('layout')
@section('content')
<div class="well">
<h1 class="text-left">Create a Presentation Room</h1>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<div id="alert" class="alert" style="display:none;"></div>
{{Form::open(array('id' => 'presentation_create'))}}
<div class="row">
	<div class="col-xs-6">
		<div class="form-group">
			{{Form::label('name', 'Presentation Room Name')}}
			{{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'First Name'))}}
		</div>
	</div>
	<div class="col-xs-6">
		<div class="form-group">
			{{Form::label('indet', 'Simple Word Identifier')}}&nbsp;&nbsp;<i class="fa fa-info-circle lowercase" data-toggle="tooltip" data-placement="top" title="This will prepend the question number. Make it simple!"></i>
			{{Form::text('indet', null, array('class' => 'form-control', 'placeholder' => 'Last Name'))}}
		</div>
	</div>
</div>

</div>
@stop