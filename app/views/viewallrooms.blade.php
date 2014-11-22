@extends('layout')
@section('content')
<div class="well">
<h1 class="text-left">View My Rooms</h1>
<table class="table">
	<thead>
    	<tr>
       		<th>#</th>
          	<th>Presentation Room Name</th>
          	<th>Modify</th>
     	</tr>
 	</thead>
   	<tbody>
   		<?php $i = 1; ?>
		@foreach($room as $a)
	    	<tr>
	        	<td>{{$i}}</td>
	         	<td><a href="{{action('PageController@getRoom', [$a['id']])}}">{{{$a['name']}}}</a></td>
	         	<td><a href="#">Modify &raquo;</a></td>
	        </tr>
	    <?php $i++;?>
		@endforeach
  	</tbody>
</table>
</div>
@stop