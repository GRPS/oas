
<div class="alert alert-info" role="alert">
    
    <h4>Add to your shopping cart</h4>    
    
    <p><small>Configure your ring and the price will instantly reflect those changes.</small></p>
    
    <hr>
    
    <div class="row mts">
        <div class="col-xs-12 col-sm-6 col-lg-5">
            <form class="form-horizontal config" role="form">
                
                <input type="hidden" name="price" value="<?=$product->price?>">
                <input type="hidden" name="profile" value="<?=$product->profile?>">
                <input type="hidden" name="pricediamond" value="<?=$product->pricediamond?>">
                <input type="hidden" name="diamond" value="<?=$product->diamonddefault?>">
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
                        <select class="selectpicker calcprice show-tick" data-width="100%" name="metal" data-size="5">
                        <?php foreach($settings['Metals'] as $key => $item): ?>
                            <option value="<?=$item?>"<?=($product->metal==$item?" selected":"")?>><?=$item?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="profile" class="col-xs-12 col-sm-5 col-lg-3">Profile</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9 item_static">
                        <span class="profile"><?=$product->profile?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="weight" class="col-xs-12 col-sm-5 col-lg-3">Weight</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9">
                        <select class="selectpicker calcprice show-tick" data-width="100%" name="weight">
                        <?php foreach($settings['Weight'] as $key => $item): ?>
                            <?php if($item != "na"): ?>
                            <option value="<?=$item?>"<?=($product->defaultweight==$item?" selected":"")?>><?=$item?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="width" class="col-xs-12 col-sm-5 col-lg-3">Width (mm)</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9">
                        <select class="selectpicker calcprice show-tick" data-width="100%" name="width" data-size="5">
                        <?php foreach($settings['Widths'] as $key => $item): ?>
                            <option value="<?=$item?>"<?=($item==$this->config->item("default_width")?" selected":"")?>><?=$item?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group mbn">
                    <label for="size" class="col-xs-12 col-sm-5 col-lg-3">Finger Size</label>
                    <div class="col-xs-12 col-sm-7 col-lg-9">
                        <select class="selectpicker calcprice show-tick" data-width="100%" name="size" data-size="5">
                        <?php foreach($settings['Finger Sizes'] as $key => $item): ?>
                            <option value="<?=$item?>"<?=($item==$this->config->item("default_finger_size")?" selected":"")?>><?=$item?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    
    <hr>
    
    <button class="btn btn-success buy" data-o="<?=rawurlencode('{"id": "'.$product->id.'", "po": "'.$product->priceoption.'", "price": '.$product->speed_price.', "title": "'.strip_tags($product->title).'", "metal": "'.$product->metal.'", "profile": "'.$product->profile.'", "weight": "'.$product->defaultweight.'", "width": "'.$this->config->item("default_width").'", "size": "'.$this->config->item("default_finger_size").'"}');?>"><i class="glyphicon glyphicon-shopping-cart"></i> Buy</button>    
    
</div>
