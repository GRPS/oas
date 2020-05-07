function zeroPad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
}

function repair() {
    var f = parseInt($("#iStart").val());
    var t = parseInt($("#iEnd").val());
    var n, id;
    id = 1;
    
    for(var i=f; i<t; i++) {
        
        n = zeroPad(i, 4);
        
        $ele = $("#"+id);	
        $(".one", $ele).text(n);
        $(".two", $ele).text(n);
        
        id += 1;
        $ele = $ele.clone().attr("id", id).removeClass('pb').appendTo('body');
        

        if( i % 4 == 3 && id < t ) {
            $ele.addClass('pb');
        }
    }
    
    n = zeroPad(i, 4);
    $ele = $("#"+id);	
    $(".one", $ele).text(n);
    $(".two", $ele).text(n);
        
}