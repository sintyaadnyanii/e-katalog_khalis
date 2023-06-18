<!-- BEGIN: Side Menu -->
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Khalis" class="w-16" src="{{ asset('dist/images/logo_khalis_white.png') }}">
        <span class="hidden xl:block text-white text-lg ml-3">Khalis Bali Bamboo</span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}"
                class="side-menu {{ Request::is('dashboard') ? 'side-menu--active' : '' }} ">
                <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                <div class="side-menu__title">
                    Dashboard
                </div>
            </a>
        </li>
        <!-- Menu With Dropdown -->
        {{-- <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                            <div class="side-menu__title">
                                Menu Layout 
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="index.html" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="side-menu__title"> Side Menu </div>
                                </a>
                            </li>
                            <li>
                                <a href="simple-menu-light-dashboard/overview-1.html" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="side-menu__title"> Simple Menu </div>
                                </a>
                            </li>
                            <li>
                                <a href="top-menu-light-dashboard/overview-1.html" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="side-menu__title"> Top Menu </div>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
        <!-- Menu With Dropdown -->
        <li>
            <a href="{{ route('manage_category.all') }}"
                class="side-menu {{ Request::is('dashboard/categor**') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="layout-list"></i> </div>
                <div class="side-menu__title">Categories</div>
            </a>
        </li>
        <li>
            <a href="{{ route('manage_product.all') }}"
                class="side-menu {{ Request::is('dashboard/product**') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="package"></i> </div>
                <div class="side-menu__title"> Products </div>
            </a>
        </li>
        <li>
            <a href="{{ route('manage_feedback.all') }}"
                class="side-menu {{ Request::is('dashboard/feedback**') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="message-square"></i> </div>
                <div class="side-menu__title"> Feedback </div>
            </a>
        </li>
        <li>
            <a href="{{ route('manage_customer.all') }}"
                class="side-menu {{ Request::is('dashboard/customer**') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                <div class="side-menu__title"> Customers </div>
            </a>
        </li>
    </ul>
</nav>
<!-- END: Side Menu -->
