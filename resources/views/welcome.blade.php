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
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datetimepicker.min.css') }}">
        <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

        <!-- Styles -->

        <style>

        @foreach ($sliders as $key=> $slider)
  
       .owl-carousel .owl-wrapper, .owl-carousel .owl-item:nth-child({{ $key+ 1 }}) .item
        {
            background: url({{ Storage::disk('public')->url('slider/'.$slider->image) }});
            background-size: cover;
        }
        @endforeach
                    
        </style>


      
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
        <script type="text/javascript" src="{{ asset('frontend/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ asset('frontend/js/script.js') }}"></script>
        <script src="{{ asset('js/iziToast.js') }}"></script>
        @include('vendor.lara-izitoast.toast')


        <script>
            $(function(){
               $('#datetimepicker1').datetimepicker({
                format:       'dd MM yyyy - HH:11 P',
                shwoMeridian:  true,
                autoclose:  true,
                todayBtn:  true,
                });
            })
        </script>
        

    </body>
</html>
