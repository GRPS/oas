<button type="button" class="btn btn-primary mb mt" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back</button>

<ol class="breadcrumb">

    <li>Ref: <?=$product->id?></li>

    <li>Price: <span class="price"><?=($product->speed_price==0?"POA":$product->pricetxt." ".fp($product->speed_price))?></span></li>

</ol>



<h4><?=str_replace("\\'", "", $product->title);?></h4>



<?=$product->description;?>



<?php $this->load->view($buying)?>
    
<?php if ($images[0] == "NULL"): ?>
<img class="img-responsive" src="<?=$this->config->item('domainPICTURES')?><?=str_replace("t.", ".", $product->thumbnail)?>">    
<?php else: ?>    
<?php foreach($images as $image): ?>
<img class="img-responsive" src="<?=$thumb.trim($image);?>" alt="<?=trim($image)?>">
<?php endforeach; ?>
<?php endif; ?>