<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{action('PageController@showWelcome')}}">PresentPoint</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li><a href="{{action('PageController@showWelcome')}}">Home</a></li>
      @if (!Auth::guest())
      <li><a href="{{action('PageController@createRoom')}}">Create Room</a></li>
      <li><a href="{{action('PageController@viewAllRooms')}}">View My Rooms</a></li>
      @endif
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::guest())
        <li><a href="{{action('UsersController@create')}}">Register</a></li>
        <li><a href="{{action('UsersController@login')}}">Login</a></li>
      @else
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->username}}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{action('UsersController@logout')}}"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
          </ul>
      </li>
      @endif
    </ul>
  </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>