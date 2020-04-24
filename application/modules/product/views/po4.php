<div class="container">
<div class="row">
<div class="col-md-6 bs-callout bs-callout-info">
    
    <p><small>Configure your ring and the price will instantly reflect those changes.</small></p>
    
    <hr>
    
    <div class="row mts">
        <div class="col-xs-12 col-sm-10">
            <form class="form-horizontal config" role="form">
                
                <input type="hidden" name="initialprice" value="<?=$product->price?>">
                <input type="hidden" name="pricemetal" value="<?=$product->pricemetal?>">
                <input type="hidden" name="profile" value="<?=$product->profile?>">
                <input type="hidden" name="diamonddefault" value="<?=$product->diamonddefault?>">
                <input type="hidden" name="diamondcut" value="<?=$product->diamondcut?>">
                <input type="hidden" name="diamondprice" value="<?=$product->diamondprice?>">
                
                <table class="table borderless mbn">
                
                    <tr>
                        <td class="col-xs-5 col-sm-4 col-md-3">Ref #</td>
                        <td><?=$product->id?></td>
                    </tr>
                    
                    <tr>
                        <td>Price</td>
                        <td><span class="product-price price"><?=fp($product->speed_price)?></span></td>
                    </tr>
                    <tr>
                        <td>Metal</td>
                        <td class="">
                            <select class="selectpicker calcprice show-tick" data-width="100%" name="metal" data-size="5">
                            <?php foreach($po4metals as $item): ?>
                                <option value="<?=$item->metal?>"<?=($product->metal==$item->metal?" selected":"")?>><?=$item->metal?></option>
                            <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr<?=($product->showfingersize=="Yes"?"":' style="display:none"')?>>
                        <td>Finger Size</td>
                        <td class="">
                            <select class="selectpicker calcprice show-tick" data-width="100%" name="size" data-size="5">
                            <?php foreach($settings['Finger Sizes'] as $key => $item): ?>
                                <option value="<?=$item?>"<?=($item==$this->config->item("default_finger_size")?" selected":"")?>><?=$item?></option>
                            <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Diamonds</td>
                        <td>
                            <div class="col-xs-12 col-sm-7 col-lg-9 item_static">
                                <span class="diamonds"><?=$product->diamonddefault?></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Carat</td>
                        <td>
                            <select class="selectpicker calcprice show-tick" data-width="100%" name="carat">
                            <?php foreach($carat as $key => $item): 
                                if ($item->defaultcarat=="Yes"){
                                    $defaultcarat = $item->carat;
                                    $defaultgramweight = $item->gramweight;
                                }
                                ?>
                                <option value="<?=$item->carat."~".$item->gramweight?>"<?=($item->defaultcarat=="Yes"?" selected":"")?>><?=$item->carat?></option>
                            <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Colour</td>
                        <td>
                            <select class="selectpicker calcprice show-tick" data-width="100%" name="colour">
                            <?php foreach($settings['Diamond Colour'] as $key => $item): ?>
                                <?php if($item != "na"): ?>
                                <option value="<?=$item?>"<?=($product->diamondcolour==$item?" selected":"")?>><?=$item?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Clarity</td>
                        <td>
                            <select class="selectpicker calcprice show-tick" data-width="100%" name="clarity">
                            <?php foreach($settings['Diamond Clarity'] as $key => $item): ?>
                                <?php if($item != "na"): ?>
                                <option value="<?=$item?>"<?=($item==$product->diamondclarity?" selected":"")?>><?=$item?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>
                
            </form>
        </div>
    </div>
    
    <hr>
    
    <button class="btn-block btn btn-success buy" data-o="<?=rawurlencode('{"id": "'.$product->id.'", "po": "'.$product->priceoption.'", "initialprice": '.$product->price.',"price": '.$product->speed_price.', "title": "'.strip_tags($product->title).'", "metal": "'.$product->metal.'", "gramweight": "'.$defaultgramweight.'", "carat": "'.$defaultcarat.'", "size": "'.$this->config->item("default_finger_size").'", "diamondcut": "'.$product->diamondcut.'", "colour": "'.$product->diamondcolour.'", "clarity": "'.$product->diamondclarity.'", "diamonddefault": "'.$product->diamonddefault.'"}');?>"><i class="glyphicon glyphicon-shopping-cart"></i> Buy</button>    
    <?php $this->load->view('shared/popup_alert'); ?>
    
    <?php //PrintExt($po4metals); ?>
    
</div>
</div>
</div>