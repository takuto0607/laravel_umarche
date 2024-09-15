<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <div class="flex title-font font-medium items-center mb-4 md:mb-0 text-gray-800 dark:text-gray-200">
      <div class="w-16">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
      </div>
      <span class="ml-2 text-3xl">Umarche</span>
    </div>
    <form method="get" action="{{ route('user.items.index') }}" class="ml-5">
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
          <div><input name="keyword" class="w-80 border border-gray-500 py-2" placeholder="キーワードを入力"></div>
          <div><button class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">検索</button></div>
        </div>
      </div>
    </form>
    <div class="ml-auto sm:flex sm:place-items-end">
      <button onclick="location.href='{{ route('user.login') }}'" class="py-1 px-3 text-lg font-bold tracking-wider text-gray-800 dark:text-gray-200 dark:hover:text-gray-500 transition">
        ログイン
      </button>
      <button onclick="location.href='{{ route('user.login') }}'" class="py-1 px-3 text-gray-800 dark:text-gray-200 dark:hover:text-gray-500 transition">
        <svg class="fill-current h-8 w-98 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
          <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
      </button>
    </div>
  </div>
</nav>
