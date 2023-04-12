<div class="alert" id="alert">
    <div class="alert-container">
        <button class="absolute top-2 right-2" onclick="btnClose()"><i data-lucide="x" class="text-slate-500"></i></button>
        <div class="flex flex-col justify-center items-center">
            <div class="mb-3">
                <i class="h-14 w-14 text-amber-400 text-lg stroke-[3px]" data-lucide="alert-octagon"></i>
            </div>
            <div class="text-center">
                <p class="text-lg text-amber-400 font-bold">Warning!</p>
                <p class="text-sm text-slate-500 font-normal">{!! session()->get('warning') !!}</p>
            </div>
        </div>

    </div>
</div>
