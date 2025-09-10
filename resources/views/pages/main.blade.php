<!DOCTYPE html>
<html lang="en" class="dark">
    @include('components.head')
    @yield('head')
<body>
<header class="header">
    @include('components.header')
    @yield('header')
</header>
<main class="main-content">
    @include('components.content')
    @yield('content')
</main>
</body>
</html>

