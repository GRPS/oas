            <div class="row">
                <div class="col-md-12">
                    
                    <div class="page-header mtn">
                        <h1><?=$page_title?> <small><?=count($data['rows'])?> <?=$records?></small></h1>
                    </div>
                                        
                    <?php if($btn_back['show']): ?>
                    <a class="btn btn-sm btn-default mbs mrs" href='<?=$btn_back['url']?>' title="<?=$btn_back['title']?>"><?=$btn_back['label']?></a>
                    <?php endif; ?>
                    
                    <div class="table-responsive">
                        <table class="micro table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="count">#</th>
                                    <?php foreach ($data['headings'] as $heading):?>
                                    <th><?=$heading['fld']?></th>
                                    <?php endforeach;?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                foreach ($data['rows'] as $row):                                 
                                ?>

                                <tr>
                                    <td class="count">
                                        <?=$i++?>
                                    </td>
                                    <?php
                                    foreach ($row as $key => $value):
                                    ?>
                                    <td><?=$value?></td>
                                    <?php    
                                    endforeach;
                                    ?>
                                </tr>

                                <?php endforeach; ?>
                            </tbody>                   
                        </table>
                    </div>
                    
                </div>
            </div>
