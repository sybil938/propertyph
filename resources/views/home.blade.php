<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 64px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">


    </head>
    <body>

        <div class="container-fluid">
            <div class="row" style="height: 100px;">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/properties') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>    
        </div>    

        <div class="container">

            <div class="row pb-5"> 
                <div class="col-md-12">
                    <div class="content">
                        <div class="title m-b-md">
                            Property Management PH Solutions
                        </div>

                        <div class="links">
                            <a href="#">About Us</a>
                            <a href="#">Gallery</a>
                            <a href="#">Amenities</a>
                            <a href="#">Contact</a>
                            <a href="#">Map</a>                    
                        </div>
                    </div>
                </div>    
            </div>               
        
            <div class="row pt-5">    
                @if($properties->isNotEmpty())
                    @foreach ($properties as $item)
                        <div class="col-md-4">
                            <div class="card mb-5">
                                <?php
                                    $typeName  = '';
                                    foreach($types as $t) {
                                        if( $item->type == $t->id ) {
                                            $typeName = $t->value;
                                        }
                                    }
                                    $imgArray = json_decode($item->images);
                                    $img = reset($imgArray);
                                    $imgURL = asset('/storage/'. $typeName .'/'. $item->user_id .'/'. $img);  
                                ?>
                                <div 
                                    {{$item->images}}
                                    class="card-img-top" 
                                    style='
                                        with:100%; 
                                        height: 250px; 
                                        background-image: url("{{ $imgURL }}");
                                        background-position: center;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                    ;'
                                    ></div>                          
                                <div class="card-body">
                                    <h4 class="card-title">{{ $item->name }}</h4>
                                    <p class="card-text">{{ $item->ptype->name }}</p>
                                    <a href="{{ url('/properties/'. $item->ptype->value .'/'. $item->id .'/view' ) }}" class="btn btn-primary">view</a>
                                </div>
                            </div>    
                        </div>    
                    @endforeach
                @else
                    @include('dummy.properties')
                @endif
            </div> 
        </div>

    </body>
</html>
