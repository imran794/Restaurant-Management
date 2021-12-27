<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
         <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/flexslider.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/pricing.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">

        <!-- Styles -->
      
    </head>
        <body data-spy="scroll" data-target="#template-navbar">

        <!--== 4. Navigation ==-->
     @include('frontend/navbar')


        <!--== 5. Header ==-->
    
     @include('frontend/slider')


        <!--== 6. About us ==-->
       @include('frontend/about')
       
         <!-- /#about -->


        <!--==  7. Afordable Pricing  ==-->
      @include('frontend/pricing')
    


        <!--== 8. Great Place to enjoy ==-->
          @include('frontend/great_place')
                   <!-- /#great-place-to-enjoy -->



        <!--==  9. Our Beer  ==-->
       @include('frontend/beer')
     




        <!--== 10. Our Breakfast Menu ==-->
         @include('frontend/breakfast')
        
        <!-- /#breakfast -->



        <!--== 11. Our Bread ==-->
         @include('frontend/bread')
         




        <!--== 12. Our Featured Dishes Menu ==-->
        @include('frontend/featured_dish')
       
        <!-- /#featured-dish -->




        <!--== 13. Menu List ==-->
       @include('frontend/menu_list')
       



        <!--== 14. Have a look to our dishes ==-->
       @include('frontend/have_a_look')
      



        <!--== 15. Reserve A Table! ==-->
     @include('frontend/table')
  
     
         <!-- /#reserve -->
   @include('frontend/reservation')



   @include('frontend/contact')


   @include('frontend/footer')


    


        <script src="{{ asset('frontend/js/jquery-1.11.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.flexslider.min.js') }}"></script>
        <script type="text/javascript">
            $(window).load(function() {
                $('.flexslider').flexslider({
                 animation: "slide",
                 controlsContainer: ".flexslider-container"
                });
            });
        </script>

        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
            function initialize() {
                var mapCanvas = document.getElementById('map-canvas');
                var mapOptions = {
                    center: new google.maps.LatLng(24.909439, 91.833800),
                    zoom: 16,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var map = new google.maps.Map(mapCanvas, mapOptions)

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(24.909439, 91.833800),
                    title:"Mamma's Kitchen Restaurant"
                });

                // To add the marker to the map, call setMap();
                marker.setMap(map);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>

    
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.mixitup.min.js') }}" ></script>
        <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.validate.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.hoverdir.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jQuery.scrollSpeed.js') }}"></script>
        <script src="{{ asset('frontend/js/script.js') }}"></script>
        

    </body>
</html>
