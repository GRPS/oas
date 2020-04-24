<!--
<?php if ($show_data):?>

                <div class="row" style="margin-top:100px;">                    
                    <div class="col-md-12 text-left">

                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <strong>Warning!</strong> This information is only for the developer and will not be visible once live.
                            <hr>

                            <p><strong>Memory usage:</strong> Final <?=bytesToSize(memory_get_usage())?>, Peak <?=bytesToSize(memory_get_peak_usage())?>, Session <?=bytesToSize(mb_strlen(serialize($_SESSION)))?></p>
                            <p><strong>Page Load:</strong> <?=round(microtime(true) - (isset($_SERVER["REQUEST_TIME_FLOAT"])?$_SERVER["REQUEST_TIME_FLOAT"]:$_SERVER["REQUEST_TIME"]), 2)?> seconds</p>

                            <div class="panel-group mt" id="accordion">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><?=$this->config->item('icon-vertical')?><span class="glyphicon glyphicon-resize-vertical"></span> Browser Session Data</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                        <?php PrintExt($view_session); ?>
                                        </div>
                                    </div>
                                </div>

                                <?php if(isset($comments)): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><?=$this->config->item('icon-vertical')?><span class="glyphicon glyphicon-resize-vertical"></span> Comments</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul style="font-size:85%;">
                                            <?php foreach($comments as $comment): ?>
                                                <li><?=$comment->dt." : ".$comment->comment?></li>
                                            <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><?=$this->config->item('icon-vertical')?><span class="glyphicon glyphicon-resize-vertical"></span> View Data</a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse">
                                        <div class="panel-body">
                                        <?php PrintExt(unserialize($all)); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

<?php endif; ?>
 -->
