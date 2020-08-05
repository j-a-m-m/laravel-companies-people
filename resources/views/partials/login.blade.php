@if (Route::has('login'))
          @auth
              <a class ='nav-item nav-link' href="{{ url('/home') }}">Home</a>
          @else
              <a class='nav-item nav-link' href="{{ route('login') }}">Login</a>
  
              @if (Route::has('register'))
                  <a class='nav-item nav-link' href="{{ route('register') }}">Register</a>
              @endif
          @endauth
@endif