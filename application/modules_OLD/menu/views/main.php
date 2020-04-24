
<div class="col-xs-6">
    <select class="selectpicker" data-width="100%" data-size="10">
        <option>-- Products --</option>
        <?php foreach($data as $d): ?>
        <optgroup label="<?=$d['family']?>">
        <?php foreach($d['brands'] as $b): ?>
        <option><?=$b['brand']?></option>
        <?php endforeach; ?>
        </optgroup>
        <?php endforeach; ?>
    </select>
</div>

<div class="col-xs-6">
next here
</div>
