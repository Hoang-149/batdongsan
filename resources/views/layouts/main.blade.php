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

    <div id="loadingSpinner" class="hidden fixed inset-0 bg-gray-900 bg-opacity-40 flex items-center justify-center z-50">
        <div class="w-12 h-12 border-4 border-white border-t-transparent rounded-full animate-spin">
        </div>
    </div>

    <div id="app" class="@yield('app-container-class', 'w-full max-w-[1140px] mx-auto mt-24')">@yield('content')</div>

    <footer class="bg-gray-200 py-12">@include('includes.footer')</footer>
</body>

</html>
