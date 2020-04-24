<div class="callout-left bs-callout-info" style="margin-bottom:20px;">
    <h1><?=$title;?></h1>
</div>

<?php if(empty($cart)): ?>

<div class="alert alert-info" role="alert">
    <span class="glyphicon glyphicon-flash"></span> Your shopping cart is empty.
</div>

<?php else: ?>

<?php 
    $total = 0;
    foreach($cart as $i => $c): 
        $total += $c->price;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?=strip_tags(stripslashes(str_replace("\\", "", $c->title)))?></h3>
    </div>
    <div class="panel-body">
        <a class="pull-left" href="<?=base_url('product/search?id='.$c->id)?>" alt="<?=$c->id?>" title='Click to view product.'><img src="<?=$thumb.$c->thumbnail?>" width="100" alt="<?=$c->id?>"></a>
        <div class="pull-right">
            <p class="text-right">
                <?=fp($c->unitprice)?> ea.
            </p>
            <p>
                <select class="selectpicker calcqty show-tick qty mbn" data-width="130px" name="qty" data-id="<?=$c->id?>"  data-key="<?=$c->key?>">
                    <option value="0">Remove Item</option>
                    <option value="1"<?=($c->qty==1?" selected":"")?>>Qty: 1</option>
                    <option value="2"<?=($c->qty==2?" selected":"")?>>Qty: 2</option>
                    <option value="3"<?=($c->qty==3?" selected":"")?>>Qty: 3</option>
                    <option value="4"<?=($c->qty==4?" selected":"")?>>Qty: 4</option>
                    <option value="5"<?=($c->qty==5?" selected":"")?>>Qty: 5</option>
                </select>
            </p>
            <p class="text-right product-price">
                <?=fp($c->price)?>
            </p>
        </div>
    </div>
    <div class="panel-footer">
        <small class='text-muted'>
            <?=$c->key?>
        </small>
    </div>
</div>

<?php endforeach; ?>

<div class="panel panel-default">
    <div class="panel-body text-right">
        <p>
            <strong class="mr">Sub-Total: </strong>
            <span class="product-price" data-value="<?=($total)?>"><?= fp($total) ?></span>
        </p>
        <p>
            <strong>Ship To: </strong>
            <select class="selectpicker calcshipto show-tick snb mr" data-width="130px" name="shipto">
                <option value="8" selected>UK Mainland</option>
                <option value="15">Outside UK</option>
            </select>
            <span class="product-price">&pound;8</span></p>
        <p>
            <strong class="mr">Order Total: </strong>
            <span class="product-price" data-value="<?=($total+8)?>"><?= fp($total+8) ?></span>
        </p>
    </div>
</div>


<form class="pull-right" id="frm_paypal_checkout" target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input id="btnPaypal" type="image" name="submit" border="0" src="https://www.paypal.com/en_GB/i/btn/btn_xpressCheckout.gif" alt="PayPal - The safer, easier way to pay online">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="no_note" value="0">
    <input type="hidden" name="bn" value="PP-BuyNowBF">
    <input type="hidden" name="tax_cart" value="0">
    <input type="hidden" name="rm" value="2">
    <input type="hidden" name="charset" value="utf-8">
    <input type="hidden" name="business" value="shop@offordandsons.co.uk">
    <input type="hidden" name="currency_code" value="GBP">
    <input type="hidden" name="lc" value="GB">
    <input type="hidden" name="return" value="http://www.offordandsons.co.uk/paypalpaymentcomplete.php">
    <input type="hidden" name="cbt" value="Return to Offord &amp; Sons">
    <input type="hidden" name="cancel_return" value="http://www.offordandsons.co.uk/paypalpaymentcancel.php">
    <input type="hidden" name="custom" value="">
    <input type="hidden" name="handling_cart" id="handlingcart" value="8">
        
    <?php 
    $i = 0;
    foreach($cart as $c): 
        $i++;
    ?>
    
    <div id="item_<?=$i?>">
        <input type="hidden" name="item_name_<?=$i?>" value="<?=strip_tags(stripslashes(str_replace('\\', '', $c->title))).'('.$c->key.')'?>">
        <input type="hidden" name="quantity_<?=$i?>" value="<?=$c->qty?>">
        <input type="hidden" name="amount_<?=$i?>" value="<?=$c->unitprice?>">
    </div>

    <?php endforeach; ?>

</form>

<?php endif; ?>