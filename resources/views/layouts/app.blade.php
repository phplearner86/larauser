<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('partials.top._header')
    @yield('links')
</head>
<body>
    <div id="app">
        
        @include('partials.top._nav')

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    @include('partials.bottom._footer')
    @include('partials.bottom._scripts')
    @yield('scripts')
</body>
</html>
