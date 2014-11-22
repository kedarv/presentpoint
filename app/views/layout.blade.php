<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="token" content="{{ Session::token() }}">
    <title>{{{ $data['name'] }}}</title>
	{{ HTML::style('css/bootstrap.css'); }}
	{{ HTML::style('css/font-awesome.min.css'); }}
	<style>
	body {
		padding-top: 70px;
		margin-bottom: 20px;
	}
	abbr[title] {
		border:none;
	}
	.text-left {
		margin-top: 0px;
	}
	</style>
	@section('append_css')
	@show
	
	@section('js')
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'); }}
	{{ HTML::script('js/bootstrap.min.js'); }}
	@show
</head>
<body>
 @include('nav')
    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
				@yield('content')
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-md-6 col-md-offset-6">
				<span class="pull-right"><a href="{{action('PageController@contact')}}"><i class="fa fa-envelope-o"></i>  Contact</a>  |  <i class="fa fa-life-ring"></i>  FAQ | <i class="fa fa-copyright"></i>  PresentPoint</span>
			</div>
		</div>
	</div>
	@section('bottom_js')
	@show
</body>
</html>