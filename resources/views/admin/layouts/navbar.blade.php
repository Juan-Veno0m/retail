<nav class="sb-topnav navbar navbar-expand navbar-light bg-white">
  <div class="container d-flex align-items-stretch justify-content-between">
    <div class="d-lg-flex align-items-center ml-3">
      <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
        <span class="svg-icon svg-icon-xxl svg-icon-dark-75">
          <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Align-left.svg-->
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <rect x="0" y="0" width="24" height="24"></rect>
              <rect fill="#000000" opacity="0.3" x="4" y="5" width="16" height="2" rx="1"></rect>
              <rect fill="#000000" opacity="0.3" x="4" y="13" width="16" height="2" rx="1"></rect>
              <path d="M5,9 L13,9 C13.5522847,9 14,9.44771525 14,10 C14,10.5522847 13.5522847,11 13,11 L5,11 C4.44771525,11 4,10.5522847 4,10 C4,9.44771525 4.44771525,9 5,9 Z M5,17 L13,17 C13.5522847,17 14,17.4477153 14,18 C14,18.5522847 13.5522847,19 13,19 L5,19 C4.44771525,19 4,18.5522847 4,18 C4,17.4477153 4.44771525,17 5,17 Z" fill="#000000"></path>
            </g>
          </svg>
          <!--end::Svg Icon-->
        </span>
      </button>
      <a class="navbar-brand" href="index.html"><img height="36px" src="{{asset('img/label-yolkan@36.png')}}"></a>
    </div>
    <!-- Navbar-->
    <div class="d-flex align-items-center ml-3">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <i class="fas fa-user fa-fw"></i></a>  <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
