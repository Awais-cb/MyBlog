<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyBlog') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
        @include('includes/navbar')
        <div class="container">
            @include('includes.messages')
            @yield('content')
        </div>
        @include('includes/footer')
   

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */ 
        .navbar {
            border-radius: 0;
        }
        
        /* Add a gray background color and some padding to the footer */
        footer {
          background-color: #f2f2f2;
          padding: 25px;
        }
        
      .carousel-inner img {
          width: 100%; /* Set width to 100% */
          margin: auto;
          min-height:200px;
      }

      /* Hide the carousel text when the screen is less than 600 pixels wide */
      @media (max-width: 600px) {
        .carousel-caption {
          display: none; 
        }
      }
    </style>
</body>
</html>
