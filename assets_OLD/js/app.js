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

var API;
var cart;

$(document).ready(function(){

    $('#wrap').bind('contextmenu', function(e) {
        return false;
    });
    
    //Hide unwanted pickers.
    if($("#selectpicker_family").val() == "All") {$("#selectpicker_brand, #selectpicker_type").selectpicker('hide');}
    if($("#selectpicker_brand").val() == "All") {$("#selectpicker_type").selectpicker('hide');}
    
    $("#productMenuGo").click(function(){
        family = $("#selectpicker_family");
        brand = $("#selectpicker_brand");
        type = $("#selectpicker_type");
        
        f = family.find(":selected").val();
        b = brand.find(":selected").val();
        t = type.find(":selected").val();
        
        url = path + "product/" + f + (b=="All"?"":"/"+b) + (t=="All"?"":"/"+t);

        window.location.href = url.toLowerCase();
        
    });
    
    $("span#shopping_cart").click(function(){
        window.location.href = path+"cart";
    });
    
    //Build menu.
    $("#menu").mmenu({
        dragOpen: true,
        "counters": true,
        "header": true
    });
    
    API = $("#menu").data( "mmenu" );
    
    $(".open-mmenu").click(function() {
         API.open();
      });
   
    //Run tour if haven't before.
    tour = new Tour({
        name: "mytour",
        template: "<div class='popover tour'><div class='arrow'></div><h3 class='popover-title' style='background-color:#c4c4c4;'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='btn btn-sm btn-success' data-role='prev'><i class='fa fa-step-backward'></i>Prev</button><span data-role='separator'></span><button class='btn btn-sm btn-success mls mr' data-role='next'><i class='fa fa-step-forward'></i>Next</button></div><div class='popover-navigation' style='float:left;'><button class='btn btn-sm btn-danger mbs' data-role='end'><i class='fa fa-stop'></i>End tour</button></div></nav></div>",
        steps: [
                {
                    element: "img.menu",
                    placement: "bottom",
                    title: "Our menu",
                    content: "Click here and our menu will open."
                }, {
                    element: "#logo",
                    placement: "bottom",
                    title: "Our menu",
                    content: "Click our logo to quickly and easy open our menu."
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
  
    $('[name="menu_select"]').selectpicker().change(function(e){
        
        family = $("#selectpicker_family");
        brand = $("#selectpicker_brand");
        type = $("#selectpicker_type");

        id = $(this).attr("id");

        switch (id) {
            case "selectpicker_family" :
                //picker
                //show picker
                //which family to show.
                selectpickerReset(brand, true, family.val(), null);
                selectpickerReset(type, false, null, null);
                break;
            case "selectpicker_brand" :                
                selectpickerReset(type, true, brand.find(":selected").attr("data-family"), brand.val());
                break;
            case "selectpicker_type" :
                
                break;
        }
//        
//       
//        
//       alert($family.val()+" : "+$brand.val()+" : "+$type.val());
        
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

    $('.rating').on('change', function () {
        $(this).next('.label').text($(this).val());
    });
    
    
});


function selectpickerReset(picker, show, ofamily, obrand) {
    
    picker.val(""); //reset selected option.
    $("option", picker).not(":first").addClass("hide");
    if(show) {picker.selectpicker('show')} else {picker.selectpicker('hide');} //hide/show picker.

    if(obrand != null) {
        $("option[data-family='"+ofamily+"'][data-brand='"+obrand+"']", picker).removeClass("hide");
    } else if(ofamily) {
        $("option[data-family='"+ofamily+"']", picker).removeClass("hide");
    }

    if(($("option", picker).length-1) == $("option.hide", picker).length) {
        picker.selectpicker('hide');
    }

    picker.selectpicker('refresh');
}

function updateFacebookButton() {
    var pages = ["about-us","bespoke-jewellery","old-gold","services","valuations","jewellery-insurance","anniversaries","birthstones","zodiac-stones","diamonds","pearls","contact-us"];
    var urlcurl = "http://developers.facebook.com/tools/debug/og/object?scrape=true&q=";        
    $.each( pages, function( i, l ){
        alert( "Index #" + i + ": " + l );
        //window.open(urlcurl+p);
    });
}