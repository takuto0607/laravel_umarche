<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          店舗詳細
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="md:flex md:justify-around">
                  <div class="md:w-1/2">
                    <div class="swiper-slide">
                      @if ($shop->filename !== null)
                        <img src="{{ asset('storage/shops/' . $shop->filename) }}">
                      @else
                        <img src="{{ asset('images/no_image.jpg') }}">
                      @endif
                    </div>
                  </div>
                  <div class="md:w-1/2 ml-4">
                    <h1 class="mb-4 text-white text-3xl title-font font-medium">{{ $shop->name }}</h1>
                    <p class="mb-4 leading-relaxed">{{ $shop->information }}</p>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
