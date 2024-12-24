@extends('project.layouts.default.baseof')
@section('main')
@vite(['resources/css/app.css','resources/js/app.js'])
    @include('project.layouts.partials.navbar-dashboard')
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

            @include('project.layouts.partials.sidebar_staff')

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
          <main>
            @yield('content')
          </main>
              @include('project.layouts.partials.footer-dashboard')
        </div>
    </div>
@endsection
