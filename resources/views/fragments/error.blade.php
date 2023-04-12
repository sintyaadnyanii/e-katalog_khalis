<div class="alert" id="alert">
    <div class="alert-container">
        <button class="absolute top-2 right-2" onclick="btnClose()"><i data-lucide="x" class="text-slate-500"></i></button>
        <div class="flex flex-col justify-center items-center">
            <div class="mb-3">
                <i class="h-14 w-14 text-red-500 text-lg stroke-[3px]" data-lucide="x-octagon"></i>
            </div>
            <div class="text-center">
                <p class="text-lg text-red-500 font-bold">Oops!</p>
                <p class="text-sm text-slate-500 font-normal">{!! session()->get('error') !!}</p>
            </div>
        </div>

    </div>
</div>
