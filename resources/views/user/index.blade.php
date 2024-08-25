<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      商品一覧
    </h2>
    <form method="get" action="{{ route('user.items.index') }}">
      <div class="lg:flex lg:justify-around">
        <div class="lg:flex items-center">
          <select name="category" class="mb-2 lg:mb-0 lg:mr-2">
            <option value="0" @if(\Request::get('category') === '0') selected @endif>全て</option>
            @foreach ($categories as $category)
              <optgroup label="{{ $category->name }}" class="text-gray-400">
                @foreach ($category->secondary as $secondary)
                  <option value="{{ $secondary->id }}" class="text-gray-800" @if(\Request::get('category') == $secondary->id) selected @endif>
                    {{ $secondary->name }}
                  </option>
                @endforeach
              </optgroup>
            @endforeach
          </select>
          <div class="flex space-x-2 items-center">
            <div><input name="keyword" class="border border-gray-500 py-2" placeholder="キーワードを入力"></div>
            <div><button class="text-white bg-indigo-500 border-0 py-2 px-6 ml-auto focus:outline-none hover:bg-indigo-600 rounded">検索</button></div>
          </div>
        </div>
        <div class="flex text-gray-800 dark:text-gray-200">
          <div>
            <span class="text-sm">表示順</span><br>
            <select class="text-gray-800" name="sort" id="sort" class="mr-4">
              <option class="text-gray-800" value="{{ \Constant::SORT_ORDER['recommend'] }}" @if (\Request::get('sort') === \Constant::SORT_ORDER['recommend']) selected @endif>
                おすすめ順
              </option>
              <option class="text-gray-800" value="{{ \Constant::SORT_ORDER['higherPrice'] }}" @if (\Request::get('sort') === \Constant::SORT_ORDER['higherPrice']) selected @endif>
                料金の高い順
              </option>
              <option class="text-gray-800" value="{{ \Constant::SORT_ORDER['lowerPrice'] }}" @if (\Request::get('sort') === \Constant::SORT_ORDER['lowerPrice']) selected @endif>
                料金の低い順
              </option>
              <option class="text-gray-800" value="{{ \Constant::SORT_ORDER['later'] }}" @if (\Request::get('sort') === \Constant::SORT_ORDER['later']) selected @endif>
                新しい順
              </option>
              <option class="text-gray-800" value="{{ \Constant::SORT_ORDER['older'] }}" @if (\Request::get('sort') === \Constant::SORT_ORDER['older']) selected @endif>
                古い順
              </option>
            </select>
          </div>
          <div>
            <span class="text-sm">表示件数</span><br>
            <select class="text-gray-800" name="pagination" id="pagination">
              <option class="text-gray-800" value="20" @if (\Request::get('pagination') === '20') selected @endif>
                20件
              </option>
              <option class="text-gray-800" value="50" @if (\Request::get('pagination') === '50') selected @endif>
                50件
              </option>
              <option class="text-gray-800" value="100" @if (\Request::get('pagination') === '100') selected @endif>
                100件
              </option>
            </select>
          </div>
        </div>
      </div>
    </form>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="flex flex-wrap">
            @foreach ($products as $product)
            <div class="w-1/4 p-2 md:p-4">
              <a href="{{ route('user.items.show', ['item' => $product->id]) }}">
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
          {{ $products->appends(['sort' => \Request::get('sort'), 'pagination' => \Request::get('pagination')])->links() }}
        </div>
      </div>
    </div>
  </div>

  <script>
    const select = document.getElementById('sort')
    select.addEventListener('change', function () {
      this.form.submit()
    })

    const paginate = document.getElementById('pagination')
    paginate.addEventListener('change', function () {
      this.form.submit()
    })
  </script>
</x-app-layout>
