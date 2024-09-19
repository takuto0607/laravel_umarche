<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
  <!-- Primary Navigation Menu -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
          <div class="flex">
              <!-- Logo -->
              <div class="shrink-0 flex items-center">
                  <div class="w-12">
                      <a href="{{ route('top.index') }}">
                          <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                      </a>
                  </div>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                  <x-nav-link :href="route('top.items.index')" :active="request()->routeIs('top.items.index')">
                      商品一覧
                  </x-nav-link>
              </div>
          </div>

          <div class="ml-auto sm:flex sm:items-center sm:place-items-end">
            <button onclick="location.href='{{ route('user.login') }}'" class="py-1 px-3 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-300 transition">
              ログイン
            </button>
          </div>
      </div>
  </div>
</nav>
