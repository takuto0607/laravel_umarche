<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          商品詳細
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="md:flex md:justify-around">
                  <div class="md:w-1/2">
                    <x-thumbnail filename="{{$product->imageFirst->filename ?? ''}}" type="products" />
                  </div>
                  <div class="md:w-1/2 ml-4">
                    <h2 class="mb-4 text-sm title-font text-gray-500 tracking-widest">{{ $product->category->name }}</h2>
                    <h1 class="mb-4 text-white text-3xl title-font font-medium">{{ $product->name }}</h1>
                    <p class="mb-4 leading-relaxed">{{ $product->information }}</p>
                    <div class="flex justify-around items-center">
                      <div>
                        <span class="title-font font-medium text-2xl text-white">{{ number_format($product->price) }}</span>
                        <span class="text-sm text-white">円（税込）</span>
                      </div>
                      <div class="flex items-center">
                        <span class="mr-3">数量</span>
                        <div class="relative">
                          <select class="rounded border border-gray-700 focus:ring-2 focus:ring-indigo-900 bg-transparent appearance-none py-2 focus:outline-none focus:border-indigo-500 text-white pl-3 pr-10">
                            <option>SM</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                          </select>
                        </div>
                      </div>
                      <button class="flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">カートに入れる</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
