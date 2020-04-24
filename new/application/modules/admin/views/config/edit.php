    <div class="row">
        <div class="col-sm-12">
            <div class="page-header mtn">
                <div class="page-header mtn">
                    <h1 class="mtn">Admin <small><?=$page_title?></small></h1>
                </div>
            </div>
        </div>
    </div>

    <form class="form-horizontal" role="form" method="post" action="<?=$btn_save['url']?>">    
    
        <input type="hidden" name="uid" value="<?=$config->uid?>">

        <div class="row">
            <div class="col-md-12">                    

            <a class="btn btn-sm btn-default mbs mrs" href='<?=$btn_cancel['url']?>' title="<?=$btn_cancel['title']?>"><?=$btn_cancel['label']?></a>
            <button type="submit" class="btn btn-sm btn-success mbs mrs" title="<?=$btn_save['title']?>"><?=$btn_save['label']?></button>

            <a class="btn btn-sm btn-primary mbs mrs" href="<?=$json_viewer?>" target="_new" title="Launch JSON Viewer website">Launch JSON Viewer Website</a>
            
            <div class="form-group">
                <label for="id" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="id" value="<?=$config->id?>" disabled>
                </div>
            </div>

            <div class="form-group">
                <label for="json" class="col-sm-2 control-label">JSON</label>
                <div class="col-sm-10">
                    <!--<textarea class="json" id="json" name="json" style="width:100%;" rows="500"><?=json_encode(json_decode($config->json), JSON_PRETTY_PRINT)?></textarea>-->
                    <textarea class="json" id="json" name="json" style="width:100%;" rows="500"><?=json_encode(json_decode($config->json))?></textarea>
                </div>
            </div>

            </div>
        </div>
    
    </form>