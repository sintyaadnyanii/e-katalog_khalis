{{-- <div class="fixed top-4 right-4 flex items-center justify-center z-[999999] bg-white text-white font-bold rounded-lg border shadow-lg px-4 py-4 w-3/4 lg:w-[400px]" id="alert">
    <button class="absolute top-2 right-2" onclick="btnClose()"><i data-lucide="x" class="text-slate-500"></i></button>
    <div class="flex items-center gap-2 w-full">
        <i class="text-success w-10 h-10 stroke-[3px]" data-lucide="check-circle"></i>
        <div class="w-4/5 flex flex-col text-left">
            <p class="text-lg text-success font-bold">Congratulation!</p>
            <p class="text-sm text-slate-500 font-normal">{!! session()->get('success') !!}</p>
        </div>
    </div>
</div> --}}
<div id="alert" class="fixed inset-0 flex items-center justify-center z-[9999]">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="bg-white rounded-lg shadow-lg p-8 relative w-[70%] md:w-[50%] lg:w-[30%]">
        <button class="absolute top-2 right-3 text-center" onclick="btnClose()">
            <i data-lucide="x" class="text-slate-500 hover:text-red-500"></i>
        </button>
        <div class="flex flex-col items-center justify-center my-5 px-2">
            <i class="text-success w-16 h-16 stroke-[3px]" data-lucide="check-circle"></i>
            <h3 class="text-lg md:text-xl font-bold my-2 text-success text-center">Congratulation!</h3>
            <p class="text-sm md:text-base text-slate-600 font-normal text-center">{!! session()->get('success') !!}</p>
        </div>

    </div>
</div>
