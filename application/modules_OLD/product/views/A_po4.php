
<div class="alert alert-info" role="alert">
    
    <h4>Add to your shopping cart</h4>    
    
    <p><small>Configure your ring and the price will instantly reflect those changes.</small></p>
    
    <hr>
    
    <div class="row mts">
        <div class="col-xs-12 col-sm-6 col-lg-5">
            <form class="form-horizontal config" role="form">
                
                <input type="hidden" name="initialprice" value="<?=$product->price?>">
                <input type="hidden" name="pricemetal" value="<?=$product->pricemetal?>">
                <input type="hidden" name="profile" value="<?=$product->profile?>">
                <input type="hidden" name="diamonddefault" value="<?=$product->diamonddefault?>">
                <input type="hidden" name="diamondcut" value="<?=$product->diamondcut?>">
                <input type="hidden" name="diamondprice" value="<?=$product->diamondprice?>">
                
                <div class="form-group mtn">
                    <label for="price" class="col-xs-12 col-sm-5 col-lg-3">Price</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9 item_static">
                        <span class="price"><?=fp($product->speed_price)?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="metal" class="col-xs-12 col-sm-5 col-lg-3">Metal</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9">
                        <select class="selectpicker calcprice show-tick" data-width="100%" name="metal">
                        <?php foreach($settings['Diamond Metals'] as $key => $item): ?>
                            <?php if($item != "na"): ?>
                            <option value="<?=$item?>"<?=($product->metal==$item?" selected":"")?>><?=$item?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="size" class="col-xs-12 col-sm-5 col-lg-3">Finger Size</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9">
                        <select class="selectpicker calcprice show-tick" data-width="100%" name="size" data-size="5">
                        <?php foreach($settings['Finger Sizes'] as $key => $item): ?>
                            <option value="<?=$item?>"<?=($item==$this->config->item("default_finger_size")?" selected":"")?>><?=$item?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="diamonds" class="col-xs-12 col-sm-5 col-lg-3">Diamonds</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9 item_static">
                        <span class="diamonds"><?=$product->diamonddefault?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="carat" class="col-xs-12 col-sm-5 col-lg-3">Carat</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9">
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
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="colour" class="col-xs-12 col-sm-5 col-lg-3">Colour</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9">
                        <select class="selectpicker calcprice show-tick" data-width="100%" name="colour">
                        <?php foreach($settings['Diamond Colour'] as $key => $item): ?>
                            <?php if($item != "na"): ?>
                            <option value="<?=$item?>"<?=($product->diamondcolour==$item?" selected":"")?>><?=$item?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group mbn">
                    <label for="clarity" class="col-xs-12 col-sm-5 col-lg-3">Clarity</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9">
                        <select class="selectpicker calcprice show-tick" data-width="100%" name="clarity">
                        <?php foreach($settings['Diamond Clarity'] as $key => $item): ?>
                            <?php if($item != "na"): ?>
                            <option value="<?=$item?>"<?=($item==$product->diamondclarity?" selected":"")?>><?=$item?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    
    <hr>
    
    <button class="btn btn-success buy" data-o="<?=rawurlencode('{"id": "'.$product->id.'", "po": "'.$product->priceoption.'", "initialprice": '.$product->price.',"price": '.$product->speed_price.', "title": "'.strip_tags($product->title).'", "metal": "'.$product->metal.'", "gramweight": "'.$defaultgramweight.'", "carat": "'.$defaultcarat.'", "size": "'.$this->config->item("default_finger_size").'", "diamondcut": "'.$product->diamondcut.'", "colour": "'.$product->diamondcolour.'", "clarity": "'.$product->diamondclarity.'", "diamonddefault": "'.$product->diamonddefault.'"}');?>"><i class="glyphicon glyphicon-shopping-cart"></i> Buy</button>    
    
</div>
