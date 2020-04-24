<div class="container">
<div class="row">
<div class="col-md-8 bs-callout bs-callout-info" role="alert">

    <?php if($product->speed_price > 0): ?>
    <p><small>Select an item to buy then press the buy button.</small></p>

    <hr>
    
    <span class="po2">
        <table style="width:100%;">
            <tbody>
                <tr>
                    <?php foreach($prodsizes as $ps): ?>
                    <td class="text-center">
                    <button type="button" class="btn btn-default mts buysize" data-o="<?=rawurlencode('{"id": "'.$product->id.'", "po": "'.$product->priceoption.'", "price": '.$ps->price.', "stock": '.$ps->stock.', "title": "'.  strip_tags($product->title).'", "description": "'.$ps->description.'"}')?>"><span class="price"> <?=fp($ps->price)?></span> <?=$ps->description?></button>
                    </td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach($prodsizes as $ps): ?>
                    <td class="text-center">
                        <?php if($ps->stock == 0): ?>
                        <span class="text-danger">Out of stock</span>
                        <?php endif; ?>
                    </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </span>

    <hr>
    <?php endif; ?>
    
    <h5>Ref # <?=$product->id?></h5>
    
    <?php if($product->speed_price > 0): ?>
        <h5>Prices from: <span class="product-price"><?=fp($product->speed_price)?></span></h5>    
        <button class="btn-block btn btn-success poull-left mts buy"><i class="glyphicon glyphicon-shopping-cart"></i> Buy</button>
        <?php $this->load->view('shared/popup_alert'); ?>
    <?php endif; ?>
        
    <?php $this->load->view('shared/popup_outofstock'); ?>
    
</div>
</div>
</div>