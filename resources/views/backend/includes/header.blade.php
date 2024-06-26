<?php
$notifications = optional(auth()->user())->unreadNotifications;
$notifications_count = optional($notifications)->count();
$notifications_latest = optional($notifications)->take(5);
?>

<header class="header header-sticky mb-2">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <!-- <i class="fa-solid fa-bars"></i> -->
            <svg width="20" height="20" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-fold-icon">
                <path d="M6 9 H42" stroke="#555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M19 19 H42" stroke="#555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M19 29 H42" stroke="#555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M11 19 L6 24 L11 29" stroke="#555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M6 39 H42" stroke="#555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <svg width="20" height="20" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-unfold-icon">
                <path d="M6 9 H42" stroke="#555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M19 19 H42" stroke="#555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M19 29 H42" stroke="#555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M6 19 L11 24 L6 29" stroke="#555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M6 39 H42" stroke="#555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
        <span class="text-gray">{{app_name()}}</span>
        <ul class="header-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.index') }}" target="_blank">
                    <span class="d-none d-sm-inline">{{__("View website")}}</span>&nbsp;<i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
            </li>
        </ul>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-regular fa-bell"></i>
                    &nbsp; @if($notifications_count)<span class="badge badge-pill bg-danger">{{$notifications_count}}</span>@endif
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2 rounded-top-2">
                        <strong>@lang("You have :count notifications", ['count'=>$notifications_count])</strong>
                    </div>

                    @if($notifications_latest)
                    @foreach($notifications_latest as $notification)
                    @php
                    $notification_text = isset($notification->data['title'])? $notification->data['title'] : $notification->data['module'];
                    @endphp
                    <a class="dropdown-item" href="{{route("backend.notifications.show", $notification)}}">
                        <i class="{{isset($notification->data['icon'])? $notification->data['icon'] : 'fa-solid fa-bullhorn'}} "></i>&nbsp;{{$notification_text}}
                    </a>
                    @endforeach
                    @endif
                </div>
            </li>
        </ul>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-language"></i>&nbsp; {{strtoupper(App::getLocale())}}
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2 rounded-top-2">
                        <div class="fw-semibold">{{ __('Change language') }}</div>
                    </div>
                    @foreach(config('app.available_locales') as $locale_code => $locale_name)
                    <a class="dropdown-item" href="{{route('language.switch', $locale_code)}}">
                        {{ $locale_name }}
                    </a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <img class="avatar-img" src="{{ asset(auth()->user()->avatar) }}" alt="{{ asset(auth()->user()->name) }}">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2 rounded-top-2">
                        <div class="fw-semibold">{{ __('Account') }}</div>
                    </div>

                    <a class="dropdown-item" href="{{route('backend.users.profile', Auth::user()->id)}}">
                        <i class="fa-regular fa-user me-2"></i>&nbsp;{{ Auth::user()->name }}
                    </a>
                    <a class="dropdown-item" href="{{route('backend.users.profile', Auth::user()->id)}}">
                        <i class="fa-regular fa-user me-2"></i>&nbsp;{{ Auth::user()->email }}
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('backend.notifications.index') }}">
                        <i class="fa-regular fa-bell me-2"></i>&nbsp;
                        @lang('Notifications') <span class="badge bg-danger ml-auto">{{$notifications_count}}</span>
                    </a>

                    <div class="dropdown-header bg-light py-2">
                        <strong>@lang('Settings')</strong>
                    </div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>&nbsp;
                        @lang('Logout')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                </div>
            </li>
        </ul>
    </div>

    <div class="header-divider"></div>

    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                @yield('breadcrumbs')
            </ol>
        </nav>
        <div class="d-flex flex-row float-end">
            <div class="date_today">{{ date_today() }}&nbsp;</div>
            <div class="clock" id="liveClock"></div>
            <script>
                function showTime() {
                    const date = new Date();
                    let hours = date.getHours();
                    let minutes = date.getMinutes();
                    let seconds = date.getSeconds();

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    // const locale = document.getElementsByTagName("html")[0].getAttribute("lang");
                    const time = hours.toLocaleString() + ":" + minutes.toLocaleString() + ":" + seconds.toLocaleString();

                    document.getElementById("liveClock").textContent = time;

                    setTimeout(showTime, 1000);
                }
                showTime();
            </script>
        </div>
    </div>
</header>