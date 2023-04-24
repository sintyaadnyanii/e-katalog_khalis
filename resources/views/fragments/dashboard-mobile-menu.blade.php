 <!-- BEGIN: Mobile Menu -->
 <div class="mobile-menu md:hidden">
     <div class="mobile-menu-bar">
         <a href="" class="flex mr-auto">
             <img alt="Khalis Bali Bamboo" class="w-10" src="{{ asset('dist/images/logo_khalis_white.png') }}">
         </a>
         <a href="#" class="mobile-menu-toggler"> <i data-lucide="menu"
                 class="w-8 h-8 -mr-5 text-white transform"></i> </a>
     </div>
     <div class="scrollable">
         <a href="#" class="mobile-menu-toggler"> <i data-lucide="x-circle"
                 class="w-8 h-8 text-white transform -rotate-90"></i> </a>
         <ul class="scrollable__content py-2">
             <li>
                 <a href="#" class="menu {{ Request::is('dashboard/overwiew**') ? 'menu-active' : '' }} ">
                     <div class="menu__icon"> <i data-lucide="home"></i> </div>
                     <div class="menu__title"> Dashboard </div>
                 </a>
             </li>
             {{-- <li>
                 <a href="javascript:;" class="menu">
                     <div class="menu__icon"> <i data-lucide="box"></i> </div>
                     <div class="menu__title"> Menu Layout <i data-lucide="chevron-down" class="menu__sub-icon "></i>
                     </div>
                 </a>
                 <ul class="">
                     <li>
                         <a href="index.html" class="menu">
                             <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                             <div class="menu__title"> Side Menu </div>
                         </a>
                     </li>
                     <li>
                         <a href="simple-menu-light-dashboard-overview-1.html" class="menu">
                             <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                             <div class="menu__title"> Simple Menu </div>
                         </a>
                     </li>
                     <li>
                         <a href="top-menu-light-dashboard-overview-1.html" class="menu">
                             <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                             <div class="menu__title"> Top Menu </div>
                         </a>
                     </li>
                 </ul>
             </li> --}}
             <li>
                 <a href="{{ route('manage_category.all') }}"
                     class="menu {{ Request::is('dashboard/categor**') ? 'menu-active' : '' }} ">
                     <div class="menu__icon"> <i data-lucide="layout-list"></i> </div>
                     <div class="menu__title"> Categories </div>
                 </a>
             </li>
             <li>
                 <a href="{{ route('manage_product.all') }}"
                     class="menu {{ Request::is('dashboard/product**') ? 'menu-active' : '' }} ">
                     <div class="menu__icon"> <i data-lucide="package"></i> </div>
                     <div class="menu__title"> Products </div>
                 </a>
             </li>
             <li>
                 <a href="{{ route('manage_feedback.all') }}"
                     class="menu {{ Request::is('dashboard/feedback**') ? 'menu-active' : '' }} ">
                     <div class="menu__icon"> <i data-lucide="message-square"></i> </div>
                     <div class="menu__title"> Feedback </div>
                 </a>
             </li>
             <li>
                 <a href="{{ route('manage_customer.all') }}"
                     class="menu {{ Request::is('dashboard/customer**') ? 'menu-active' : '' }} ">
                     <div class="menu__icon"> <i data-lucide="users"></i> </div>
                     <div class="menu__title"> Customers </div>
                 </a>
             </li>
         </ul>
     </div>
 </div>
 <!-- END: Mobile Menu -->
