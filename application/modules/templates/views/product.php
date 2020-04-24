<!DOCTYPE html>
<html>
    <head>

        <title><?=$meta['title']?></title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="index, follow" />
        <meta name="p:domain_verify" content="bb94036334a5f9a64ac7fa85c64abf37"/>
        <meta name="google-site-verification" content="Ul3A-Z2dH6FzJ0qIqJGcp2Sg--Ncm-dwU3fvXfNVag4" />

        <meta name="description" content="<?=$meta['description']?>">
        <meta name="keywords" content="<?=$meta['keywords']?>">
        <meta name="author" content="Graham Simmons">

        <link rel='shortcut icon' type='image/x-icon' href='<?=base_url('assets/img/favicon.ico')?>' />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url('assets/img/favicon.png')?>">

        <meta property="fb:app_id"        content="1754420858146029" />
        <meta property="og:url"           content="<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="<?=$meta['title']?>" />
        <meta property="og:description"   content="<?=$meta['description']?>" />
        <meta property="og:image"         content="<?=$this->config->item("domainIMG").$meta['image']?>" />

        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-select/css/bootstrap-select.min.css')?>" />
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/craftpip-select/css/bootstrap-fullscreen-select.css')?>" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/app.css')?>">

        <?php if(isset($css)):?>
            <?php foreach($css as $css):?>
            <link rel="stylesheet" type="text/css" href="<?=$css?>" />
            <?php endforeach;?>
        <?php endif?>

        <!--[if lt IE 9]>
            <script src="<?=base_url('assets/bootstrap/js/html5shiv.js')?>"></script>
            <script src="<?=base_url('assets/bootstrap/js/respond.min.js')?>"></script>
        <![endif]-->

        <script type="text/javascript">
            var path = '<?=site_url();?>';
            var family = '<?=$family?>';
            var brand = '<?=$brand?>';
            var img_wait_small = '<img src="<?=site_url();?><?=$this->config->item("wait_small")?>">';
            var POA = '<?=$this->config->item("PriceOnApplication");?>';
        </script>

    <!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
    <script type="text/javascript">
        window.cookieconsent_options = {"message":"This website uses cookies to ensure you get the best experience on our website","dismiss":"Got it!","learnMore":"More info","link":null,"theme":"dark-floating"};
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
    <!-- End Cookie Consent plugin -->

    </head>

    <body>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

        <?php $this->load->view('shared/menu_top'); ?>
        <?php $this->load->view('shared/header'); ?>
<div class="container">
        <img src="<?=$banner?>" alt="banner" style="width:100%;"/>

        <!--======================================================================-->
        
        <!--======================================================================-->
        
        <div id="left-menu" class="container-fluid" style="margin-top:20px;">

            <div class="row">
                <div class="hidden-xs col-sm-4 col-md-3">
                    <ul class="list-group<?=$title=="Search"?" hide":""?>">
                        
<!--                        <li class="list-group-item">
                            <div class="demo">
                                <input type="radio" name="opts" class="faStr"><label>My Star Items</label>
                            </div>
                        </li>-->

                        <!-- ?Family -->
                        <li class="list-group-item" style="font-family:Cabin,arial,helvetica,sans-serif; font-weight:700; text-transform: uppercase; background-color:#7DA2B0; color:#ffffff;"><?=$family?></li>

                        <!-- ?Featured items or first 8 -->
                        <li class="list-group-item">
                            <div class="demo">
                                <label class="finger">
                                    <input type="radio" name="opts" name="opts" class="faFlag"<?=(base64_encode(strtolower($family)."##")==$radio_selector?" checked" : "")?> onclick="go('<?=base_url('product/'.$family)?>');">
                                    <span style="margin-left:15px;">Featured <?=ucwords($family)?></span>
                                </label>
                            </div>
                        </li>

                        <!-- ?All -->
                        <li class="list-group-item">
                            <div class="demo">
                                <label class="finger">
                                    <input type="radio" name="opts" class="faTh"<?=(base64_encode(strtolower($family)."#all#")==$radio_selector?" checked" : "")?> onclick="go('<?=base_url('product/'.$family.'/all')?>');">
                                    <span style="margin-left:15px;">All <?=$family?></span>
                                </label>
                            </div>
                        </li>

                        <?php foreach($LeftMenu["brand"] as $key => $brand): ?>
                        <!-- ?Brand -->
                        <li class="list-group-item">
                            <label><?=$key?></label>
                            <div class="demo demo<?=(count($LeftMenu['brand'][$key])>6?"-overflow":"")?>">
                                <?php foreach($brand as $a => $b): ?>
                                <?php if($a != "-"): ?>
                                <label class="finger">
                                    <input type="radio" name="opts" class="faChkRnd" onclick="go('<?=base_url('product/'.$family.'/'.$key.'/'.$a)?>');"<?=(base64_encode(strtolower($family."#".$key."#".$a))==$radio_selector?" checked" : "")?>>
                                    <span style="margin-left:15px;"><?=$a?></span>
                                </label>
                                <br />
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                    
                </div>
                
                <div class="col-sm-8 col-md-9">
                    
                    <div id="modeltop" style="display:none; position:fixed; overflow:hidden; right:0; left:0; top:0; bottom:0; background-color: #ffffff; z-index:1000;">
                        <div onclick="modalPlay('hide');" style="background-color: #7DA2B0; color:#ffffff; font-weight: bold; font-size:150%; text-align:center; position:absolute; top:0px; width:100%; line-height:60px; height:60px; border-bottom:1px solid #c4c4c4;">
                            <?=$family?>
                            <span style="top:20px; right:20px;" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
                        </div>
                        <div id="modelmiddle" style="margin-top:60px; overflow:auto; background-color: #ffffff;">
                            
                            <p style="cursor:pointer; text-indent: 20px; padding: 10px; border-bottom:1px solid #eeeeee; margin-bottom:0px; " onclick="go64('<?=base64_encode(strtolower($family."##"))?>');"<?=(base64_encode(strtolower($family."##"))==$radio_selector?" checked" : "")?> data-me="<?=base64_encode(strtolower($family."##"))?>" data-rs="<?=$radio_selector?>">Featured <?=$family?>
                                <?=(base64_encode(strtolower($family."##"))==$radio_selector?"<span class='glyphicon glyphicon-ok pull-right' aria-hidden='true'></span>" : "")?>
                            </p>
                            
                            <p style="cursor:pointer; text-indent: 20px; padding: 10px; border-bottom:1px solid #eeeeee; margin-bottom:0px; " onclick="go64('<?=base64_encode(strtolower($family."#all#"))?>');"<?=(base64_encode(strtolower($family."#all#"))==$radio_selector?" checked" : "")?> data-me="<?=base64_encode(strtolower($family."#all#"))?>" data-rs="<?=$radio_selector?>">All <?=$family?>
                                <?=(base64_encode(strtolower($family."#all#"))==$radio_selector?"<span class='glyphicon glyphicon-ok pull-right' aria-hidden='true'></span>" : "")?>
                            </p>
                                
                            <?php foreach($LeftMenu["brand"] as $key => $brand): ?>
                            <p style="padding:10px; background-color: #c4c4c4; text-indent:20px; "><strong><?=$key?></strong></p>                               
                                <?php foreach($brand as $a => $b): ?>
                                <?php if($a != "-"): ?>
                                <p style="cursor:pointer; text-indent: 20px; padding: 10px; border-bottom:1px solid #eeeeee; margin-bottom:0px; " onclick="go64('<?=base64_encode(strtolower($family."#".$key."#".$a))?>');"<?=(base64_encode(strtolower($family."#".$key."#".$a))==$radio_selector?" checked" : "")?> data-me="<?=base64_encode(strtolower($family.'#'.$key.'#'.$a))?>" data-rs="<?=$radio_selector?>"><?=$a?>
                                <?=(base64_encode(strtolower($family."#".$key."#".$a))==$radio_selector?"<span class='glyphicon glyphicon-ok pull-right' aria-hidden='true'></span>" : "")?>
                                </p>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php if($title!="Search"):?>
                    <button class="visible-xs product-browse mb" onclick="modalPlay('show');">Browse <?=$family?></button>
                    <?php endif; ?>

                    <div class="callout-left bs-callout-info" style="margin-bottom:20px;">
                        <h1 style="margin-top:0px;"><?=implode(" : ", $breadcrumb)?></h1>
                    </div>
                    
                    <p><?=$product_msg['msg']?></p>
                    <p><?=$description?></p>

                    <?php foreach($products as $product): ?>
                    <div class="product-box finger" onclick="window.location.href='<?=site_url('product?id='.$product->id)?>';">
                        <div class="product-wrap rad">
<!--                            <div class="product-info">
                                <p><?=strip_tags($product->id)?></p>
                            </div>-->
                            <div class="product-img">
                                <img src="<?=$thumb.$product->thumbnail?>" alt="<?=$product->imgalt?>"/>
                            </div>
                            <div class="product-price">
                                <?=($product->speed_price==0?"POA":$product->pricetxt."&nbsp;".fp($product->speed_price))?>
                            </div>
                            <div class="product-desc">
                                <p><?=strip_tags($product->title)?></p>
                            </div>
                            <div class="product-btns">
                                <!--<i class="fa fa-star fa-2x pull-left" style="color:#ABAB4B;" aria-hidden="true"></i>-->
                                <i class="finger fa fa-shopping-cart fa-2x" style="color:#88B07D;" aria-hidden="true" title="Configure and buy"></i>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>	

                </div>
            </div>
	</div>
</div>        
        <!--======================================================================-->
        
        <div  class="modal fade" id="browseShopModal"tabindex="-1" role="dialog" aria-labelledby="browseShopModalLabel">
            <div class="modal-dialog" role="Document">
		<div class="modal-content">
                    <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title" id="browseShopModalLabel">Browse our Shop</h4>
                    </div>
                    <div class="modal-body">
			<p>Select from the drop downs what you'd like to look at.</p>
                        <div style="position:relative;">
                            <select id="xs-brand" class="rad" style="padding-left:10px; margin-bottom: 20px; height:40px; background:#FFFFFF; -webkit-appearance: none; -moz-appearance:none; appearance:none;">
                                <option>Featured Items</option>
                                <option>All</option>
                                <?php foreach($LeftMenu["brand"] as $key => $brand): ?>
                                <option value="<?=str_replace("=", "#", base64_encode($key))?>"<?=(strtolower($key)==strtolower($sel['brand']) ? " selected" : "")?>><?=$key?></option>
                                <?php endforeach; ?>
                            </select><i class="fa fa-chevron-down" aria-hidden="true" style="color:#7DA2B0; position:absolute; top:15px; right:15px;"></i>
                        </div>
                        <div style="position:relative;">
                            <select id="xs-type" class="rad" style="padding-left:10px; margin-bottom: 20px; height:40px; background:#FFFFFF; -webkit-appearance: none; -moz-appearance:none; appearance:none;">
                                <?php foreach($LeftMenu["brand"] as $key => $brand): ?>
                                <?php foreach($LeftMenu["brand"][$key] as $key2 => $type): ?>
                                <?php if($key2 != "-"): ?>
                                <option class="<?=str_replace("=", "#", base64_encode($key))?>" value="<?=base64_encode($key2)?>"<?=(strtolower($key2)==strtolower($sel['type']) ? " selected" : "")?>><?=$key."-".$key2?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                            </select><i class="fa fa-chevron-down" aria-hidden="true" style="color:#7DA2B0; position:absolute; top:15px; right:15px;"></i>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="xsgo" type="button" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> Go</button>
                        <!--<button type="button" class="btn btn-default pull-left"><i class="fa fa-star" aria-hidden="true" style="color:#ABAB4B;"></i> My Star Items</button>-->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        
        
        
        <!--======================================================================-->

        <?php $this->load->view('footer'); ?>

        <?php echo Modules::run('storage')?>

        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/jquery.hammer.js')?>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-select/js/bootstrap-select.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/craftpip-select/js/bootstrap-fullscreen-select.js')?>"></script>
        <?php if(isset($scripts)):?>
            <?php foreach($scripts as $script):?>
            <script type="text/javascript" src="<?=$script?>"></script>
            <?php endforeach;?>
        <?php endif?>
        <script type="text/javascript" src="<?=base_url('assets/js/base64.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/app.js?v=1')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/product.js')?>"></script>

        <?php if(isset($google_conversions)): ?>        
            <?php foreach($google_conversions as $gc): ?>
            <?php $this->load->view("shared/campaign/".$gc)?>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <script type="text/javascript">
            $(function () {
//                var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
//                hh = (h-60)+"px";      
//                $("#modelmiddle2").css("height", hh);
            });
            
//            function modalPlay(s) {
//                if(s == "hide") {
//                    $('#modeltop').hide();
//                    $('body').css("overflow", "auto");
//                } else {
//                    
//                    
//                    
//                    $('#modeltop').show();
//                    $('body').css("overflow", "hidden");
//                    
//                    var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
//                    hh = (h-60)+"px";      
//                    $("#modeltop #modelmiddle").css("height", hh);
//                }
//            }
//            function go(url) {
//                window.location.href= url;
//            }
//            
//            function go64(url) {
//                go(path+"product/"+Base64.decode(url).replace(new RegExp("#", 'g'),"/"));
//            }
            
            
        </script>
        
    </body>

</html>
