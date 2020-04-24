<ol class="breadcrumb">
    <li><?=$title;?></li>
</ol>

<?php if(empty($cart)): ?>

<div class="alert alert-info" role="alert">
    <span class="glyphicon glyphicon-flash"></span> Your shopping cart is empty.
</div>

<?php else: ?>

<table class="styled cart table table-bordered table-condensed mbs">
    
    <thead>
        <tr>
            <th colspan="2">Product</th>
            <th class="text-right w120">Price</th>
        </tr>
    </thead>
    <tbody>
        
        <?php 
            $total = 0;
            foreach($cart as $c): 
                $total += $c->price;
        ?>
        <tr>
            <td rowspan="2" class="text-center">
                <a href="<?=base_url('product/search?id='.$c->id)?>" alt="<?=$c->id?>" title='Click to view product.'><img src="<?=$thumb.$c->thumbnail?>" height="64" alt="<?=$c->id?>"></a>
            </td>
            <td style="width:80%; overflow: visible;">                    

                <?=strip_tags(stripslashes(str_replace("\\", "", $c->title)))?>
                
                <span class="pull-right">
                    <select class="selectpicker calcqty show-tick qty" data-width="130px" name="qty" data-id="<?=$c->id?>"  data-key="<?=$c->key?>">
                        <option value="0">Remove Item</option>
                        <option value="1"<?=($c->qty==1?" selected":"")?>>Qty: 1</option>
                        <option value="2"<?=($c->qty==2?" selected":"")?>>Qty: 2</option>
                        <option value="3"<?=($c->qty==3?" selected":"")?>>Qty: 3</option>
                        <option value="4"<?=($c->qty==4?" selected":"")?>>Qty: 4</option>
                        <option value="5"<?=($c->qty==5?" selected":"")?>>Qty: 5</option>
                        <option value="6"<?=($c->qty==6?" selected":"")?>>Qty: 6</option>
                        <option value="7"<?=($c->qty==7?" selected":"")?>>Qty: 7</option>
                        <option value="8"<?=($c->qty==8?" selected":"")?>>Qty: 8</option>
                        <option value="9"<?=($c->qty==9?" selected":"")?>>Qty: 9</option>
                        <option value="10"<?=($c->qty==10?" selected":"")?>>Qty: 10</option>
                    </select>
                </span>

            </td>
            <td rowspan="2" class="price text-right w80"><?=fp($c->price)?></td>
        </tr> 
        <tr>
            <td class="text-muted" style="background-color:#fbfbfb;">
                <small><?=$c->key?></small>
                <small class='text-muted pull-right'><?=fp($c->unitprice)?> ea.</small>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="2" class="text-right"><strong>Sub-Total</strong></td>
            <td class="text-right price subprice" data-value="<?=($total)?>"><?= fp($total) ?></td>
        </tr>
        <tr>
            <td colspan="2" class="text-right"><strong>Ship To:</strong>
                <select class="selectpicker calcshipto show-tick snb" data-width="130px" name="shipto">
                    <option value="8" selected>UK Mainland</option>
                    <option value="15">Outside UK</option>
                </select>
            </td>
            <td class="text-right price shipto">&pound;8</td>
        </tr>
        <tr>
            <td colspan="2" class="text-right"><strong>Order Total</strong></td>
            <td class="text-right price totalprice" data-value="<?=($total+8)?>"><?= fp($total+8) ?></td>
        </tr>
    </tbody>    
</table>

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
        <input type="hidden" name="item_name_<?=$i?>" value="<?=  strip_tags($c->title." (".$c->key.")")?>">
        <input type="hidden" name="quantity_<?=$i?>" value="<?=$c->qty?>">
        <input type="hidden" name="amount_<?=$i?>" value="<?=$c->unitprice?>">
    </div>

    <?php endforeach; ?>

</form>

<?php endif; ?>