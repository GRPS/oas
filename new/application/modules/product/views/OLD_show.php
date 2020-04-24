<ol class="breadcrumb">
    <!--<li><a onclick='$("#menu").trigger("open.mm");'><?=$title;?></a></li>-->
    <li><?=$title;?></li>
    <?php foreach($breadcrumb as $bread): ?>
    <li><?=$bread?></li>
    <?php endforeach; ?>
</ol>


<?php if($description != ""):?>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <?=$description?>
    </div>
<?php endif; ?>

<?php if(!empty($interest)):?>
<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <p class="mb"><strong>Pages of interest ...</strong></p>
    <?php foreach($interest as $i):?>
    <p><a href="<?=base_url(strtolower($i->url))?>" title="<?=$i->id?>"><?=$i->id?></a></p>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<p><?=$product_msg['msg']?></p>

<?php 

    $started_poa = false;

    foreach($products as $product): 
    
        $id1 = $product->id."~".$product->priceoption."~".str_replace(",","",$product->price);
        $id2 = base64_encode($product->id)."~".$product->priceoption."~".str_replace(",","",$product->speed_price);

        if($product->speed_price == 0 && $started_poa==false): 
            $started_poa = true;    
?>

<div class="alert alert-warning" role="alert">Price On Application and Sold Items</div>
<?php endif; ?>

<!--<div class="well well-sm product" id="<?=$id2?>" title="<?=$id1.(isset($product->error)?" ERROR: ".$product->error:"")?>"<?=(isset($product->error)?" style=\"background-color:red;\"":"")?>>-->
<div class="well well-sm product" id="<?=$id2?>" title="Find out more about this item."<?=(isset($product->error)?" style=\"background-color:red;\"":"")?>>
    
    <a href="<?=base_url('product?id='.$product->id)?>" title="Find out more."><img src="<?=$thumb.$product->thumbnail?>" alt="<?=$product->id?>"/></a>
    <p class="text-center price"><?=($product->speed_price==0?"POA":$product->pricetxt."&nbsp;".fp($product->speed_price))?></p>
    <p class="info"><?=strip_tags($product->title)?></p>
    <p class="btn">
        <a class="btn btn-xs btn-default pull-left" href="<?=base_url('product?id='.$product->id)?>" title='Find out more.'>Info</a>
        
        <?php if($product->speed_price > 0): ?>
            <?php if($product->priceoption == 1): ?>
            <!--<a class="btn btn-xs btn-info pull-right" href="<?=base_url('product?id='.$product->id)?>" title="Add item to shopping cart."><span class="glyphicon glyphicon-shopping-cart"></span></a>-->
            <a class="btn btn-xs btn-success pull-right" href="<?=base_url('product?id='.$product->id)?>" title="Add item to shopping cart."><span class="glyphicon glyphicon-shopping-cart"></span> Buy</a>
            <?php else: ?>
            <!--<a class="btn btn-xs btn-info pull-right" href="<?=base_url('product?id='.$product->id)?>" title="Configure this item."><span class="glyphicon glyphicon-wrench"></span></a>-->
            <a class="btn btn-xs btn-primary pull-right" href="<?=base_url('product?id='.$product->id)?>" title="Design this item to meet your requirements.">Design</a>
            <?php endif; ?>
        <?php endif; ?>
    </p>
    
</div>

<?php endforeach; ?>
