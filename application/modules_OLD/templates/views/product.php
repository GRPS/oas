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

        <img src="<?=base_url('assets/img/banner_watches.jpg')?>" alt="banner" style="width:100%;"/>

        <!--======================================================================-->
        
        <div id="left-menu" class="container-fluid" style="margin-top:20px;">

            <div class="row">
                <div class="hidden-xs col-sm-4 col-md-3">
                                        
                    <ul class="list-group">
                        
                        <li class="list-group-item">
                            <div class="demo">
                                <input type="radio" name="opts" class="faStr"><label>My Star Items (?)</label>
                            </div>
                        </li>

                        <!-- ?Family -->
                        <li class="list-group-item" style="font-family:Cabin,arial,helvetica,sans-serif; font-weight:700; text-transform: uppercase; background-color:#7DA2B0; color:#ffffff;"><?=$family?></li>

                        <!-- ?Featured items or first 8 -->
                        <li class="list-group-item">
                            <div class="demo">
                                <input type="radio" name="opts" name="opts" class="faFlag"<?=(base64_encode(strtolower($family)."##")==$radio_selector?" checked" : "")?>><label>Featured items (<?=$feature_count?>)</label>
                            </div>
                        </li>

                        <!-- ?All -->
                        <li class="list-group-item">
                            <div class="demo">
                                <input type="radio" name="opts" class="faTh"<?=(base64_encode(strtolower($family)."#all#")==$radio_selector?" checked" : "")?>><label>Show all items (<?=$LeftMenu["All"]?>)</label>
                            </div>
                        </li>

                        <?php foreach($LeftMenu["brand"] as $key => $brand): ?>
                        <!-- ?Brand -->
                        <li class="list-group-item">
                            <label><?=$key?></label>
                            <div class="demo demo<?=(count($LeftMenu['brand'][$key])>6?"-overflow":"")?>">
                                <?php foreach($brand as $a => $b): ?>
                                <input type="radio" name="opts" class="faChkRnd" onclick="go('<?=base_url('product/'.$family.'/'.$key.'/'.$a)?>');"<?=(base64_encode(strtolower($family."#".$key."#".$a))==$radio_selector?" checked" : "")?>><label><?=$a?> (<?=$b?>)</label><br />
                                <?php endforeach; ?>
                            </div>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                    
                </div>
                
                <div class="col-sm-8 col-md-9">

                    <div class="visible-xs" style="margin-bottom:20px;">
                        <span class="product-browse" data-toggle="modal" data-target="#browseShopModal">Browse our shop</span>
                    </div>

                    <div class="callout-left" style="margin-bottom:20px;">
                        <h4 style="margin-top:0px;"><?=implode(" : ", $breadcrumb)?><small> (<?=count($products)?>)</small></h4>
                        <p><?=$product_msg['msg']?></p>
                        <p><?=$description?></p>
                    </div>

                    <?php foreach($products as $product): ?>
                    <div class="product-box">
                        <div class="product-wrap rad">
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
                                <i class="fa fa-star fa-2x pull-left" style="color:#ABAB4B;" aria-hidden="true"></i>
                                <i class="fa fa-shopping-cart fa-2x pull-right" style="color:#88B07D;" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>	

                </div>
            </div>
	</div>
        
        <!--======================================================================-->

        <?php //$this->load->view('footer'); ?>

        <?php echo Modules::run('storage')?>

        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/jquery.hammer.js')?>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-select/js/bootstrap-select.min.js')?>"></script>
        <?php if(isset($scripts)):?>
            <?php foreach($scripts as $script):?>
            <script type="text/javascript" src="<?=$script?>"></script>
            <?php endforeach;?>
        <?php endif?>
        <script type="text/javascript" src="<?=base_url('assets/js/app.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/product.js')?>"></script>

    </body>

</html>
