<!DOCTYPE html>
<html class="h-full bg-gray-100">
    <head>
        <meta charset="UTF-8">
        <title>{{ $title ?? ''}}</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text><text y=%221.3em%22 x=%220.2em%22 font-size=%2276%22 fill=%22%23fff%22>sf</text></svg>">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="h-full">


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
                <x-nav-link href="{{route('roles')}}" :active="Route::is('roles')">{{ __('Roles')}}</x-nav-link>
                <x-nav-link href="{{route('about')}}" :active="Route::is('about')">{{ __('About')}}</x-nav-link>
              </div>
            </div>
          </div>
 
  
      <!-- Mobile menu, show/hide based on menu state. -->
      <div class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
          <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
          <x-nav-link href="{{route('scheduler')}}" :mobile="true" :active="Route::is('scheduler')">{{ __('Scheduler')}}</x-nav-link>
          <x-nav-link href="{{route('witnesses')}}" :mobile="true" :active="Route::is('witnesses')">{{ __('Witnesses')}}</x-nav-link>
          <x-nav-link href="{{route('roles')}}" :mobile="true" :active="Route::is('roles')">{{ __('Roles')}}</x-nav-link>
          <x-nav-link href="{{route('about')}}" :mobile="true" :active="Route::is('about')">{{ __('About')}}</x-nav-link>

          <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Dashboard</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('Scheduler')}}</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('Roles')}}</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('Witnesses')}}</a>
          <a href="{{ route('about') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ __('About')}}</a>
        </div>        
      </div>
    </nav>
  
    <header class="bg-white shadow-sm">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $title ?? 'Page Title'}}</h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}
      </div>
    </main>
  </div>
  
    </body>
</html>
