<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
</head>

<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white shadow">
        @include('includes.header')
    </header>

    <div id="app">@yield('content')</div>

    <footer class="bg-gray-800 text-white py-8">@include('includes.footer')</footer>
</body>

</html>
