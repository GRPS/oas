/* Internet Explorer 10 in Windows 8 and Windows Phone 8 */

if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style')
    msViewportStyle.appendChild(
        document.createTextNode(
            '@-ms-viewport{width:auto!important}'
        )
    )
    document.querySelector('head').appendChild(msViewportStyle)
}

$(document).ready(function(){
    
    $('.carousel').carousel({
        interval: 3000
    })
    
    //Build menu.
    $("nav#menu").mmenu({
        dragOpen: true,
        "counters": true,
        "header": true
    });
   
    //Run tour if haven't before.
    tour = new Tour({
        name: "mytour",
        template: "<div class='popover tour'><div class='arrow'></div><h3 class='popover-title' style='background-color:#c4c4c4;'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='btn btn-sm btn-success' data-role='prev'><i class='fa fa-step-backward'></i>Prev</button><span data-role='separator'></span><button class='btn btn-sm btn-success mls mr' data-role='next'><i class='fa fa-step-forward'></i>Next</button></div><div class='popover-navigation' style='float:left;'><button class='btn btn-sm btn-danger mbs' data-role='end'><i class='fa fa-stop'></i>End tour</button></div></nav></div>",
        steps: [
                {
                    element: "a.menu",
                    placement: "bottom",
                    title: "Our menu",
                    content: "Click here and our menu will open."
                }, {
                    element: "#logo",
                    placement: "bottom",
                    title: "Our menu",
                    content: "Click our logo to quickley and easy open our menu."
                }, {
                    element: "#search",
                    placement: "bottom",
                    title: "Search our site.",
                    content: "You can type anything here (product id, words etc) and we'll return relevant results."
                }, {
                    element: "#shopping_cart",
                    placement: "left",
                    title: "Shopping Cart",
                    content: "Here is your shopping cart."
                }
        ]
    }).init().start();
  
    //Prepare cart tour, so when user add items to cart this shows them it has been added.
    cart = new Tour({
        name: "mycart",
        template: "<div class='popover tour' style='z-index:10001'>\n\
                        <div class='arrow'></div>\n\
                        <h3 class='popover-title' style='background-color:#c4c4c4;'></h3>\n\
                        <div class='popover-content'></div>\n\
                        <div class='popover-navigation'>\n\
                            <button class='btn btn-sm btn-success pull-left mbs' data-role='end'>OK</button>\n\
                        </div>\n\
                    </div>",
        backdrop: true,
        steps: [
                {
                    element: "#shopping_cart",
                    placement: "left",
                    title: "Your Shopping Cart",
                    content: "A new item has been added."
                }
        ]
    });

    //Add click even to the tour link in the header.
    $(".restart_tour").click(function(e){
        e.preventDefault();
        tour.restart();
    });
  
    //Add click event to the shopping cart shown in the menu bar.
    $(".show_cart").click(function(e){
        e.preventDefault();
        cart.restart();
    });  
  
    //When select pickers are changed, go get the new price. ONLY FOR PRICE OPTION 3 and 4.
    $('.selectpicker.calcprice').selectpicker().change(function(e){
        
        $("span.price").html(img_wait_small);
        
        e.preventDefault();
        
        info = $("form.config").serializeArray(); //Configuration form.
        item = $(".buy").attr("data-o");          //Item details : MUST CONTAIN ALL DETAILS REQUIRED TO CALCULATE PRICE, TO SAVE PRODUCT LOOKUP AGAIN.

        //Build object to pass to AJAX.
        obj = { 'config': JSON.stringify(info), 'item': item};

        //Calculate price and set UI price and buy data-o using returned object.
        $.post( path+"ajax/get_price", obj )
            .done(function( json ) {

                if (json) {     
                    j = $.parseJSON(json);
                    if(j.price == 0) {
                        $("span.price").html(POA);
                        $(".buy").attr("data-o", "").hide();
                    } else {
                        $("span.price").html(j.price_txt);
                        $(".buy").show();
                    }
                    $(".buy").attr("data-o", encodeURIComponent(JSON.stringify(j)));
                }

            })
            .fail(function(xhr, textStatus, errorThrown) {
                alert(xhr.responseText);
            })
            .always(function() {
                
            }
        );
            
    });    
    
    $("#shopping_cart").click(function(){
        window.location.href = path+"cart";
    });

    //======================================================
    // Apply price option calculations.
    //======================================================
  
    //Apply click event to price option 2 buttons.
    $(".po2 button").click(function(e){

        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        //Put purchase details into buy button.
        $(".buy").attr("data-o", $(this).attr("data-o"));

    });
  
    //======================================================
    // Apply buy button click event.
    //======================================================
  
    //Buy button shows details in it's data-o ready to put in the cart.
    $(".buy").click(function(){
      
        o = $(this).attr("data-o");

        if(o != undefined) {
            
            //obj = JSON.parse(decodeURIComponent(o));
            obj = $.parseJSON(decodeURIComponent(o));
            
            $.post( path+"ajax/save_product_to_cart", obj )
                .done(function( json ) {

                    if (json) {     
                        j = $.parseJSON(json);
                        $("#shopping_cart .badge").html(j.cnt + (j.cnt!=1?" items":" item") + " @ " + j.price);
                        cart.restart();
                    }

                })
                .fail(function(xhr, textStatus, errorThrown) {
                    alert(xhr.responseText);
                })
                .always(function() {

                }
            );

        }
    
    });

});
