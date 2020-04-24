<div class="container">
<div class="row">
<div class="col-md-6 bs-callout bs-callout-info">

    <p><small>Configure your ring and the price will instantly reflect those changes.</small></p>
    
    <hr>
    
    <div class="row mts">
        <div class="col-xs-12 col-sm-10">
            <form class="form-horizontal config" role="form">
                
                <input type="hidden" name="price" value="<?=$product->price?>">
                <input type="hidden" name="profile" value="<?=$product->profile?>">
                <input type="hidden" name="pricediamond" value="<?=$product->pricediamond?>">
                <input type="hidden" name="diamond" value="<?=$product->diamonddefault?>">
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
                            <?php foreach($settings['Metals'] as $key => $item): ?>
                                <option value="<?=$item?>"<?=($product->metal==$item?" selected":"")?>><?=$item?></option>
                            <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Profile</td>
                        <td class="profile"><?=$product->profile?></td>
                    </tr>
                    <tr>
                        <td>Weight</td>
                        <td class="">
                            <select class="selectpicker calcprice show-tick" data-width="100%" name="weight">
                            <?php foreach($settings['Weight'] as $key => $item): ?>
                                <?php if($item != "na"): ?>
                                <option value="<?=$item?>"<?=($product->defaultweight==$item?" selected":"")?>><?=$item?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Width (mm)</td>
                        <td class="">
                            <select class="selectpicker calcprice show-tick" data-width="100%" name="width" data-size="5">
                            <?php foreach($settings['Widths'] as $key => $item): ?>
                                <option value="<?=$item?>"<?=($item==$this->config->item("default_width")?" selected":"")?>><?=$item?></option>
                            <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Finger Size</td>
                        <td class="">
                            <select class="selectpicker calcprice show-tick" data-width="100%" name="size" data-size="5">
                            <?php foreach($settings['Finger Sizes'] as $key => $item): ?>
                                <option value="<?=$item?>"<?=($item==$this->config->item("default_finger_size")?" selected":"")?>><?=$item?></option>
                            <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    
                </table>
                
                
                
            </form>
        </div>
    </div>
    
    <hr>
    
    <button class="btn-block btn btn-success buy" data-o="<?=rawurlencode('{"id": "'.$product->id.'", "po": "'.$product->priceoption.'", "price": '.$product->speed_price.', "title": "'.strip_tags($product->title).'", "metal": "'.$product->metal.'", "profile": "'.$product->profile.'", "weight": "'.$product->defaultweight.'", "width": "'.$this->config->item("default_width").'", "size": "'.$this->config->item("default_finger_size").'"}');?>"><i class="glyphicon glyphicon-shopping-cart"></i> Buy</button>    
    <?php $this->load->view('shared/popup_alert'); ?>
    
</div>
</div>
</div>
