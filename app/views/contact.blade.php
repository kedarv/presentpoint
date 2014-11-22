@extends('layout')

@section('content')
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<div class="well">
<h1 class="text-left">Contact Us</h1>
<hr/>
<div id="alert" class="alert" style="display:none;"></div>
{{Form::open(array('id' => 'contact_form'))}}
<div class="row">
	<div class="col-xs-6">
		<div class="form-group">
			{{Form::label('firstname', 'First Name')}}
			{{Form::text('firstname', null, array('class' => 'form-control', 'placeholder' => 'First Name'))}}
		</div>
	</div>
	<div class="col-xs-6">
		<div class="form-group">
			{{Form::label('lastname', 'Last Name')}}
			{{Form::text('lastname', null, array('class' => 'form-control', 'placeholder' => 'Last Name'))}}
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			{{Form::label('email', 'Email Address')}}&nbsp;&nbsp;<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="We'll use this address to get back to you"></i>
			{{Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email Address'))}}
		</div>
	</div>
	<div class="col-xs-12">
		{{Form::label('message', 'Message')}}
		{{Form::textarea('message', null, array('class' => 'form-control', 'placeholder' => 'Message'))}}
	</div>
	<div class="col-xs-12">
		<hr/>
		<div class="form-group">
			{{Form::label('priority', 'Priority')}}
			{{Form::select('priority', array('Low' => 'Low', 'Medium' => 'Medium', 'High' => 'High'), null, array('class' => 'form-control'))}}
		</div>
	</div>
</div>
<hr/>
{{ Form::submit('Send Message', array('class' => 'btn btn-default')) }}
{{ Form::close() }}
</div>
<script>
$("#contact_form").submit(function() {
	$("#alert").removeClass("alert-danger").empty();
	form_data = {
		email: $('#email').val(),
        firstname: $('#firstname').val(),
		lastname: $('#lastname').val(),
		message: $('#message').val(),
		priority: $('#priority').val(),
	};
	$.ajax({
		type: 'POST',
        url: '{{action('PageController@contactProcess')}}',
		dataType: 'json',
		data: form_data,
		success: function (data) {
			if(data['status'] != "success") {
				$.each(data, function(i, item) {
					$.each(data[i], function(j, message) {
						console.log(j + " " + message);
						if(j != "status") {
							jQuery("#" + j).parent('div').addClass('has-error');
							$("#alert").fadeIn("slow").addClass("alert-danger").append(message + "<br/>");
						}
					})
				})
			}
			else if(data['status'] == "success") {
				$(".form-group").removeClass("has-error");
				$("#alert").fadeIn("slow").removeClass("alert-danger").addClass("alert-success").append("Message successfully sent. We'll get back to you soon!");
				$("#contact_form").slideUp("normal", function() { $(this).remove(); } );
			}
		}
	}, 'json');
	return false;
});
</script>
@stop