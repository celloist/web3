<!DOCTYPE html>
<html>
    <head>
        <title>Goldenfinger - @yield("title", "Default")</title>
        <link rel="stylesheet" href="/css/foundation.min.css" />
        <link rel="stylesheet" href="/css/main.css" />
        <script src="/js/vendor/modernizr.js"></script>
    </head>
    <body>
        <div class="container">
            @yield("content")
        </div>

        @section("scripts")
            <script src="/js/vendor/jquery.js"></script>
            <script src="/js/foundation.min.js"></script>
            <script>
            $(document).foundation();
            </script>
        @show
    </body>
</html>
