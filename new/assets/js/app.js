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


document.onmousedown=disableclick;

$('#searchModal').on('shown.bs.modal', function () {
  $('#searchItem').focus()
})

    $('#showSearchModel').on('click',function(){
        $('#searchItem').focus();
    });

    $("#searchItem").on('keyup', function (e) {
        if (e.keyCode == 13) {
            doSearch();
        }
    });
        
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
    
    $(".shopping_cart_show").click(function(){
        window.location.href = path+"cart";
    });
    
    $(".home_show").click(function(){
        window.location.href = path;
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
  $("#success-alert").hide();
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
                        //$("#shopping_cart .badge").html(j.cnt + (j.cnt!=1?" items":" item") + " @ " + j.price);
                        $(".shopping_cart").html(j.cnt);
                        //cart.restart();
                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                            $("#success-alert").slideUp(500);
                        });
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
    
    var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    hh = (h-60)+"px";      
    $("#modelmiddle2").css("height", hh);
    
    
    
});

function modalPlay(s) {
        if(s == "hide") {
            $('#modeltop').hide();
            $('body').css("overflow", "auto");
        } else {



            $('#modeltop').show();
            $('body').css("overflow", "hidden");

            var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
            hh = (h-60)+"px";      
            $("#modeltop #modelmiddle").css("height", hh);
        }
    }
    function go(url) {
        window.location.href= url;
    }

    function go64(url) {
        go(path+"product/"+Base64.decode(url).replace(new RegExp("#", 'g'),"/"));
    }

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


function go(url) {
    window.location.href = url.toLowerCase();
}

function doSearch() {
    url = path + "product?search=" + $("#searchModal #searchItem").val();
    window.location.href = url;
}

function disableclick(event)
{
  if(event.button==2)
   {
     alert("Right Click Disabled");
     return false;    
   }
}