<button type="button" class="btn btn-primary mb mt" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back</button>

<!--<div class="callout-left bs-callout-info" style="margin-bottom:20px;">
    <h1 style="margin-top:0px;">Add to shopping cart</h1>
</div>-->
    
<!--    <p><strong class="col-xs-2 pln">Ref:</strong> <?=$product->id?></p>
    <p><strong class="col-xs-2 pln">Price:</strong> <span class="price"><?=($product->speed_price==0?"POA":$product->pricetxt." ".fp($product->speed_price))?></span></p>-->
        
    <h1 class="mtn"><?=str_replace("\\'", "", $product->title);?></h1>

    <div class="mbs"><?=$product->description;?></div>


<?php $this->load->view($buying)?>
    
<?php if ($images[0] == "NULL"): ?>
<img class="img-responsive" src="<?=$this->config->item('domainPICTURES')?><?=str_replace("t.", ".", $product->thumbnail)?>">    
<?php else: ?>    
<?php foreach($images as $image): ?>
<img class="img-responsive mrs mbs pull-left" src="<?=$thumb.trim($image);?>" alt="<?=trim($image)?>">
<?php endforeach; ?>
<?php endif; ?>