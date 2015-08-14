<!DOCTYPE html>
<html>
    <head>

        <title>Goldenfingers - @yield("title", "Default")</title>
        <link rel="stylesheet" href="/css/foundation.min.css" />
        <link rel="stylesheet" href="/css/main.css" />
        <link rel="stylesheet" href="/css/foundation-icons.css" />
        <script src="/js/vendor/modernizr.js"></script>
    </head>

    <body>
        @yield("content")

        @section("scripts")
            <script src="/js/vendor/jquery.js"></script>
            <script src="/js/foundation.min.js"></script>
            <script>
            $(document).foundation();
            </script>
        @show
    </body>
</html>
