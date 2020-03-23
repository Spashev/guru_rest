<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GuruRestaurant</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <!-- Image and text -->
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
            <img style="border-radius:50%" src="{{ asset('img/logo.jpg') }}" width="40" height="35" class="d-inline-block align-top" alt="">
                GuruRest
            </a>
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="nav-item" href="{{ url('/home') }}">Home</a>
                    @else
                        <a class="nav-item" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a class="nav-item" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>
        <div class="flex-center position-ref full-height">
            
            <div class="container">
                <div class="row">
                    @foreach($restaurants as $restaurant)
                        <div class="col-md-6 pt-3">
                            <div class="card">
                                <img class="p-2 img-thumbnail" src="{{ $restaurant->image }}" alt="картинка ресторана">
                                <div class="card-body">
                                <h5 class="card-title">{{ $restaurant->name }}</h5>
                                <p class="card-text">{{ $restaurant->options }}</p>
                                <p class="card-text">Кухня: {{ $restaurant->cuisine }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="container">
                {{ $restaurants->links() }}
            </div>
        </div>
    </body>
</html>
