{{-- begin navbar --}}
<div class="flex flex-wrap place-items-center top-0 left-0">
    <section class="relative mx-auto w-full">
        <!-- navbar -->
        <nav class="flex justify-between bg-white">
            <div class="px-5 xl:px-12 py-5 flex w-full items-center">
                <a class="text-3xl font-bold font-heading" href="#">
                    <img class="w-12" src="{{ asset('dist/images/logo_khalis.png') }}" alt="logo">
                </a>
                <!-- Nav Links -->
                <ul class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12">
                    <li class="{{ Request::is('/') ? 'nav-active' : 'nav-hover' }}"><a
                            href="{{ route('main') }}">Home</a>
                    </li>
                    <li class="{{ Request::is('product**') ? 'nav-active' : 'nav-hover' }}"><a
                            href="{{ route('main.product') }}">Products</a></li>
                    <li class="{{ Request::is('about**') ? 'nav-active' : 'nav-hover' }}"><a
                            href="{{ route('main.about-us') }}">About
                            Us</a></li>
                    <li class="{{ Request::is('contact**') ? 'nav-active' : 'nav-hover' }}"><a
                            href="{{ route('main.contact-us') }}">Contact
                            Us</a></li>
                </ul>
                {{-- header icon desktop --}}
                <div class="hidden md:flex space-x-5 items-center">
                    @auth
                        {{-- Wishlist --}}
                        <a class="flex items-center" href="#">
                            <i class="fa-regular fa-heart text-xl font-medium"></i>
                            <span class="flex absolute -mt-3 ml-4">
                                {{-- <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-pink-400 opacity-75"></span> --}}
                                <span class="relative inline-flex rounded-full h-4 w-4 bg-pink-300">
                                    <span
                                        class="text-[10px] font-medium flex justify-center items-center h-full w-full">12</span>
                                </span>
                            </span>
                        </a>
                        {{-- Profile --}}
                        <button class="flex items-center" type="button" onclick="userMenuDropdown()">
                            <i class="fa-regular fa-user-circle text-xl font-medium"></i>
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center font-semibold font-heading"><i
                                class="fa-solid fa-sign-in text-xl font-medium mr-2"></i></a>
                    @endauth

                </div>
            </div>
            <!-- Responsive navbar -->
            {{-- wishlist --}}
            @auth
                <a class="md:hidden flex mr-4 items-center" href="#">
                    <i class="fa-regular fa-heart text-xl font-medium"></i>
                    <span class="flex absolute -mt-3 ml-4">
                        {{-- <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-pink-400 opacity-75"></span> --}}
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-pink-300">
                            <span class="text-[10px] font-medium flex justify-center items-center h-full w-full">12</span>
                        </span>
                    </span>
                </a>
            @endauth
            {{-- sidenav button mobile --}}
            <button type="button" class="navbar-burger self-center mr-4 md:hidden" onclick="sideNavMobile()">
                <i class="fas fa-bars text-xl font-medium"></i>
            </button>

        </nav>


    </section>
</div>
{{-- end navbar --}}

{{-- side nav mobile --}}
<div id="sidenav" class="hidden md:hidden">
    <div id="sidenav-overlay" class="fixed z-50 inset-0 bg-black bg-opacity-80">

    </div>

    <div class="fixed z-50 right-0 top-0 h-screen w-64 bg-[#455452] text-white">
        <ul class="mt-6">
            @auth
                <li class="px-4 py-2 mb-2 text-center">
                    <i class="fa-regular fa-user-circle text-xl font-medium"></i>
                    <div class="text-base font-medium">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-xs text-white/70 mt-0.5">{{ auth()->user()->level ?? 'Administrator' }}</div>
                </li>
                <hr class="mb-2">
            @endauth
            <li class="{{ Request::is('/') ? 'sidenav-active' : 'sidenav-hover' }}"><a href="{{ route('main') }}"
                    class="block py-2 px-4  text-base font-medium">Home</a>
            </li>
            <li class="{{ Request::is('product**') ? 'sidenav-active' : 'sidenav-hover' }}"><a
                    href="{{ route('main.product') }}" class="block py-2 px-4 text-base font-medium">Products</a>
            </li>
            <li class="{{ Request::is('about**') ? 'sidenav-active' : 'sidenav-hover' }}"><a
                    href="{{ route('main.about-us') }}" class="block py-2 px-4 text-base font-medium">About Us</a></li>
            <li class="{{ Request::is('contact**') ? 'sidenav-active' : 'sidenav-hover' }}"><a
                    href="{{ route('main.contact-us') }}" class="block py-2 px-4 text-base font-medium">Contact Us</a>
            </li>
            @auth
                <li class="relative">
                    <button type="button" class="block py-2 px-4 text-base font-medium" onclick="dropdownSidenav()">My
                        Account <i id="icon-dropdown" class="fa-solid fa-caret-down ml-1"></i></button>
                    <ul id="dropdown-menu" class="hidden text-white pl-4 mt-1">
                        <li class="{{ Request::is('/profile**') ? 'sidenav-active' : 'sidenav-hover' }}"><a
                                href="{{ route('profile.update') }}" class="block py-1 px-4 text-base font-medium">Edit
                                Profile</a>
                        </li>
                        <li class="{{ Request::is('/password**') ? 'sidenav-active' : 'sidenav-hover' }}"><a
                                href="{{ route('password.update') }}" class="block py-1 px-4 text-base font-medium">Change
                                Password</a>
                        </li>
                    </ul>
                </li>
                <hr class="mt-2">
                <li><a href="{{ route('logout') }}"
                        class="block mt-5 py-2 px-4 hover:bg-[#3B4846] text-base font-medium"><i
                            class="fa-solid fa-sign-out text-base mr-1"></i> Logout</a>
                </li>
            @else
                <hr class="mt-2">
                <li><a href="{{ route('login') }}" class="block mt-5 py-2 px-4 hover:bg-[#3B4846] text-base font-medium"><i
                            class="fa-solid fa-sign-in text-base mr-1"></i>Login</a>
                </li>
            @endauth

        </ul>
    </div>
</div>

{{-- side nav mobile --}}

{{-- begin user menu --}}
<div id="user-menu" class="fixed hidden top-12 right-5 z-50 p-4">
    <div class="py-4 px-4 w-50 rounded-md shadow-sm bg-[#3B4846]">
        <ul class="text-white gap-2">
            <li class="mb-4">
                <div class="text-sm font-medium">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="text-xs text-white/70 mt-0.5">{{ auth()->user()->level ?? 'Administrator' }}</div>
            </li>
            <li>
                <hr class="border-white mb-1">
            </li>
            <li class="mb-1">
                <a href="{{ route('profile.update') }}" class="text-sm"> <i
                        class="fa-regular fa-edit text-xs mr-2"></i>
                    Edit Profile </a>
            </li>
            <li>
                <a href="{{ route('password.update') }}" class="text-sm"> <i
                        class="fa-solid fa-lock text-xs mr-2"></i>
                    Change Password </a>
            </li>
            <li>
                <hr class="border-white my-2">
            </li>
            <li class="mt-2">
                <a href="{{ route('logout') }}" class="text-sm"> <i class="fa-solid fa-sign-out w-4 h-4 mr-2"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>


</div>
{{-- end user menu --}}
{{-- <!-- Does this resource worth a follow? -->
    <div class="absolute bottom-0 right-0 mb-4 mr-4 z-10">
        <div>
            <a title="Follow me on twitter" href="https://www.twitter.com/asad_codes" target="_blank"
                class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
                <img class="object-cover object-center w-full h-full rounded-full"
                    src="https://www.imore.com/sites/imore.com/files/styles/large/public/field/image/2019/12/twitter-logo.jpg" />
            </a>
        </div>
    </div> --}}


{{-- end navbar --}}
