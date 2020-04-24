<!DOCTYPE html>
<html>
    <head>
        
        <title>Test</title>        
    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="p:domain_verify" content="bb94036334a5f9a64ac7fa85c64abf37"/>

        
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/owl-slider/css/owl.carousel.css')?>">
                    
        <!--[if lt IE 9]>
            <script src="<?=base_url('assets/bootstrap/js/html5shiv.js')?>"></script>
            <script src="<?=base_url('assets/bootstrap/js/respond.min.js')?>"></script>
        <![endif]-->

        
    </head>
    
    <body>
                
        <div id="owl-example" class="owl-carousel">
        <div>Your Content</div>
        <div>Your Content</div>
        <div>Your Content</div>
        <div>Your Content</div>
        <div>Your Content</div>
        <div>Your Content</div>
        <div>Your Content</div>
 
    </div>
 
    
    
        
        
        <script>
            var slider_start=0;
        </script>
        
        <script type="text/javascript" src="http://hammerjs.github.io/dist/hammer.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/owl-slider/js/owl.carousel.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/owl-slider/js/jquery.mousewheel.min.js')?>"></script>       
        <!--<script type="text/javascript" src="<?=base_url('assets/js/slider.js')?>"></script>-->
        
        <script>
    $(document).ready(function() {
 
        $("#owl-example").owlCarousel({
        loop:true,
        lazyLoad:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        autoWidth:true,
        margin:10,
        center: true,
        touchDrag:true,
        startPosition: slider_start,
        responsiveClass:true,
        dots:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:5,
                nav:true,
                loop:false
            }
        }
    });
 
    });
    </script>
    
    </body>
</html>
