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

    var radio_button = $("#left-menu input[name=opts]:checked");
    radio_button.parent().scrollTop(radio_button[0].offsetTop);
    
    
});

