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

$(document).ready(function(){
    
    //Build menu.
    $("#menu").mmenu({
        dragOpen: true,
        "counters": true,
        "header": true
    });
    
    API = $("#menu").data( "mmenu" );
    
});
