<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>

        <div class="container">
            @yield('content')
        </div>

    <script src="/js/app.js"></script>
    </body>
</html>