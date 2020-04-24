<?php 

//var_dump($breadcrumb); 

if(!isset($breadcrumb->brand)){
    $breadcrumb = array_merge( (array)$breadcrumb, array( '1' => '' ) );
    }
if(!isset($breadcrumb->type)){
    $breadcrumb = array_merge( (array)$breadcrumb, array( '2' => '' ) );
    }
    
//var_dump($breadcrumb); 
//exit();    
?>
<?php //PrintExt($breadcrumb_pickers); ?>

<div class="breadcrumb mt">

    <a id="productMenuMenu" class="btn btn-default" title="Open menu." href="#menu">&#9776; Menu</a>
    
    <span id="productMenuOptions">
        <span class="productMenuSpan"><select style="margin-top:10px;" id="selectpicker_family" class="selectpicker show-tick family" data-width="auto" name="menu_select" data-size="10">
        <?php foreach($breadcrumb_pickers->family as $family): ?>
            <option<?=($family == $breadcrumb[0]?" selected":"")?>><?=$family?></option>
        <?php endforeach; ?>
        </select></span>

        <span class="productMenuSpan"><select style="margin-top:10px;"  id="selectpicker_brand" class="selectpicker show-tick brand" data-width="auto" name="menu_select" data-size="10">
            <option<?=(isset($breadcrumb[1])?"":" selected")?>>All</option>
            <?php 
            foreach($breadcrumb_pickers->play->brand as $brand): 
            $v = explode("@", $brand);    
            ?>
            <option data-family="<?=$v[0]?>" 
                    class="<?=($v[0] == $breadcrumb[0]?"":"hide")?>"
                    <?=(isset($breadcrumb[1]) && ($v[1] == $breadcrumb[1])?" selected":"")?>
                    ><?=$v[1]?></option>
            <?php endforeach; ?>
        </select></span>

        <?php //if(isset($breadcrumb[1])): ?>
        <span class="productMenuSpan"><select style="margin-top:10px;"  id="selectpicker_type" class="selectpicker show-tick type" data-width="auto" name="menu_select" data-size="10">
            <option<?=(isset($breadcrumb[2])?"":" selected")?>>All</option>
            <?php 
            foreach($breadcrumb_pickers->play->type as $brand): 
            $v = explode("@", $brand);    
            ?>
            <option data-family="<?=$v[0]?>" data-brand="<?=$v[1]?>" 
                    class="<?=($v[0] == $breadcrumb[0] && $v[1] == $breadcrumb[1]?"":"hide")?>"
                    <?=(isset($breadcrumb[2]) && ($v[2] == $breadcrumb[2])?" selected":"")?>
                    ><?=$v[2]?></option>
            <?php endforeach; ?>
        </select></span>
        <?php //endif; ?>
        <button id="productMenuGo" type="button" class="btn btn-default btn-success">Go</button>
    </span>
</div>

<?php if($description != ""):?>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <?=$description?>
    </div>
<?php endif; ?>

<?php if(!empty($interest)):?>
<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <p class="mbn"><strong>Pages of interest ...</strong></p>
    <?php foreach($interest as $i):?>
    <p><a href="<?=base_url(strtolower($i->url))?>" title="<?=$i->id?>"><?=$i->id?></a></p>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<p><?=$product_msg['msg']?></p>

<div class="pt" style="background-color:#C3C5C7; overflow:auto;">

<?php 

    $started_poa = false;

    foreach($products as $product): 
    
        $id1 = $product->id."~".$product->priceoption."~".str_replace(",","",$product->price);
        $id2 = base64_encode($product->id)."~".$product->priceoption."~".str_replace(",","",$product->speed_price);

        if($product->speed_price == 0 && $started_poa==false): 
            $started_poa = true;    
?>

    </div>

<div class="alert alert-danger mt" role="alert">Price On Application and Sold Items</div>
<div class="pt" style="background-color:#C3C5C7; overflow:auto;">
<?php endif; ?>

<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 panel-product" id="<?=$id2?>" <?=(isset($product->error)?" style=\"background-color:red;\"":"")?>>
    <div class="panel panel-default">
        <div class="panel-body" style="cursor:finger;" alt="Find out more." onclick="window.location.href='<?=base_url('product?id='.$product->id)?>';">
            <span style="position:absolute; right:10px; top:-5px;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            <a href="<?=base_url('product?id='.$product->id)?>" title="Find out more."><img src="<?=$thumb.$product->thumbnail?>" alt="<?=$product->id?>"/></a>
            <?php if(!$started_poa): ?>
                <p class="text-center price"><?=($product->speed_price==0?"POA":$product->pricetxt."&nbsp;".fp($product->speed_price))?></p>
            <?php endif; ?>
            <p class="info"><?=strip_tags($product->title)?></p>
        </div>
        <?php if(!$started_poa): ?>
        <div class="panel-footer" style="overflow:auto;">
            <p class="btn visible-xs pln prn text-center">
                <a class="btn btn-info visible-xs pull-left" href="<?=base_url('product?id='.$product->id)?>" title="Find out more."><span class="glyphicon glyphicon-info-sign"></span> Info</a>
                <?php if($product->speed_price > 0): ?>
                    <?php if($product->priceoption == 1): ?>
                    <a class="btn btn-success pull-right" href="<?=base_url('product?id='.$product->id)?>" title="Add item to shopping cart."><span class="glyphicon glyphicon-shopping-cart"></span> Buy</a>
                    <?php elseif($product->priceoption == 2): ?>
                    <a class="btn btn-primary pull-right" href="<?=base_url('product?id='.$product->id)?>" title="Design this item to meet your requirements."><span class="glyphicon glyphicon-chevron-right"></span> Options</a>
                    <?php else: ?>
                    <a class="btn btn-primary pull-right" href="<?=base_url('product?id='.$product->id)?>" title="Design this item to meet your requirements."><span class="glyphicon glyphicon-chevron-right"></span> Design</a>
                    <?php endif; ?>
                <?php endif; ?>                
            </p>
            <p class="btn hidden-xs pln prn text-center">
                <?php if($product->speed_price > 0): ?>
                    <?php if($product->priceoption == 1): ?>
                    <a class="btn btn-sm btn-success pull-right" href="<?=base_url('product?id='.$product->id)?>" title="Add item to shopping cart."><span class="glyphicon glyphicon-shopping-cart"></span> Buy</a>
                    <?php elseif($product->priceoption == 2): ?>
                    <a class="btn btn-sm btn-primary pull-right" href="<?=base_url('product?id='.$product->id)?>" title="Design this item to meet your requirements."><span class="glyphicon glyphicon-chevron-right"></span> Options</a>
                    <?php else: ?>
                    <a class="btn btn-sm btn-primary pull-right" href="<?=base_url('product?id='.$product->id)?>" title="Design this item to meet your requirements."><span class="glyphicon glyphicon-chevron-right"></span> Design</a>
                    <?php endif; ?>
                <?php endif; ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php endforeach; ?>
</div>