<!DOCTYPE html>
<html class="h-full bg-gray-100">
    <head>
        <meta charset="UTF-8">
        <title>{{ $title ?? ''}}</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text><text y=%221.3em%22 x=%220.2em%22 font-size=%2276%22 fill=%22%23fff%22>sf</text></svg>">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="h-full">

        <!--
          This example requires updating your template:

          ```
          <html class="h-full bg-gray-100">
          <body class="h-full">
          ```
        -->
        <div class="min-h-full">
          <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
              <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                  <div class="shrink-0">
                    <img class="size-8" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                  </div>
                  <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                      <x-nav-link href="{{route('scheduler')}}" :active="Route::is('scheduler')">{{ __('Scheduler')}}</x-nav-link>
                      <x-nav-link href="{{route('witnesses')}}" :active="Route::is('witnesses')">{{ __('Witnesses')}}</x-nav-link>
                      <x-nav-link href="{{route('role.index')}}" :active="Route::is('role.index')">{{ __('Roles')}}</x-nav-link>
                      <x-nav-link href="{{route('about')}}" :active="Route::is('about')">{{ __('About')}}</x-nav-link>
                    </div>
                  </div>
                </div>

                <div class="-mr-2 flex md:hidden">
                  <!-- Mobile menu button -->
                  <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu">
              <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <x-nav-link href="{{route('scheduler')}}" :mobile="true" :active="Route::is('scheduler')">{{ __('Scheduler')}}</x-nav-link>
                <x-nav-link href="{{route('witnesses')}}" :mobile="true" :active="Route::is('witnesses')">{{ __('Witnesses')}}</x-nav-link>
                <x-nav-link href="{{route('role.index')}}" :mobile="true" :active="Route::is('role.index')">{{ __('Roles')}}</x-nav-link>
                <x-nav-link href="{{route('about')}}" :mobile="true" :active="Route::is('about')">{{ __('About')}}</x-nav-link>
              </div>
            </div>
          </nav>

          <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
              <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $title ?? ''}}</h1>
            </div>
          </header>
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
          <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
              {{ $slot }}
            </div>
          </main>
        </div>

  
    </body>
</html>



