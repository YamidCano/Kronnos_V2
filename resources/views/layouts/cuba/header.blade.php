<div @if (auth()->user()->sidebar == 1) class="page-header close_icon"
    @else class="page-header" @endif>

    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Search Cuba .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span
                                class="sr-only">Loading...</span></div><i class="close-search"
                            data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid"
                        src="../assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
            </div>
        </div>
        <div class="left-header col horizontal-wrapper ps-0">
        </div>
        <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">
                <li class="language-nav">
                    <div class="translate_wrapper">
                        <div class="current_lang">
                            <div class="lang"><i
                                    class="flag-icon flag-icon-{{ App::getLocale() == 'en' ? 'us' : App::getLocale() }}"></i><span
                                    class="lang-txt">{{ App::getLocale() }} </span></div>
                        </div>
                        <div class="more_lang">
                            <a href="{{ route('lang', 'es') }}"
                                class="{{ App::getLocale() == 'en' ? 'active' : '' }}">
                                <div class="lang {{ App::getLocale() == 'es' ? 'selected' : '' }}" data-value="es">
                                    <i class="flag-icon flag-icon-es"></i> <span class="lang-txt">Español</span>
                                </div>
                            </a>
                            {{-- <a href="{{ route('lang', 'en') }}"
                                class="{{ App::getLocale() == 'en' ? 'active' : '' }}">
                                <div class="lang {{ App::getLocale() == 'en' ? 'selected' : '' }}" data-value="en">
                                    <i class="flag-icon flag-icon-us"></i> <span
                                        class="lang-txt">English</span><span> (US)</span>
                                </div>
                            </a> --}}
                        </div>
                    </div>
                </li>
                <li>
                    @livewire('components.header')
                </li>
                <li class="maximize d-block"><a class="text-dark " href="#!"
                        onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                <li class="onhover-dropdown p-0 me-0">
                    <div class="media profile-media">
                        <img height="40" class="b-r-10"
                            src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}  {{ Auth::user()->last_name }}.'&color=FFFFFF&background=e74c3c"
                            alt="">
                        <div class="media-body"><span>{{ Auth::user()->name }}</span>
                            <p class="mb-0 font-roboto">{{ Auth::user()->last_name }}<i
                                    class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="{{ url('perfil') }}"><i
                                    data-feather="user"></i><span>{{ trans('lang.Profile') }}</span>
                            </a>
                        </li>
                        {{-- <li><a href="#"><i data-feather="mail"></i><span>Inbox</span></a></li>
                        <li><a href="#"><i data-feather="file-text"></i><span>Taskboard</span></a></li> --}}
                        {{-- <li>
                            <a href="#"><i data-feather="settings"></i><span>{{ trans('lang.Settings') }}</span></a>
                        </li> --}}
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                <i data-feather="log-in">
                                </i><span>{{ trans('lang.Logout') }}</span>
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
