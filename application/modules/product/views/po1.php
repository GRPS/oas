<div class="container">
<div class="row">
<div class="col-md-6 bs-callout bs-callout-info" role="alert">
  
    <h5>Ref # <?=$product->id?></h5>
    
    <?php if($product->price > 0): ?>
        <h5>Price: <span class="product-price"><?=fp($product->speed_price)?></span></h5>
        <button class="btn-block btn btn-success buy" data-o="<?=rawurlencode('{"id": "'.$product->id.'", "po": "'.$product->priceoption.'", "price": '.$product->price.', "title": "'.str_replace("\\'", "", strip_tags($product->title)).'"}');?>"><i class="glyphicon glyphicon-shopping-cart"></i> Buy</button>    
        <?php $this->load->view('shared/popup_alert'); ?>
    <?php endif; ?>
        
</div>
</div>    
</div>
