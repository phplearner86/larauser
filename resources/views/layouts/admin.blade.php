<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('partials.top._header')

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    @yield('links')
</head>
<body id="adminBody">
    <div id="app">
        
        @include('partials.admin._nav')

        <main class="container-fluid">
            <div class="row">

                @include('partials.admin._side')
                <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    @yield('content')
                </main>

            </div>
        </main>
    </div>

    <!-- Scripts -->
    @include('partials.bottom._footer')
    @include('partials.bottom._scripts')
    @include('partials.admin._scripts')
    @yield('scripts')
</body>
</html>
