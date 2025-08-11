<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
</head>

<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white shadow fixed top-0 w-full z-50">
        @include('includes.header')
    </header>

    @include('modals.loginModal')
    @include('modals.registerModal')

    <div id="app" class="@yield('app-container-class', 'w-full max-w-[1140px] mx-auto mt-24')">@yield('content')</div>

    <footer class="bg-gray-200 py-12">@include('includes.footer')</footer>
</body>

</html>
