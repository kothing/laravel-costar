@php
$route_path = Request::route()->getName();
@endphp

<nav class="bg-white drop-shadow-md">
    <div class="max-w-7xl mx-auto px-2 py-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <!-- open menu button -->
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button 
                    type="button" 
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                >
                    <span class="sr-only">{{__('Open main menu')}}</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- main menu -->
            <div class="flex-1 flex items-center justify-center content-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/">
                        <img class="block h-10 w-auto" src="{{asset('images/logo.svg')}}" alt="{{ app_name() }}">
                    </a>
                </div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="frontend-main-menu flex space-x-4">
                        <a 
                            href="{{ route('frontend.index') }}" 
                            class="{{ $route_path == 'frontend.index' ? 'active border-orange-600' : 'border-transparent'}} text-gray-600 border-b-2 hover:border-orange-600 px-3 py-2 text-base font-medium transition ease-out duration-300"
                        >
                            @lang('Home')
                        </a>
                        <a 
                            href="{{ route('frontend.pages.index') }}" 
                            class="{{ $route_path == 'frontend.pages.index' || $route_path == 'frontend.pages.show' ? 'active border-orange-600' : 'border-transparent'}} text-gray-600 border-b-2 hover:border-orange-600 px-3 py-2 text-base font-medium transition ease-out duration-300"
                        >
                            @lang('Pages')
                        </a>
                        <a 
                            href="{{ route('frontend.posts.index') }}" 
                            class="{{ $route_path == 'frontend.posts.index' || $route_path == 'frontend.posts.show' ? 'active border-orange-600' : 'border-transparent'}} text-gray-600 border-b-2 hover:border-orange-600 px-3 py-2 text-base font-medium transition ease-out duration-300"
                        >
                            @lang('Article')
                        </a>
                        <a 
                            href="{{ route('frontend.subjects.index') }}" 
                            class="{{ $route_path == 'frontend.subjects.index' || $route_path == 'frontend.subjects.show' ? 'active border-orange-600' : 'border-transparent'}} text-gray-600 border-b-2 hover:border-orange-600 px-3 py-2 text-base font-medium transition ease-out duration-300"
                        >
                            @lang('Collection')
                        </a>
                    </div>
                </div>
            </div>

            <!-- locale & user -->
            <div class="flex items-center pr-2 sm:ml-6 sm:pr-0">
                <div class="flex flex-row">
                    <button 
                        type="button"
                        id="locale-menu-button"
                        class="flex flex-col sm:flex-row text-center rounded px-2 mr-2 sm:align-middle sm:items-center focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-offset-gray-500 focus:ring-white transition ease-out duration-300" 
                    >
                        <span class="sr-only">{{__('Open local menu')}}</span>
                        <span><i class="fa-solid fa-language"></i></span>
                        <span>
                            <span class="hidden sm:inline">&nbsp;</span>
                            {{strtoupper(App::getLocale())}}
                        </span>
                    </button>
                    @guest
                        <a href="{{ route('login') }}" class="flex items-center mx-2 px-3 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span class="mx-1">{{__('Login')}}</span>
                        </a>
                        @if(user_registration())
                            <a href="{{ route('register') }}" class="flex items-center mx-2 px-3 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:bg-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="mx-1">{{__('Register')}}</span>
                            </a>
                        @endif
                    @else
                        <button
                            type="button"
                            id="user-menu-button"
                            class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-offset-cyan-800 focus:ring-white transition ease-out duration-300"
                        >
                            <span class="sr-only">{{__('Open Main Menu')}}</span>
                            <img class="h-10 w-10 rounded-full border-transparent border hover:border-cyan-600" src="{{asset(auth()->user()->avatar)}}" alt="{{asset(auth()->user()->name)}}">
                        </button>
                    @endguest
                </div>

                <!-- Locales Dropdown -->
                <div id="locale-menu-box" class="origin-top-right py-2 w-42 bg-white focus:outline-none hidden">
                    @foreach(config('app.available_locales') as $locale_code => $locale_name)
                    <div class="hover:bg-orange-100 px-4 py-1">
                        <a class="dropdown-item" href="{{route('language.switch', $locale_code)}}">
                            {{ $locale_name }}
                        </a>
                    </div>
                    @endforeach
                </div>

                @auth
                    <!-- User Dropdown -->
                    <div id="user-menu-box" class="origin-top-right w-42 bg-white focus:outline-none hidden">
                        @can('view_backend')
                        <a href='{{ route("backend.dashboard") }}' class="block px-2 py-2 text-sm text-gray-600 hover:bg-orange-600 hover:text-white">
                            <i class="fas fa-tachometer-alt fa-fw"></i>&nbsp;{{__('Admin Dashboard')}}
                        </a>
                        @endif
                        <a href="{{ route('frontend.users.profile', encode_id(auth()->user()->id)) }}" class="block px-2 py-2 text-sm text-gray-600 hover:bg-orange-600 hover:text-white">
                            <i class="fas fa-user fa-fw"></i>&nbsp;{{ Auth::user()->name }}
                        </a>
                        <a href="{{ route('frontend.users.profileEdit', encode_id(auth()->user()->id)) }}" class="block px-2 py-2 text-sm text-gray-600 hover:bg-orange-600 hover:text-white">
                            <i class="fas fa-cogs fa-fw"></i>&nbsp;{{__('Settings')}}
                        </a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-2 py-2 text-sm text-gray-600 hover:bg-orange-600 hover:text-white">
                            <i class="fa-solid fa-right-from-bracket"></i>&nbsp;{{__('Logout')}}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden absolute z-10 w-full p-1" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-lg rounded-md ring-1 ring-black ring-opacity-5">
            <a href="/" class="text-gray-500 block px-3 py-2 rounded-md text-base font-medium">
                {{__('Home')}}
            </a> 
            <a href="{{ route('frontend.pages.index') }}" class="text-gray-500 block px-3 py-2 rounded-md text-base font-medium">
                {{__('Pages')}}
            </a>    
            <a href="{{ route('frontend.posts.index') }}" class="text-gray-500 block px-3 py-2 rounded-md text-base font-medium">
                {{__('Posts')}}
            </a>
            <a href="{{ route('frontend.subjects.index') }}" class="text-gray-500 block px-3 py-2 rounded-md text-base font-medium">
                {{__('Subjects')}}
            </a>

            @can('view_backend')
            <a href='{{ route("backend.dashboard") }}' class="text-gray-500 block px-3 py-2 rounded-md text-base font-medium border" role="menuitem">
                <i class="fas fa-tachometer-alt fa-fw"></i>&nbsp;{{__('Admin Dashboard')}}
            </a>
            @endif

            @guest
            <hr>
            <a href="{{ route('login') }}" class="text-gray-500 block mt-2 px-3 py-2 rounded-md text-base font-medium bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="transform: rotateY(180deg)">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                <span class="mx-1">{{__('Login')}}</span>
            </a>

            @if(user_registration())
            <a href="{{ route('register') }}" class="text-gray-500 block px-3 py-2 rounded-md text-base font-medium bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="mx-1">{{__('Create an account')}}</span>
            </a>
            @endif
            @endauth
        </div>
    </div>
</nav>