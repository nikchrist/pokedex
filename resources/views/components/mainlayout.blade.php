<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- STYLES -->
    <link rel="stylesheet" href="./app.css" />
    <title>My Pokemons</title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <!-- <div id="scroll-up">&uarr;</div> -->
    <div id="data">
        {{ $content }}
    </div>
    <script>
        $(document).ready(function() {

            $('body').on('click', '.pagination a', function() {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $(this).css({
                    'background': 'red'
                });
                fetchDataperPage(page);
                window.scrollTo(0, 0);
            });
        });

        function fetchDataperPage(page) {
            let url = '/?page=' + page;
            $.ajax({
                url: url,
                success: function(data) {
                    $('#data').html(data);
                    $('.pagination a').css({
                        'background': 'transparent'
                    });
                },
                complete: function(){
                    
                }
            });
        }
    </script>
</body>

</html>
