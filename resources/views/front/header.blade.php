<header>
    <h1  ><a href="{{route('home')}}" style="text-decoration:none">Travel Along</a></h1>
    <nav>
        <ul>
            
            {{-- <li><a href="/destinations">Destinations</a></li>
            <li><a href="/packages">Packages</a></li> --}}
            
            @if (Auth::check())
            <ul class="navbar-nav navbar-right w-100-p justify-content-end">
            
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img alt="image" src="{{ asset('uploads/default.png') }}" class="rounded-circle-custom">
                        <div class="d-sm-none d-lg-inline-block"></div>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('userProfile')}}"><i class="far fa-user"></i> Edit Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
            @else
            <ul class="navbar-nav navbar-right w-100-p justify-content-end">
            
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img alt="image" src="{{ asset('uploads/default.png') }}" class="rounded-circle-custom">
                        <div class="d-sm-none d-lg-inline-block"></div>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('userLogin')}}"><i class="far fa-user"></i> Login</a></li>
                        <li><a class="dropdown-item" href="{{ route('register')}}"><i class="fas fa-sign-out-alt"></i> Register</a></li>
                    </ul>
                </li>
            </ul>
            @endif
        </ul>
    </nav>
</header>