<x-app-layout :categories="$categories">
  <div class="widget">
    <!-- Slider main container -->
    <div class="swiper-container z-0">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <!-- Slides -->
            <img src="{{ asset('images/widget1.jpg') }}">
        </div>
        <div class="swiper-slide">
          <!-- Slides -->
            <img src="{{ asset('images/widget2.jpg') }}">
        </div>
        <div class="swiper-slide">
          <!-- Slides -->
            <img src="{{ asset('images/widget3.jpg') }}">
        </div>
        <div class="swiper-slide">
          <!-- Slides -->
            <img src="{{ asset('images/widget4.jpg') }}">
        </div>
        <div class="swiper-slide">
          <!-- Slides -->
            <img src="{{ asset('images/widget5.jpg') }}">
        </div>
        <div class="swiper-slide">
          <!-- Slides -->
            <img src="{{ asset('images/widget6.jpg') }}">
        </div>
      </div>
    
      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev top-swiper-button"></div>
      <div class="swiper-button-next top-swiper-button"></div>
    
      <!-- If we need scrollbar -->
      <div class="swiper-scrollbar"></div>
    </div>
  </div>
  <div class="py-8">
    <div class="max-w-7xl mx-auto">
      <div class="flex">
        <div class="side-navi basis-2/12 mr-4 border-r dark:border-white">
          <section class="px-4 pt-8">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
              カテゴリー
            </h2>
            <div>
              @foreach ($categories as $category)
                  <div class="my-2">
                    <p class="font-medium text-sm text-gray-800 dark:text-gray-200 leading-tight">
                      {{ $category->name }}
                    </p>
                  </div>
                  @foreach ($category->secondary as $secondary)
                  <div class="mb-1 pl-4">
                    <a href="{{ route('top.items.index', ['category' => $secondary->id]) }}" class="text-sm text-gray-800 dark:text-gray-200 dark:hover:text-gray-500 leading-tight">
                      ・ {{ $secondary->name }}
                    </a>
                  </div>
                  @endforeach
              @endforeach
            </div>
          </section>
          <div class="mx-2 mt-4 border-t dark:border-white"></div>
          <section class="px-4 pt-4">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
              店舗
            </h2>
            <div class="mt-2">
              @foreach ($shops as $shop)
              <div class="mb-1">
                <a href="{{ route('top.shops.show', ['shop' => $shop->id]) }}" class="text-sm text-gray-800 dark:text-gray-200 dark:hover:text-gray-500 leading-tight">
                  {{ $shop->name }}
                </a>
              </div>
              @endforeach
            </div>
          </section>
        </div>
        <div class="main basis-10/12 ml-4">
          <section>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              商品一覧
            </h2>
            <div class="text-gray-900 dark:text-gray-100">
              <div class="flex flex-wrap">
                @foreach ($products as $product)
                <div class="w-1/4 p-2 md:p-4">
                  <a href="{{ route('top.items.show', ['item' => $product->id]) }}">
                    <div class="border rounded-md p-2 md:p-4">
                      <x-thumbnail filename="{{$product->filename ?? ''}}" type="products" />
                      <div class="mt-4">
                        <h3 class="text-xs tracking-widest title-font mb-1">{{ $product->category }}</h3>
                        <h2 class="title-font text-lg font-medium">{{ $product->name }}</h2>
                        <p class="mt-1">{{ number_format($product->price) }}<span class="text-sm"> 円（税込）</span></p>
                      </div>
                    </div>
                  </a>
                </div>
                @endforeach
              </div>
            </div>
            <div class="mt-1 text-right">
              <a href="{{ route('top.items.index') }}" class="text-gray-800 dark:text-gray-200 dark:hover:text-gray-500 leading-tight">もっと見る＞</a>
            </div>
          </section>
          <section class="mt-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              おすすめ商品
            </h2>
            <div class="text-gray-900 dark:text-gray-100">
              <div class="flex flex-wrap">
                @foreach ($recomends as $recomend)
                <div class="w-1/4 p-2 md:p-4">
                  <a href="{{ route('top.items.show', ['item' => $recomend->id]) }}">
                    <div class="border rounded-md p-2 md:p-4">
                      <x-thumbnail filename="{{$recomend->filename ?? ''}}" type="products" />
                      <div class="mt-4">
                        <h3 class="text-xs tracking-widest title-font mb-1">{{ $recomend->category }}</h3>
                        <h2 class="title-font text-lg font-medium">{{ $recomend->name }}</h2>
                        <p class="mt-1">{{ number_format($recomend->price) }}<span class="text-sm"> 円（税込）</span></p>
                      </div>
                    </div>
                  </a>
                </div>
                @endforeach
              </div>
            </div>
          </section>
          <section class="mt-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              店舗一覧
            </h2>
            <div class="text-gray-900 dark:text-gray-100">
              <div class="flex flex-wrap">
                @foreach ($shops as $shop)
                <div class="w-1/4 p-2 md:p-4">
                  <a href="{{ route('top.shops.show', ['shop' => $shop->id]) }}">
                    <div class="border rounded-md p-2 md:p-4">
                      <x-thumbnail filename="{{$shop->filename ?? ''}}" type="shops" />
                      <div class="mt-4">
                        <h2 class="title-font text-lg font-medium">{{ $shop->name }}</h2>
                      </div>
                    </div>
                  </a>
                </div>
                @endforeach
              </div>
            </div>
            <div class="mt-1 text-right">
              <a href="{{ route('top.shops.index') }}" class="text-gray-800 dark:text-gray-200 dark:hover:text-gray-500 leading-tight">もっと見る＞</a>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/swiper.js') }}"></script>
</x-app-layout>
