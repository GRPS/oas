    <div class="row">
        <div class="col-sm-12">
            <div class="page-header mtn">
                <div class="page-header mtn">
                    <h1 class="mtn">Admin <small><?=$page_title?></small></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Menu <small style="color:#c4c4c4;">(last update: <?=date('l jS F Y @ H:i:s', strtotime($menu_update))?>)</small><a class="btn btn-xs btn-danger pull-right" href="<?=base_url("admin/set_menu")?>" title="Update the menu.">Update</a></div>
                <p class="pts pls"><small>Admin builds the menu for the website. Rebuild the menu if you add or remove a product of modify it's category and the menu should reflect this.</small></p>
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Default Speedy Prices <small style="color:#c4c4c4;">(last update: <?=date('l jS F Y @ H:i:s', strtotime($speedy_price_update))?>)</small><a class="btn btn-xs btn-danger pull-right" href="<?=base_url("admin/speedy_prices")?>" title="Update all product default prices.">Go</a></div>
                <p class="pts pls"><small>All products are shown using the default speedy price.</small></p>
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Facebook Like/Share button<button class="btn btn-xs btn-danger pull-right updateFacebookButton" title="Update the menu.">Launch</button></div>
                <p class="pts pls"><small>If you change the metadata content then Facebook needs to know that specific page has changed.</small></p>
                <p class="pls"><small>A new Facebook tab will open for each website page allowing you to update it's scrape information. Press the button [Fetch new scrape information] in each tab.</small></p>
                <p class="pls" style="color:red;">You may need to unblock popups for this to work</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 col-md-2">
            <div class="panel panel-primary">
                <div class="panel-heading">PO3 Metal Prices</div>
                <table class="nano table table-condensed table-striped">
                    <tbody>
                        <?php foreach($po3_metal as $d): ?>
                        <tr>
                            <td><?=$d->metal?></td>
                            <td class="text-right price"><?=fp($d->price)?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="panel-footer"><a class="btn btn-primary btn-xs" href="<?=base_url('admin/open_table/po3_metal')?>" alt="Open table.">Goto</a></div>
            </div>
        </div>
        
        <div class="col-sm-3 col-md-2">
            <div class="panel panel-primary">
                <div class="panel-heading">PO4 Metal Prices</div>
                <table class="nano table table-condensed table-striped">
                    <tbody>
                        <?php foreach($po4_metal as $d): ?>
                        <tr>
                            <td><?=$d->metal?></td>
                            <td class="text-right price"><?=fp($d->price)?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="panel-footer"><a class="btn btn-primary btn-xs" href="<?=base_url('admin/open_table/po4_metal')?>" alt="Open table.">Goto</a></div>
            </div>
        </div>
        
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">PO4 Diamond Prices</div>
                <table class="nano table table-condensed table-striped">
                    <tbody>
                        <?php foreach($po4_price as $d): ?>
                        <tr>
                            <td><?=$d->cut?></td>
                            <td><sub>From</sub> <?=$d->caratfrom?> <sub>to</sub> <?=$d->caratto?></td>
                            <td><?=$d->colour?></td>
                            <td><?=$d->clarity?></td>
                            <td class="text-right price"><?=fp($d->price)?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="panel-footer"><a class="btn btn-primary btn-xs" href="<?=base_url('admin/open_table/po4_price')?>" alt="Open table.">Goto</a></div>
            </div>
        </div>
        
    </div>
