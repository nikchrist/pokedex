<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./app.css" />
    <title>My Pokemons</title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="menu">
                <div class="menu-item">
                    <a href="{{ URL::to('/') }}">HOME</a>
                </div>
                <div class="menu-item">
                    <a href="{{ URL::to('/wishlist') }}">WISHLIST</a>
                </div>
            </div>
        </nav>
    </header>
    <div id="scroll-up">&uarr;</div>
    <div id="data">
        {{ $content }}
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('body').on('click', '.wishlist', function() {
                event.preventDefault();
                var wishlist = $(this).attr('data-id');
                wishlistOn(wishlist);
            });
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

        function wishlistOn(wishlist) {
            url = '/wishlist/' + wishlist;
            $.ajax({
                url: url,
                type: 'POST',
                success: function(response) {
                    currentpage = $('.page-item.active .page-link').text();
                    newurl = '/?page=' + currentpage;
                    console.log(response);
                    location.replace(newurl);
                }
            });
        }

        function fetchDataperPage(page) {
            let url = '/?page=' + page;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                success: function(data) {
                    $('#data').empty().html(data.html);
                    $('.pagination a').css({
                        'background': 'transparent'
                    });
                },
                error: function(jqXHR,exception){
                    console.log(exception);
                }
            });
        }

        $(window).scroll(function() {

            // Show button after 100px
            if ($(this).scrollTop() > 100) {
                $('#scroll-up').fadeIn();
            } else {
                $('#scroll-up').fadeOut();
            }
        });

        // Click event to scroll to top
        $('#scroll-up').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
        });
    </script>
</body>

</html>
