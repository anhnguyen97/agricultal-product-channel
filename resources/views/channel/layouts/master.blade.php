<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agripc</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="description" content="Colo Shop Template"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('admins/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    @yield('css')
    
</head>

<body>

    <div class="super_container">

        @yield('navigation')

        @yield('slider')

        @yield('banner')

        @yield('content')

        @yield('footer')

    </div>

    @yield('js')

</body>

</html>
