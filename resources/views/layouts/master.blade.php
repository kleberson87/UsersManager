<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

        <header class="page-header">
            <h1>@yield('title')</h1>
        </header>

        <nav>
            <div class="container">
                @yield('navigation')
            </div>
        </nav>

        <section class="panel panel-default">
            <div class="panel-body">

                @yield('content')
            </div>
        </section>

    </div>
</body>
</html>