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
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>{{Form::text('hooks[]', null, array('class' => 'form-control', 'placeholder' => 'Reference to my presentation'))}}</td>
          <td>
          <div style="margin-top:10px;">
          	<select name="ONEcolor" id="ONEcolor">
				  <option value="#7bd148">Green</option>
				  <option value="#5484ed">Bold blue</option>
				  <option value="#a4bdfc">Blue</option>
				  <option value="#46d6db">Turquoise</option>
				  <option value="#7ae7bf">Light green</option>
				  <option value="#51b749">Bold green</option>
				  <option value="#fbd75b">Yellow</option>
				  <option value="#ffb878">Orange</option>
				  <option value="#ff887c">Red</option>
				  <option value="#dc2127">Bold red</option>
				  <option value="#dbadff">Purple</option>
				  <option value="#e1e1e1">Gray</option>
			</select>
			</div>
		</td>        
        </tr>
        <tr>
          <td>2</td>
          <td>{{Form::text('hooks[]', null, array('class' => 'form-control', 'placeholder' => 'Reference to my presentation'))}}</td>
          <td>
          	<div style="margin-top:10px;">
          	<select name="TWOcolor" id="TWOcolor">
				  <option value="#7bd148">Green</option>
				  <option value="#5484ed">Bold blue</option>
				  <option value="#a4bdfc">Blue</option>
				  <option value="#46d6db">Turquoise</option>
				  <option value="#7ae7bf">Light green</option>
				  <option value="#51b749">Bold green</option>
				  <option value="#fbd75b">Yellow</option>
				  <option value="#ffb878">Orange</option>
				  <option value="#ff887c">Red</option>
				  <option value="#dc2127">Bold red</option>
				  <option value="#dbadff">Purple</option>
				  <option value="#e1e1e1">Gray</option>
			</select>
			</div>
		</td>
        </tr>
        <tr>
          <td>3</td>
          <td>{{Form::text('hooks[]', null, array('class' => 'form-control', 'placeholder' => 'Reference to my presentation'))}}</td>
          <td>
          	<div style="margin-top:10px;">
          	<select name="THREEcolor" id="THREEcolor">
				  <option value="#7bd148">Green</option>
				  <option value="#5484ed">Bold blue</option>
				  <option value="#a4bdfc">Blue</option>
				  <option value="#46d6db">Turquoise</option>
				  <option value="#7ae7bf">Light green</option>
				  <option value="#51b749">Bold green</option>
				  <option value="#fbd75b">Yellow</option>
				  <option value="#ffb878">Orange</option>
				  <option value="#ff887c">Red</option>
				  <option value="#dc2127">Bold red</option>
				  <option value="#dbadff">Purple</option>
				  <option value="#e1e1e1">Gray</option>
			</select>
			</div>
		</td>
        </tr>
      </tbody>
    </table>
	</div>
</div>
{{ Form::submit('Create Room', array('class' => 'btn btn-default')) }}
</div>
{{Form::close()}}
{{ HTML::script('js/jquery.simplecolorpicker.js'); }}
<script>
$('select[name="ONEcolor"]').simplecolorpicker({picker: true, theme: 'fontawesome'});
$('select[name="TWOcolor"]').simplecolorpicker({picker: true, theme: 'fontawesome'});
$('select[name="THREEcolor"]').simplecolorpicker({picker: true, theme: 'fontawesome'});

$("#presentation_create_form").submit(function() {
	$("#alert").removeClass("alert-danger").empty();
	var hookVal = "";
	$('input[name="hooks[]"]').each(function() { 
		hookVal = hookVal + "-" + $(this).val();
	});

	form_data = {
		name: $('#name').val(),
        identifier: $('#identifier').val(),
		hooks: hookVal,
		ONEcolor: $('#ONEcolor').val(),
		TWOcolor: $('#TWOcolor').val(),
		THREEcolor: $('#THREEcolor').val(),
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