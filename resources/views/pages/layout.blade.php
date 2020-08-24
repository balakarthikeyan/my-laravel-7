<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    @include('pages.header')
    <!-- push target to head -->
    @stack('styles')
    @stack('scripts')    
</head>
<body class="bg-dark">
    <div class="container">
        @yield('content')
    </div>
    @include('pages.footer')
</body>
</html>