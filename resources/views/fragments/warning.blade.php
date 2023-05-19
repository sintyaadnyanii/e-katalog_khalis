<div class="alert-container" id="alert">
    <button class="absolute top-2 right-2" onclick="btnClose()"><i data-lucide="x" class="text-slate-500"></i></button>
    <div class="flex items-center gap-2 w-full">
        <i class="text-amber-400 w-10 h-10 stroke-[3px]" data-lucide="x-octagon"></i>
        <div class="w-4/5 flex flex-col text-left">
            <p class="text-lg text-amber-400 font-bold">Warning!</p>
            <p class="text-sm text-slate-500 font-normal">{!! session()->get('warning') !!}</p>
        </div>
    </div>
</div>
