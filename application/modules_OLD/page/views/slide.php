<div class="col-md-12 mts pln prn">
    
    <div id="owl-demo" class="owl-carousel">        
        <?php foreach($slides as $i => $slide): ?>
            <div class="item">
                <a <?=(substr($slide->url, 0, 5) === "https" ? "target='_blank' " : "")?>href="<?=(substr($slide->url, 0, 5) === "https" ? $slide->url : site_url($slide->url))?>" title="Click to see more information on this product.">
                    <img src="<?=site_url("assets/".str_replace(" ", "+", str_replace(".", "a.", $slide->filename)))?>" alt="<?=str_replace(".", "a.", $slide->filename)?>">
                    <p>
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
    <div class="customNavigation">
      <a class="btn prev ml" title="Backward"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span></a>
      <a class="btn next ml" title="Forward"><span class="glyphicon glyphicon-forward" aria-hidden="true"></span></a>
      <a class="btn play ml mr" title="Play"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a>
      <a class="btn stop" title="Stop"><span class="glyphicon glyphicon-stop" aria-hidden="true"></span></a>
    </div>
    
</div>    

<script>
    var slider_start = <?=rand(0,count($slides));?>;
</script>