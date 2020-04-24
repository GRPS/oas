<?php if($product->price > 0): ?>

<div class="alert alert-info" role="alert">

    <h4>Add to your shopping cart</h4>   
    <hr>    
    <button class="btn btn-success buy" data-o="<?=rawurlencode('{"id": "'.$product->id.'", "po": "'.$product->priceoption.'", "price": '.$product->price.', "title": "'.str_replace("\\'", "", strip_tags($product->title)).'"}');?>"><i class="glyphicon glyphicon-shopping-cart"></i> Buy</button>    

</div>

<?php endif; ?>