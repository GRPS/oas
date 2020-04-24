<?php if($product->speed_price > 0): ?>
<div class="alert alert-info" role="alert">
    <h4>Add to your shopping cart</h4>
    
    <p><small>Select an item to buy then press the buy button.</small></p>

    <hr>
    
    <span class="po2">
        <?php foreach($prodsizes as $ps): ?>
        <button type="button" class="btn btn-default mts" data-o="<?=rawurlencode('{"id": "'.$product->id.'", "po": "'.$product->priceoption.'", "price": '.$ps->price.', "title": "'.  strip_tags($product->title).'", "description": "'.$ps->description.'"}')?>"><span class="price"> <?=fp($ps->price)?></span> <?=$ps->description?></button>
        <?php endforeach; ?>
    </span>

    <hr>
    
    <button class="btn btn-success poull-left mts buy"><i class="glyphicon glyphicon-shopping-cart"></i> Buy</button>

</div>
<?php endif; ?>