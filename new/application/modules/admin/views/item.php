<form class="form-horizontal" role="form" method="post" action="<?=$btn_save['url']?>">    
    
    <input type="hidden" name="table" value="<?=$json->table?>">
    <input type="hidden" name="uid" value="<?=$data["uid"]?>">
    
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
        <div class="col-sm-8">
            
            <?php if($btn_back['show']): ?>
                <a class="btn btn-sm btn-default mbs mrs" href='<?=$btn_back['url']?>' title="<?=$btn_back['title']?>"><?=$btn_back['label']?></a>
            <?php endif; ?>

            <?php if($mode == "read"): ?>
                <a class="btn btn-sm btn-primary mbs mrs" href='<?=$btn_edit['url']?>' title="<?=$btn_edit['title']?>"><?=$btn_edit['label']?></a>
            <?php else: ?>
                <a class="btn btn-sm btn-warning mbs mrs" href='<?=$btn_cancel['url']?>' title="<?=$btn_cancel['title']?>"><?=$btn_cancel['label']?></a>
                <button type="submit" class="btn btn-sm btn-success mbs mrs" title="<?=$btn_save['title']?>"><?=$btn_save['label']?></button>
            <?php endif; ?>
                
            <?php 
            if(isset($json->buttons) && $mode!="add"):            
            foreach($json->buttons as $button): ?>
                <a class="btn btn-sm btn-primary mbs mrs" href="<?=base_url($button->url).(isset($button->search_id)?"?search=".$data["id"]:"")?>" title="<?=$button->title?>"><?=$button->label?></a>
            <?php 
            endforeach; 
            endif;
            ?>

        </div>                
        <div class="col-sm-4">                
            <?php if($btn_delete['show']): ?>
                <div id="del" class="input-group">
                    <span class="input-group-addon">Code: <?=$data["uid"]?></span>
                    <input type="text" class="form-control" placeholder="Type in the code">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-danger<?=(isset($btn_delete['class'])?" ".$btn_delete['class']:"")?>" data-url="<?=$btn_delete['url']?>" title="<?=$btn_delete['title']?>" data-code="<?=$data["uid"]?>" onclick="checkCode();"><?=$btn_delete['label']?></button>
                    </span>
                </div>
            <?php endif; ?>

        </div>
    </div>
    
    <hr class="mts">

    <div class="row">
        <div class="col-md-12 mb">

                <?php foreach($json->edit_cols as $col): ?>
                <div class="form-group mtn<?=($mode == "read"?" mbn":"")?>">
                    
                    <label for="<?=$col->col_name?>" class="col-sm-2 control-label mtn<?=(isset($col->class)?" ".$col->class:"")?>"><?=$col->label?></label>
                    <div class="<?=$col->width?>"<?=($col->input_type == "editor"?"style=\"margin-top:7px;\"":"")?>>
                    <?php
                    if ($mode == "read" || $col->input_type == "") {
                        if($col->input_type == "editor") {
                            echo $data[$col->col_name];
                        } else {
                            echo "<p class=\"form-control pln mbn nb\">".$data[$col->col_name]."</p>";
                        }
                    } else {
                        switch ($col->input_type) {
                            case "input":
                                ?>
                                <input type="text" class="form-control" name="<?=$col->col_name?>" value="<?=(isset($data[$col->col_name])?$data[$col->col_name]:"")?>">
                                <?php
                                break;
                            case "editor":
                                ?>
                                <textarea class="form-control" rows="20" name="<?=$col->col_name?>"><?=(isset($data[$col->col_name])?$data[$col->col_name]:"")?></textarea>
                                <?php
                                break;
                            case "fixed-select":                                
                                ?>
                                <select class="selectpicker show-tick" data-width="100%" name="<?=$col->col_name?>">                                    
                                    <?php foreach($col->options as $opt): ?>
                                    <option value="<?=$opt?>"<?=(!isset($data[$col->col_name])?"":($data[$col->col_name]==$opt?" selected":""))?>><?=$opt?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php
                                break;
                            case "lookup-select":
                                
                                $val = (isset($data[$col->col_name])?$data[$col->col_name]:"na");
                                
                                ?>
                                <select class="selectpicker show-tick" data-width="100%" name="<?=$col->col_name?>">                                    
                                    <?php foreach($preloads[$col->lookup] as $key): ?>
                                    <option value="<?=$key->text?>"<?=($val==$key->text?" selected":"")?>><?=$key->text?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php
                                break;
                            case "carats":
                                //This is a special exception for getting product carats.
                                $val = (isset($data[$col->col_name])?$data[$col->col_name]:"na");
                                
                                ?>
                                <select class="selectpicker show-tick" data-width="100%" name="<?=$col->col_name?>" data-live-search="true" data-size="7">                                    
                                    <?php foreach($carats as $carat): ?>
                                    <option value="<?=$carat->value?>"<?=($val==$carat->value?" selected":"")?>><?=$carat->text?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php
                                break;
                            case "session-select":
                                
                                ?>
                                <select class="selectpicker show-tick" data-width="100%" data-live-search="true" name="<?=$col->col_name?>">                                    
                                    <?php 
                                    //foreach($_SESSION[$col->key] as $opt): 
                                    foreach($this->nativesession->get($col->key) as $opt):
                                    ?>
                                    <option value="<?=$opt?>"<?=(!isset($data[$col->col_name])?"":($data[$col->col_name]==$opt?" selected":""))?>><?=$opt?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php
                                
                                break;
                            case "switch":
                                ?>
                                <div class="input-group">
                                    <div class="radioBtn btn-group">
                                        <?php 
                                        $val = (isset($data[$col->col_name])?$data[$col->col_name]:$col->options[0]);
                                            
                                        foreach($col->options as $k => $opt): ?>
                                            <a class="btn btn-primary btn-sm <?=($val==$opt?"active":"notactive")?>" data-toggle="<?=$col->col_name?>" data-title="<?=$opt?>"><?=$opt?></a>
                                       <?php endforeach; ?>
                                    </div>
                                    <input type="hidden" name="<?=$col->col_name?>" id="<?=$col->col_name?>" value="<?=$val?>">
                                </div>
                                <?php
                                break;
                                
                        } 
                        
                        if (isset($col->help)):
                        ?>
                        <p class="help-block mtn mbn"><?=$col->help?></p>   
                        <?php
                        endif;
                    }
                    ?>
                    </div>
                </div>
                <?php endforeach; ?>

        </div>
    </div>    
    
</form>    