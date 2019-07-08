<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">

    <style>
        #sidebar{
            position: fixed;
            width: 250px;
            top: 0;
            bottom: 0;
            background-color: #E6E9ED;
        }

        .wrapper{
            margin-left: 250px;
        }

    </style>

    @stack('styles')

    <title>JP-FSM | @yield('title')</title>
  </head>
  <body>
    @include('partials.sidebar')
    <div class="wrapper">
        @yield('content')
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
  </body>
</html>