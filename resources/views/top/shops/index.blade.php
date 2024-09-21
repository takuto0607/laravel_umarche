<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      店舗一覧
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="flex flex-wrap">
            @foreach ($shops as $shop)
            <div class="w-1/4 p-2 md:p-4">
              <a href="{{ route('top.shops.show', ['shop' => $shop->id]) }}">
                <div class="border rounded-md p-2 md:p-4">
                  <x-thumbnail filename="{{$shop->filename ?? ''}}" type="products" />
                  <div class="mt-4">
                    <h2 class="title-font text-lg font-medium">{{ $shop->name }}</h2>
                  </div>
                </div>
              </a>
            </div>
            @endforeach
          </div>
          {{ $shops->links() }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
