
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      @guest
         <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0"> 
      @endguest
      @auth
          <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center me-auto me-xl-0">
      @endauth
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">Strategy</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
            @guest
                <li><a href="{{ route('home')}}" class="active">Home</a></li>
            @endguest
            @auth
                <li><a href="{{ route('dashboard') }}">Student</a></li>
                <li><a href="#services">Teacher</a></li>
                <li><a href="{{ route('users.index')}}">User</a></li>
            @endauth
         
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      @guest
        <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
        <a class="btn-getstarted" href="{{ route('register') }}">Register</a>
      @endguest
      @auth
      <!-- Settings Dropdown -->
      <div class="hidden sm:flex sm:items-center sm:ms-6">
          <x-dropdown align="right" width="48">
              <x-slot name="trigger">
                  <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                      <div>{{ Auth::user()->name }}</div>

                      <div class="ms-1">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                          </svg>
                      </div>
                  </button>
              </x-slot>

              <x-slot name="content">
                  <x-dropdown-link :href="route('profile.edit')">
                      {{ __('Profile') }}
                  </x-dropdown-link>

                  <!-- Authentication -->
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf

                      <x-dropdown-link :href="route('logout')"
                              onclick="event.preventDefault();
                                          this.closest('form').submit();">
                          {{ __('Log Out') }}
                      </x-dropdown-link>
                  </form>
              </x-slot>
          </x-dropdown>
      </div>
      
       
      @endauth

    </div>
  </header>