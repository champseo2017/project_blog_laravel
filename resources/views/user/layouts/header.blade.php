 <!-- Navigation -->
 <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="post.html">Sample Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            
              @if(Auth::guest())
              <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            @else
             <li class="nav-item">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
             {{ Auth::user()->name }}<span class="caret"></span>
             </a>
             </li>
     <li class="nav-item">
             <a href="{{ route('logout') }}"
             onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();
                      ">
             
             Logout
              </a>
             </li>
             <form id="logout-form" action="{{ route('logout') }}" method="post" style="display:none;">
             {{ csrf_field() }}
             </form>

             @endif
            
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
                  
    <header class="masthead" style="background-image: url(@yield('bg-img'))">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                             {!! session()->get('success') !!}
                        </div>
                    @endif
              @if (session()->has('logout'))
                    <div class="alert alert-danger" role="alert">
                             {!! session()->get('logout') !!}
                    </div>
                    @endif
              <h1>@yield('title')</h1>
              <span class="subheading">@yield('sub-heading')</span>
            </div>
          </div>
        </div>
      </div>
    </header>