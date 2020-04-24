<script>

var dt = '<?=date('Y-m-d H:i:s');?>';
var data = <?=json_encode($ids)?>;

</script>

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
        <a class="btn btn-sm btn-default mb" href="<?=base_url("admin")?>"><span class="glyphicon glyphicon-chevron-left"></span> Admin</a>
        <button id="speedy_prices" class="btn btn-xs btn-danger mb pull-right" onclick="speedy_prices('admin/update_speedy_prices');"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Update Speedy Prices</button>
    </div>
</div>

<div id="res"></div>

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">                                                
            <table class="data micro table table-bordered table-hover table-condensed" data-page-size="50" data-page-list="[50, 100, 200]" data-search="true" data-select-item-name="toolbar1" data-pagination="true">
                <thead>
                    <tr style="background-color:#c4c4c4;">
                        <th data-field="cnt" data-align="right" class="w1">#</th>
                        <th>ID</th>                
                        <th>Speed Price</th>
                        <th>Item</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $i => $product): ?>
                    <tr>
                        <td><small><?=($i+1)?></small></td>
                        <td><a href="<?=base_url('admin/view/product/'.$product->uid)?>" target="_new"><?=$product->id?></a></td>
                        <td><?=fp($product->speed_price)?></td>
                        <td><small><?=$product->title?> (<?=$product->family?> / <?=$product->brand?> / <?=$product->type?></small></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>                   
            </table>
        </div>
    </div>
</div>
