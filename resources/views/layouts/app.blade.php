<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body class="font-sans antialiased">

    @include('layouts.header')
        <!-- Page Content -->
    @yield("content")

    @include("layouts.footer")
    @include("layouts.scripts")
    @yield("javascript")

</body>
</html>
