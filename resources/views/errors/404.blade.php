<!DOCTYPE html>
<html>
    <head>
        <title>#404 Not Found - {{ config('app.name', 'Laravel') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{url('/css/loader.css')}}" rel="stylesheet">
        <link href="{{url('/css/errors.css')}}" rel="stylesheet">
        <link href="{{url('/css/errors-child.css')}}" rel="stylesheet">
        <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
        <script>
            // $(window).load(function() { $("#preloader").fadeOut("slow"); })
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <div id="preloader">
          <div class="loader">
            <div class="text-loading">
            #404 Not Found
            <br><br><br>
            <a href="{{url('home')}}">Back To Home</a>
            </div>
                <svg class="circle-loader" height="50" width="50">
                  <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />
                </svg>
                <img src="{{url('boy05.png')}}" class="loading">
            </div>
        </div>
    </body>
</html>
