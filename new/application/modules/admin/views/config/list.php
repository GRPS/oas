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
        <div class="col-md-12">                    

        <?php foreach($config as $c): ?>
            <a class="btn btn-primary mr mb" href="<?=base_url('admin/config/edit/'.$c->uid)?>"><?=$c->id?></a>
        <?php endforeach; ?>

        </div>
    </div>