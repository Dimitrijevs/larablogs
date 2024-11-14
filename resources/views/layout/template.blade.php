<!DOCTYPE html>
<html lang="en" class="light">

<head>
    @include('layout.head')
</head>

<body class="bg-red w-100">
    @include('components.shared.notification')
    
    <div id="app" class="sm:w-4/5 mx-auto bg-white sm:my-10 sm:shadow-lg sm:rounded-2xl px-10 py-5">
        @include('layout.nav')

        @yield('content')

        @include('layout.footer')
    </div>

    @stack('scripts')
</body>

</html>
