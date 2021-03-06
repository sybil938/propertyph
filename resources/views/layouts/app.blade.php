<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Property Management PH Solutions') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/colorbox.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">

</head>
<body>    
    @include('sweet::alert')
    
    <div id="app">
        
        <header>
            @include('layouts.nav')
        </header>        

        <main class="py-5">
            <div class="container">
                @include('includes.messages')                
            </div>
            @yield('content')
        </main>

        <footer class="py-5">
            
        </footer>

    </div>

    <!-- Scripts -->    
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>  
    <script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>    
    <script src="{{ asset('js/jquery.colorbox-min.js') }}"></script>
    @yield('scripts')   


</body>
</html>
