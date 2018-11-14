<!DOCTYPE html>
<html lang="ko">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('head')
</head>
<body>
    @yield('header-top')

    @yield('mainContent')   {{-- bodyContent --}}
    @yield('chatsContent')
    @yield('boardContent')
    @yield('findContent')
    @yield('moreContent')

    @yield('writeForm')

    @yield('login')
    @yield('registerFormContent')
    @yield('nav-bottom')
</body>
</html>