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

var $table;

$(document).ready(function(){

    //Build menu.
    $("nav#menu").mmenu({
        dragOpen: true,
        "counters": true,
        "header": true
    });
    
    

    $('select').selectpicker();

    $('.radioBtn a').on('click', function(){
        var sel = $(this).data('title');
        var tog = $(this).data('toggle');
        $('#'+tog).prop('value', sel);
        $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notactive');
        $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notactive').addClass('active');
    })
    
    //"link image wordcount visualblocks code media table paste textcolor colorpicker textpattern"

    //"link image media code table textcolor colorpicker"

    tinymce.init({
        selector: "textarea:not(#json)", 
        browser_spellcheck : true,
        relative_urls: false,
        resize: true,
        plugins: [
            "table link image media code textcolor"
        ],
        toolbar: "forecolor backcolor"
    });

    $('table.data').bootstrapTable();

    //Get any passed parameters.
    params = get_query_string_params();

    if (params['search'] != undefined) {
        $("div.search input").val(params['search']).focus(); //.trigger(e);
    }

    $(".updateFacebookButton").on('click', function(){
        var pages = ["about-us","bespoke-jewellery","old-gold","services","valuations","jewellery-insurance","anniversaries","birthstones","zodiac-stones","diamonds","pearls","contact-us"];       
        $.each( pages, function( i, p ){
            url = "http://developers.facebook.com/tools/debug/og/object?scrape=true&q=http://www.offordandsons.co.uk/" + p;
            a = window.open(url, 'url_'+i);
        });
    });
    
});

function get_query_string_params() {

    var vars = [], hash;
    var q = document.URL.split('?')[1];
    if(q != undefined){

        q = q.split('&');

        for(var i = 0; i < q.length; i++){
            hash = q[i].split('=');
            vars.push(hash[1]);
            vars[hash[0]] = hash[1];
        }
    }

    return vars;

}

//Delete record code checking.

function checkCode(obj) {   
    code = $("#del button").attr("data-code");
    val = $("#del input").val();
    url = $("#del button").attr("data-url");

    if(code == val) {
        window.location.href = url;
    } else {
        alert("You've entered an incorrect code!");
    }
}

function speedy_prices(url) {
    $("#speedy_prices").html('<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> '+img_wait_small);
    window.location.href = path+url;
}
