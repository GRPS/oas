
var owl;

$(document).ready(function(){
   
    owl = $('.owl-carousel');
    owl.owlCarousel({        
        autoPlay: 6000,
        slideSpeed : 500,
        paginationSpeed : 500,
        singleItem:true,
        lazyLoad:true,
        stopOnHover:true,
        goToFirstSpeed:2000,
        
        
      });

      // Custom Navigation Events
      $(".next").click(function(){owl.trigger('owl.next');})
      $(".prev").click(function(){owl.trigger('owl.prev');})
      $(".play").click(function(){owl.trigger('owl.play',6000);})
      $(".stop").click(function(){owl.trigger('owl.stop');})
    
});
