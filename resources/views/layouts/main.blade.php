<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Withdrawal | TB Dashboard</title>

    <link rel="icon" type="image/x-icon" href="/src/assets/img/favicon.ico"/>

    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>  

    @include('layouts.partials.styles')


</head>
<body class="">
    <!-- BEGIN LOADER -->
    @include('layouts.partials.loader')
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('layouts.partials.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('layouts.partials.sidebar')
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            @yield('content')
            
            <!--  BEGIN FOOTER  -->
            @include('layouts.partials.footer')
            <!--  END FOOTER  -->
            <!--  END CONTENT AREA  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    @include('layouts.partials.scripts')


</body>
</html>