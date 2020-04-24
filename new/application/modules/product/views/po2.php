<?php if($product->speed_price > 0): ?>
<div class="container">
<div class="row">
<div class="col-md-8 bs-callout bs-callout-info" role="alert">

    <p><small>Select an item to buy then press the buy button.</small></p>

    <hr>
    
    <span class="po2">
        <?php foreach($prodsizes as $ps): ?>
        <button type="button" class="btn btn-default mts" data-o="<?=rawurlencode('{"id": "'.$product->id.'", "po": "'.$product->priceoption.'", "price": '.$ps->price.', "title": "'.  strip_tags($product->title).'", "description": "'.$ps->description.'"}')?>"><span class="price"> <?=fp($ps->price)?></span> <?=$ps->description?></button>
        <?php endforeach; ?>
    </span>

    <hr>
    
    <h5>Ref # <?=$product->id?></h5>
    <h5>Price: <span class="product-price"><?=fp($product->speed_price)?></span></h5>
    
    <button class="btn-block btn btn-success poull-left mts buy"><i class="glyphicon glyphicon-shopping-cart"></i> Buy</button>
    <?php $this->load->view('shared/popup_alert'); ?>
    
</div>
</div>
</div>
<?php endif; ?>