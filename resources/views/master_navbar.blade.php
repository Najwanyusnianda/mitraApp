<div class="header py-4">
    <div class="container">
      <div class="d-flex">
        <a class="header-brand" href="#">
          <img src="{{ asset('assets/img_core/logo_bps.png') }}" class="header-brand-img" alt="Aplikasi Mitra - BPS Kota Subulussalam">
          SIBERAS - Database Mitra BPS Kota Subulussalam
        </a>
        @if ($user = Auth::user())
        <div class="d-flex order-lg-2 ml-auto">
          <!--<div class="nav-item d-none d-md-flex">
            <a href="https://github.com/tabler/tabler" class="btn btn-sm btn-outline-primary" target="_blank">Source code</a>
          </div>
          <div class="dropdown d-none d-md-flex">
            <a class="nav-link icon" data-toggle="dropdown">
              <i class="fe fe-bell"></i>
              <span class="nav-unread"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              <a href="#" class="dropdown-item d-flex">
                <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
                <div>
                  <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                  <div class="small text-muted">10 minutes ago</div>
                </div>
              </a>
              <a href="#" class="dropdown-item d-flex">
                <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/1.jpg)"></span>
                <div>
                  <strong>Alice</strong> started new task: Tabler UI design.
                  <div class="small text-muted">1 hour ago</div>
                </div>
              </a>
              <a href="#" class="dropdown-item d-flex">
                <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/18.jpg)"></span>
                <div>
                  <strong>Rose</strong> deployed new version of NodeJS REST Api V3
                  <div class="small text-muted">2 hours ago</div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item text-center">Mark all as read</a>
            </div>
          </div>-->
          <div class="dropdown">
            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
              <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
              <span class="ml-2 d-none d-lg-block">
                <span class="text-default">{{ auth()->user()->name }}</span>
                <small class="text-muted d-block mt-1">
                  {{ auth()->user()->role ==1 ? 'Administrator' : 'operator' }}
                </small>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

              <!--<a class="dropdown-item" href="#">
                <i class="dropdown-icon fe fe-user"></i> Profile
              </a>
              <a class="dropdown-item" href="#">
                <i class="dropdown-icon fe fe-settings"></i> Settings
              </a>
              <a class="dropdown-item" href="#">
                <span class="float-right"><span class="badge badge-primary">6</span></span>
                <i class="dropdown-icon fe fe-mail"></i> Inbox
              </a>
              <a class="dropdown-item" href="#">
                <i class="dropdown-icon fe fe-send"></i> Message
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="dropdown-icon fe fe-help-circle"></i> Need help?
              </a>-->
              <form action="{{ route('logout') }}" method="post">
                {{ csrf_field() }}
                <button class="dropdown-item" type="submit">
                  <i class="dropdown-icon fe fe-log-out"></i> Sign out
                </button>
              </form>

            </div>
          </div>
        </div>
        @else
          <div class="d-flex order-lg-2 ml-auto">
          <a href="{{route('login')}}">Login</a>
          </div>  
        @endif

        
        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
          <span class="header-toggler-icon"></span>
        </a>
      </div>
    </div>
  </div>
  <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-3 ml-auto">

        </div>
        <div class="col-lg order-lg-first">
          <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
            <li class="nav-item">
              <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : ''  }}"><i class="fe fe-home"></i> Dashboard </a>
            </li>

            @if ($user = Auth::user())
            <li class="nav-item">
              <a href="#" class="nav-link {{ Request::is('mitra/*') ? 'active' : '' }}" data-toggle="dropdown"><i class="fe fe-database"></i> Kelola Mitra</a>
              <div class="dropdown-menu dropdown-menu-arrow">
                <a href="{{ url('/mitra/kegiatan') }}" class="dropdown-item ">Kelola Mitra</a>
                <a href="{{  url('/mitra/db')}}" class="dropdown-item ">Daftar Mitra</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link {{ Request::is('kegiatan/*') ? 'active' : ''  }} " data-toggle="dropdown"><i class="fe fe-calendar"></i>Kelola Kegiatan Survei/Sensus</a>
              <div class="dropdown-menu dropdown-menu-arrow">
                <a href="{{ url('/kegiatan/index') }}" class="dropdown-item ">Daftar Kegiatan</a>
                <a href="{{ url('/kegiatan/create') }}" class="dropdown-item ">Tambah Kegiatan</a>
              </div>
            </li>
            @if (auth()->user()->role==1)
            <li class="nav-item">
              <a href="#" class="nav-link {{ Request::is('user/*') ? 'active' : ''  }}" data-toggle="dropdown"><i class="fe fe-user"></i>Kelola Pengguna</a>
              <div class="dropdown-menu dropdown-menu-arrow">
                <a href="{{ url('/user/index') }}" class="dropdown-item ">Kelola Pengguna</a>
              </div>
            </li>
            @endif  
            @endif





          </ul>
        </div>
      </div>
    </div>
  </div>