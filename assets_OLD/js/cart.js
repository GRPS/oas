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
    
    //Build menu.
    $("nav#menu").mmenu({
        dragOpen: true,
        "counters": true,
        "header": true
    });
    
    //Calculate price with new shipping price.
    $('.selectpicker.calcshipto').selectpicker().change(function(e){
        
        e.preventDefault();
        
        v = $(this).val();
        sp = $("td.subprice").attr("data-value");
        
        t = parseInt(sp) + parseInt(v);
        
        $("td.shipto").attr("data-value", v).html("&pound;"+v);
                
        $("td.totalprice").attr("data-value", t).html("&pound;"+t);
        
    });
    
    //Calculate price with new qty.
    $('.selectpicker.calcqty').selectpicker().change(function(e){
        
        e.preventDefault();
        
        id = $(this).attr("data-id");
        qty = $(this).val();
        key = $(this).attr("data-key");
        
        obj = {"id": id, "qty": qty, "key": key};
        
        $.post( path+"ajax/set_qty", obj )
            .done(function( json ) {
                window.location.href = path+"cart";
            })
            .fail(function(xhr, textStatus, errorThrown) {
                alert(xhr.responseText);
            })
            .always(function() {
                
            }
        );
        
    });
    
});
