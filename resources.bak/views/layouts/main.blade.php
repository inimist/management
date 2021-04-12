<html>
    <head>
        <!--Stylesheet-->
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        @yield('head')
    </head>
    <body>
        @include('layouts.partials.header')
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container body-content">
            @yield('content')
        </div>
        @include('layouts.partials.footer')
    </body>
</html>