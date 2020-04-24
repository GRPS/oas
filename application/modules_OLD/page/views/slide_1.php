<div class="col-md-12 mt mb pln prn">
    
    <div class="owl-carousel">
        <?php foreach($slides as $i => $slide): ?>
            <div class="item">
                <a href="<?=site_url($slide->url)?>" title="Click to see more information on this product.">
                    <img style="border-top:1px solid rgba(0, 0, 0, 0.75);border-left:1px solid rgba(0, 0, 0, 0.75);border-right:1px solid rgba(0, 0, 0, 0.75);" src="<?=site_url("assets/".$slide->filename)?>" alt="" style="margin:auto; width:auto; max-height:300px;">
                    <p style="text-align: center; margin-bottom:0px;position: absolute; left: 0; bottom: 0; right: 0; background: rgba(0, 0, 0, 0.75); font-size: 12px !important; height: 40px; line-height: 40px;">
                        <?php if($slide->title != null): ?>
                        <strong><?=$slide->title?> </strong>
                        <?php endif; ?>
                        <?php if($slide->title != null && $slide->description != null): ?>
                         :  
                        <?php endif; ?>
                        <?php if($slide->description != null): ?>
                        <?=$slide->description?>
                        <?php endif; ?>
                    </p>          
                </a>
            </div>
        <?php endforeach; ?>    
    </div>

    <script>
        var slider_start = <?=rand(0,count($slides));?>;
    </script>