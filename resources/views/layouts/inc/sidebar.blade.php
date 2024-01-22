<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header" align="center">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ url('/dashboard') }}">
            @php
                $config = \App\Models\Config::find(1);
            @endphp
            @if ($config->logo != null)
                <img src="{{ asset('assets/uploads/logos/'.$config->logo) }}" class="navbar-brand-img h-100" alt="Asonata" height="200px">
                {{-- <i class="material-icons opacity-10">storefront</i> --}}
                {{-- <span class="ms-1 font-weight-bold text-white">Asonata</span> --}}
            @endif

        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {{-- <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('/') ? 'active bg-gradient-info':''  }}"
                    href="{{ url('/') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">storefront</i>
                    </div>
                    <span class="nav-link-text ms-1">Shop</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard') ? 'active bg-gradient-secondary':''  }}"
                    href="{{ url('/dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('Dashboard') }}</span>
                </a>
            </li>
            @if (Auth::user()->role_as != "3")
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('inscriptions') ? 'active bg-gradient-warning':''  }}"
                        href="{{ url('/inscriptions') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">inventory</i>
                        </div>
                        @php
                            $inscriptionsBadge = \App\Models\Inscription::where('inscription_status',0)->where('status',1)->get();
                        @endphp
                        <span class="nav-link-text ms-1">{{ __('Inscriptions') }}</span>&nbsp<span class="badge bg-primary">{{ $inscriptionsBadge->count() }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('instructores','show-instructor/*','add-instructor','edit-instructor/*') ? 'active bg-gradient-warning':''  }}"
                        href="{{ url('/instructores') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">sports</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Instructors') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('index_athletes','show-athlete/*','add-athlete','edit-athlete/*') ? 'active bg-gradient-warning':''  }}"
                        href="{{ url('/index_athletes') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">pool</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Athletes') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('index_cycle_classes','index_classes/*','show-class/*','add-class/*','edit-class/*','add-assist/*') ? 'active bg-gradient-warning':''  }}"
                        href="{{ url('/index_cycle_classes') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Classes') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('index_asistencias','show-assist/*') ? 'active bg-gradient-secondary':''  }}"
                        href="{{ url('/index_asistencias') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">checklist_rtl</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Assists') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('index_payments','show-payment/*') ? 'active bg-gradient-secondary':''  }}"
                        href="{{ url('/index_payments') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">payments</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Payments') }}</span>
                    </a>
                </li>
                @if (Auth::user()->role_as != "0")


                    <li class="nav-item">
                        <a class="nav-link text-white {{ Request::is('index_facilities','show-facility/*','add-facility','edit-facility/*') ? 'active bg-gradient-info':''  }}"
                            href="{{ url('/index_facilities') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">waves</i>
                            </div>
                            <span class="nav-link-text ms-1">{{ __('Facilities') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ Request::is('index_groups','show-group/*','add-group','edit-group/*','add-category/*','edit-category/*','show-category/*') ? 'active bg-gradient-info':''  }}"
                            href="{{ url('/index_groups') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">group_work</i>
                            </div>
                            <span class="nav-link-text ms-1">{{ __('Groups') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ Request::is('index_cycles','show-cycle/*','add-cycle','edit-cycle/*','add-schedule/*','edit-schedule/*') ? 'active bg-gradient-info':''  }}"
                            href="{{ url('/index_cycles') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">rotate_left</i>
                            </div>
                            <span class="nav-link-text ms-1">{{ __('Cycles') }}/{{ __('Schedules') }}/{{ __('Quota') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ Request::is('users','add-user','show-user/*','edit-user/*') ? 'active bg-gradient-primary':''  }}" href="{{ url('users') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">people_alt</i>
                            </div>
                            <span class="nav-link-text ms-1">{{ __('Users') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ Request::is('sections') ? 'active bg-gradient-primary':''  }}" href="{{ url('sections') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">language</i>
                            </div>
                            <span class="nav-link-text ms-1">{{ __('Secciones') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ Request::is('config') ? 'active bg-gradient-primary':''  }}" href="{{ url('config') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">settings</i>
                            </div>
                            <span class="nav-link-text ms-1">{{ __('Settings') }}</span>
                        </a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('my-classes','my-classes/*') ? 'active bg-gradient-warning':''  }}"
                        href="{{ url('/my-classes') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('My Classes') }}</span>
                    </a>
                </li>
            @endif

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">{{ __('Account') }}</h6>
            </li>
            @if (Auth::user()->role_as != "3")
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('show-user/'.Auth::id(),'edit-user/'.Auth::id()) ? 'active bg-gradient-success':''  }}" href="{{ url('show-user/'.Auth::id()) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('My Profile') }}</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->role_as == "3")
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('show-instructor/'.Auth::id(),'edit-instructor/'.Auth::id()) ? 'active bg-gradient-success':''  }}" href="{{ url('show-instructor/'.Auth::id()) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('My Profile') }}</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">logout</i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('Logout') }}</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link text-white " href="{{ asset('dashtemplate/pages/sign-up.html') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li> --}}
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
          <a class="btn bg-gradient-light mt-4 w-100" href="{{ url('/') }}" type="button"><i class="material-icons opacity-10">language</i> {{ __('Go to Web') }}</a>
        </div>
    </div>
</aside>
