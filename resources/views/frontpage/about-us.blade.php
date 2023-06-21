@extends('layouts.main-layout')
@section('main-content')
    {{-- start header --}}
    <div class="w-full h-56 md:h-96 bg-cover bg-no-repeat relative"
        style="background-image: url('{{ asset('dist/images/product/bamboo-1.jpg') }}')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="flex items-center justify-center h-full">
            <h1 class="text-white relative z-10 text-4xl font-bold">About Us</h1>
        </div>
    </div>
    {{-- end header --}}

    {{-- begin content --}}
    <div class="w-full m-0 py-5 px-4 lg:px-10 lg:py-8 flex flex-col gap-3 bg-gray-100 items-center justify-center">
        <div class="flex flex-col lg:flex-row gap-4 bg-white w-full shadow p-8 rounded-md">
            <div class="w-full lg:w-1/3">
                <img class="w-full md:w-1/2 lg:w-full aspect-[4/3] object-cover"
                    src="{{ asset('dist/images/product/bamboo-1.jpg') }}" alt="">
            </div>
            <div class="w-full lg:w-2/3">
                <div class="text-sm">
                    <p>Khalis Bali Bamboo Furniture is a company that manufactures bamboo furniture and handicrafts. Our
                        company has been in operation since 1990. We sell various types of bamboo handicrafts from various
                        regions in Indonesia, including Bali in retail and wholesale quantities.
                        <br><br>
                        Khalis Bali Bamboo is an export orientated company with international quality and competitive
                        prices. Until now, we have produced a lot of bamboo furniture combined with rattan, wood, and
                        coconut shell. The products include beds, chairs, tables, drawers, cabinets, wardrobes, umbrella
                        tables, bar tables, etc.
                        <br><br>
                        From our experience in dealing with our customers, they always ask for handicrafts to optimise the
                        space inside the container. We already produce handicrafts such as frames, masks, lamps, musical
                        instruments, and others. We also provide bamboo (Petung, Tali, Fishing Bamboo) and woven bamboo for
                        wall or ceiling (Bedeg Batik, Bedeg Antiq and Bedeg Natural). So, whenever you are in Bali, please
                        visit our showroom and workshop.
                    </p>
                </div>
            </div>
        </div>
        <div class="my-6">
            <strong class="text-2xl md:text-3xl">What We Do?</strong>
        </div>
        <div class="flex flex-col md:flex-row gap-2 md:gap-5 w-full items-center justify-center">
            <div class="basis-1/3 bg-white rounded-md flex flex-col items-center py-6 px-10 md:h-72 lg:h-60">
                <div
                    class="flex w-16 h-16 rounded-full border-4 border-solid border-[#455452] p-2 items-center justify-center">
                    <i class="fa-solid fa-hammer text-3xl text-[#455452]"></i>
                </div>
                <h1 class="mt-5 font-semibold text-lg lg:text-2xl text-center">Manufacturer</h1>
                <p class="my-3 text-center text-sm">We produce various bamboo handicrafts like furniture, souvenirs,
                    lampshades, etc. You can also show your design for the furniture.</p>
            </div>
            <div class="basis-1/3 bg-white rounded-md flex flex-col items-center py-6 px-10 md:h-72 lg:h-60">
                <div
                    class="flex w-16 h-16 rounded-full border-4 border-solid border-[#455452] p-2 items-center justify-center">
                    <i class="fa-solid fa-bag-shopping text-3xl text-[#455452]"></i>
                </div>
                <h1 class="mt-5 font-semibold text-lg lg:text-2xl text-center">Retailer & Wholesaler</h1>
                <p class="my-3 text-center text-sm">We sell various bamboo products in retail and wholesale quantities
                    according to your needs.</p>
            </div>
            <div class="basis-1/3 bg-white rounded-md flex flex-col items-center py-6 px-10 md:h-72 lg:h-60">
                <div
                    class="flex w-16 h-16 rounded-full border-4 border-solid border-[#455452] p-2 items-center justify-center">
                    <i class="fa-solid fa-truck-ramp-box text-3xl text-[#455452]"></i>
                </div>
                <h1 class="mt-5 font-semibold text-lg lg:text-2xl text-center">Exporter</h1>
                <p class="my-3 text-center text-sm">We export our products to several countries such as France, India,
                    Netherlands, etc.</p>
            </div>
        </div>





    </div>
    {{-- end content --}}
@endsection
