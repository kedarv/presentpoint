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
{{Form::open(array('id' => 'presentation_create_form'))}}
<div class="row">
	<div class="col-xs-6">
		<div class="form-group">
			{{Form::label('name', 'Presentation Room Name')}}
			{{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Presentation Room Name'))}}
		</div>
	</div>
	<div class="col-xs-6">
		<div class="form-group">
			{{Form::label('identifier', 'Simple Word Identifier')}}&nbsp;&nbsp;<i class="fa fa-info-circle lowercase" data-toggle="tooltip" data-placement="top" title="This will prepend the question number. Make it simple!"></i>
			{{Form::text('identifier', null, array('class' => 'form-control', 'placeholder' => 'Simple Word Identifier'))}}
		</div>
	</div>
	<div class="col-md-12">
<table class="table">
      <thead>
        <tr>
          <th style="width: 10px;">#</th>
          <th>Reference</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>{{Form::text('hooks[]', null, array('class' => 'form-control', 'placeholder' => 'Reference to my presentation'))}}</td>
        </tr>
        <tr>
          <td>2</td>
          <td>{{Form::text('hooks[]', null, array('class' => 'form-control', 'placeholder' => 'Reference to my presentation'))}}</td>
        </tr>
        <tr>
          <td>3</td>
          <td>{{Form::text('hooks[]', null, array('class' => 'form-control', 'placeholder' => 'Reference to my presentation'))}}</td>
        </tr>
      </tbody>
    </table>
	</div>
</div>
{{ Form::submit('Create Room', array('class' => 'btn btn-default')) }}
</div>
{{Form::close()}}
<script>
$("#presentation_create_form").submit(function() {
	$("#alert").removeClass("alert-danger").empty();
	var hookVal = "";
	var i = 0;
	$('input[name="hooks[]"]').each(function() {
		if(i != 0) {
			hookVal = hookVal + "-" + $(this).val();
		}
		else {
			hookVal = $(this).val();
		}
		i++;
	});

	form_data = {
		name: $('#name').val(),
        identifier: $('#identifier').val(),
		hooks: hookVal,
	};
	$.ajax({
		type: 'POST',
        url: '{{action('PageController@createRoomProcess')}}',
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
				$("#alert").fadeIn("slow").removeClass("alert-danger").addClass("alert-success").append("Room created. Redirecting...");
				$("#presentation_create_form").slideUp("normal", function() { $(this).remove(); } );
			}
		}
	}, 'json');
	return false;
});
</script>
@stop