  <div id="alert" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="fixed inset-0 bg-black opacity-50"></div>
      <div class="bg-white rounded-lg shadow-lg p-8 relative w-[70%] md:w-[50%] lg:w-[30%]">
          <button class="absolute top-2 right-3 text-gray-400 hover:text-red-500 text-center" onclick="btnClose()">
              <i class="fa-solid fa-xmark text-2xl"></i>
          </button>
          <div class="flex flex-col items-center justify-center my-5 px-2">
              <i class="fa-regular fa-circle-check text-[#00ccad] text-6xl"></i>
              <h3 class="text-lg md:text-xl font-bold my-2 text-[#00ccad] text-center">Congratulation!</h3>
              <p class="text-sm md:text-base text-slate-600 font-normal text-center">{!! session()->get('success') !!}</p>
          </div>

      </div>
  </div>
