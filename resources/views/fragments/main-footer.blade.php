<div class="flex flex-col bottom-0 left-0 w-full bg-[#455452] gap-2 px-8 py-5 ">
    <div class="flex flex-col md:flex-row w-full md:justify-center">
        <div class="w-full md:w-2/5 flex flex-col px-4 py-2">
            <div class="flex gap-2 items-center">
                <img class="w-12 h-12" src="{{ asset('dist/images/logo_khalis_white.png') }}" alt="Khalis Bali Bamboo">
                <div class="flex flex-col">
                    <h2 class="text-2xl text-white font-medium">Khalis Bali Bamboo</h2>
                    <h6 class="text-xs text-white mt-0.5 italic font-normal">Manufacturer, Wholesaler, & Exporter </h6>
                </div>
            </div>
            {{-- short desc --}}
            <p class="text-sm text-white mt-3">Khalis Bali Bamboo is a manufacturing company specializing in bamboo
                furniture
                and
                handicrafts. We offer various types of bamboo products in retail and wholesale.</p>
            {{-- payment icon --}}
            <div class="flex gap-2 items-center w-full mt-5">
                <div class="bg-white w-10 aspect-square flex items-center p-1">
                    <img class="object-cover w-full h-auto" src="{{ asset('dist/images/icon/visa_logo.jpg') }}"
                        alt="visa">
                </div>
                <div class="bg-white w-10 aspect-square flex items-center p-1">
                    <img class="object-cover w-full h-auto object-center"
                        src="{{ asset('dist/images/icon/visa_electron.jpg') }}" alt="visa-electron">
                </div>
                <div class="bg-white w-10 aspect-square flex items-center p-1">
                    <img class="object-cover w-full h-auto object-center"
                        src="{{ asset('dist/images/icon/mastercard_logo.jpg') }}" alt="mastercard">
                </div>
                <div class="bg-white w-10 aspect-square flex items-center p-1">
                    <img class="object-cover w-full h-auto object-center"
                        src="{{ asset('dist/images/icon/paypal_logo.jpg') }}" alt="paypal">
                </div>
                <div class="bg-white w-10 aspect-square flex items-center p-1">
                    <img class="object-cover w-full h-auto object-center"
                        src="{{ asset('dist/images/icon/maestro_logo.jpg') }}" alt="maestro">
                </div>
                <div class="bg-white w-10 aspect-square flex items-center p-1">
                    <img class="object-cover w-full h-auto object-center"
                        src="{{ asset('dist/images/icon/american_express_logo.jpg') }}" alt="american_express">
                </div>

            </div>


        </div>
        <div class="w-full md:w-1/5 flex flex-col px-4 py-2">
            <h2 class="text-lg font-bold text-white uppercase">Menu</h2>
            <ul class="mt-2">
                <li class="flex flex-col text-white">
                    <a href="http://">Home</a>
                </li>
                <li class="flex text-white"><a href="http://">Products</a></li>
                <li class="flex text-white"><a href="http://">About Us</a></li>
                <li class="flex text-white"> <a href="http://">Contact Us</a></li>

            </ul>
        </div>
        <div class="w-full md:w-1/5 flex flex-col px-4 py-2">
            <h2 class="text-lg font-bold text-white uppercase">Accounts</h2>
            <ul class="mt-2">
                @auth
                    <li class="text-white">
                        <button type="button" onclick="myAccDropdown()">My Account<i id="icon-dropdown"
                                class="fa-solid fa-caret-down ml-1"></i></button>
                        <ul id="my-account-menu" class="hidden text-white pl-4 my-1"">
                            <li class="flex text-white">
                                <a href="{{ route('profile.update') }}">Edit Profile</a>
                            </li>
                            <li class="flex tex-white">
                                <a href="{{ route('password.update') }}">Change Password</a>
                            </li>
                        </ul>
                    </li>
                    <li class="flex text-white">
                        <a href="http://">My Wishlist</a>
                    </li>
                @else
                    <li class="flex text-white">
                        <button type="button" onclick="showAlert()">My Account<i id="icon-dropdown"
                                class="fa-solid fa-caret-down ml-1"></i></button>
                    </li>
                    <li class="flex text-white">
                        <button type="button" onclick="showAlert()">My Wishlist</button>
                    </li>
                @endauth
            </ul>
        </div>
        <div class="w-full md:w-1/5 flex flex-col px-4 py-2">
            <h2 class="text-lg font-bold text-white uppercase">Contact Us</h2>
            <ul class="mt-2">
                <li class="flex text-white"><a href="http://">Warehouse</a></li>
                <li class="flex text-white"><a href="http://">Shop</a></li>
                <li class="flex text-white"> <a href="http://">Whatsapp</a></li>
                <li class="flex text-white"> <a href="http://">Email</a></li>
            </ul>
            <div class="flex gap-2 items-center w-full mt-3">
                <ul class="mt-2 flex gap-1">
                    <li class="flex text-white border-2 rounded-full w-8 h-8 p-2 items-center justify-center"><a
                            href="http://"><i class="fa-brands fa-instagram"></i></a></li>
                    <li class="flex text-white border-2 rounded-full w-8 h-8 p-2 items-center justify-center"><a
                            href="http://"><i class="fa-brands fa-facebook"></i></a></li>
                    <li class="flex text-white border-2 rounded-full w-8 h-8 p-2 items-center justify-center"><a
                            href="http://"><img class="w-full" src="{{ asset('dist/images/shopee_logo.png') }}"
                                alt="icon"></a></li>
                </ul>
            </div>


        </div>
    </div>
    <hr class="border border-white my-3">
    <div class="text-white text-center">Copyright<i class="mx-1 fa-regular fa-copyright"></i>2023 | All right reserved
        by
        Khalis Bali
        Bamboo, Ltd.</div>
</div>
