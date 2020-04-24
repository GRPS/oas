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

var xsbrand;
var xstype;
    
$(document).ready(function(){

    var radio_button = $("#left-menu input[name=opts]:checked");
    radio_button.parent().scrollTop(radio_button[0].offsetTop);
    
    xsbrand = $("select#xs-brand");
    xstype = $("select#xs-type");
    
    xsbrand.on('change', function() {
        $("option", xstype).hide();
        xstype.find('option.'+this.value).show();
    });
    
    $("#xsgo").click(function(){
        f = family.toLowerCase();
        
        b = Base64.decode(xstype.find('option:selected').attr('class'));
        b = (b === "all" ? "" : "/"+b.replace("#", "=").toLowerCase());
        
        t = xstype.find('option:selected').text();
        t = (t == "all" ? "" : "/"+t.toLowerCase());

        url = path + "product/" + f + b + t;
        window.location.href = url;
    });
    
});

