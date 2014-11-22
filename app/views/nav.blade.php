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
      <li><a href="{{action('PageController@showWelcome')}}">Home <span class="sr-only">(current)</span></a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::guest())
        <li><a href="{{action('UsersController@create')}}">Register</a></li>
        <li><a href="{{action('UsersController@login')}}">Login</a></li>
      @else
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->username}}<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          @if(Auth::user()->completedprofile == 1)
            <li><a href="{{action('UsersController@details')}}"><i class="fa fa-user"></i>&nbsp;&nbsp;View Profile</a></li>
            <li><a href="{{action('UsersController@modify')}}"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Modify Profile</a></li>
            <li><a href="#"><i class="fa fa-exchange"></i>&nbsp;&nbsp;View Match</a></li>
          @else
            <li><a href="{{action('UsersController@modify')}}"><i class="fa fa-file-o"></i>&nbsp;&nbsp;Complete Profile</a></li>
          @endif
                  <li><a href="#"><i class="fa fa-warning"></i>&nbsp;&nbsp;Deauthorize Account</a></li>
                  <li class="divider"></li>
                  <li><a href="{{action('UsersController@logout')}}"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
              </ul>
          </li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>