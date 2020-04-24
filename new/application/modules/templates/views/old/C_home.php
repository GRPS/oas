<!DOCTYPE html>
<html>
    <head>
        
        <title><?=$meta['title']?></title>        
    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="p:domain_verify" content="bb94036334a5f9a64ac7fa85c64abf37"/>
    
        <meta name="description" content="<?=$meta['description']?>">
        <meta name="keywords" content="<?=$meta['keywords']?>">
        <meta name="author" content="Graham Simmons">
        
<!--        <meta property="og:url"           content="http://www.offordandsons.co.uk" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="High quality jewellery and watches | Romsey &amp; Winchester in Hampshire" />
        <meta property="og:description"   content="High quality jewellery and watches and based in Romsey and Winchester in Hampshire areas." />
        <meta property="og:image"         content="http://www.offordandsons.co.uk/assets/img/4a.jpg" />-->

        <meta property="og:url"           content="<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="<?=$meta['title']?>" />
        <meta property="og:description"   content="<?=$meta['description']?>" />
        <meta property="og:image"         content="<?=$this->config->item("domainIMG").$meta['image']?>" />
    
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel='shortcut icon' type='image/x-icon' href='<?=base_url('assets/ico/favicon.ico')?>' />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-tour/css/bootstrap-tour.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-select/css/bootstrap-select.min.css')?>" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/mmenu/css/jquery.mmenu.all.css')?>">
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-social/bootstrap-social.css')?>" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/app.css?a='.microtime())?>">
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/owl-slider/owl.carousel.css')?>">
        <?php if(isset($css)):?>
            <?php foreach($css as $css):?>
            <link rel="stylesheet" type="text/css" href="<?=$css?>" />
            <?php endforeach;?>
        <?php endif?>
            
        <!--[if lt IE 9]>
            <script src="<?=base_url('assets/bootstrap/js/html5shiv.js')?>"></script>
            <script src="<?=base_url('assets/bootstrap/js/respond.min.js')?>"></script>
        <![endif]-->

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url('assets/ico/favicon.png')?>">
        <link rel="shortcut icon" href="<?=base_url('assets/ico/favicon.ico')?>">
    
        <script type="text/javascript">
        var path = '<?=site_url();?>';
        var img_wait_small = '<img src="<?=site_url();?><?=$this->config->item("wait_small")?>">';
        var POA = '<?=$this->config->item("PriceOnApplication");?>';
        </script>
        
        <style>
            .fa {
                    margin: 0 10px 0 0px !important;
                    font-size: 16px !important;
                    width: 10px !important;
                }
        </style>
        
        <style>
        #owl-demo {
            
        }
        #owl-demo .item{
            background: #fff;
            padding: 0px 0px;
            margin: 10px;
            color: #FFF;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            text-align: center;
            border: 1px solid #c4c4c4;
            overflow:hidden;
            height:197px;
        }
        #owl-demo .item a {
            xtext-align: center;
            xposition:relative;
        }
        #owl-demo .item a img {
            height:160px;
            
        }
        #owl-demo .item a p {
            color: #ffffff;
            background:rgba(0, 0, 0, 0.60);
            height: auto;/*30px;*/
            line-height: 37px; /*30px;*/
            min-height: 37px;
            margin:0;
            font-size: 12px;
            
            
        }
        .customNavigation{
          text-align: center;
        }
        .xcustomNavigation a{
          -webkit-user-select: none;
          -khtml-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
          -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
          
          background-color:#c4c4c4;
        }
    </style>
    
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

        <div id="wrap">
            
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <img onclick="API.open();return false;" class="menu visible-xs finger" title="Open menu." style="position:static; margin-top:5px; overflow:auto;" src="<?=$this->config->item("domainIMG").'menu.jpg';?>">
                            <span>
                                <a class="hidden-xs" href="#menu" title="Open menu."><span class="pull-left" style="margin-left:50px; color:#fff;">Menu</span></a>
                                <span id="shopping_cart" class="finger show_cart" title="Open shopping cart." style="z-index:10000; position:absolute; right:20px;"><i class="glyphicon glyphicon-shopping-cart" data-toggle="tooltip" data-placement="bottom" title="Open shopping cart"></i>&nbsp;Shopping Cart:&nbsp;<span class="badge alert-info"><?=$cart_badge->cnt.($cart_badge->cnt!=1?" items":" item").($cart_badge->cnt>0?" @ ".$cart_badge->price:"")?></span></span>
                            </span>
                        </div>                        
                    </div>
                </div>
            </div> <!-- header -->

            <div class="content">
                <div class="container">
                    
                    <div class="row">
                    
                        <div class="col-sm-5 mt">                        
                            <a class="open-mmenu" href="#menu" title="Open menu."><img id="logo" class="img-responsive" src="<?=$this->config->item("domainIMG").'logo_b.png';?>" alt="Offord &amp; Sons Logo"></a>
                            <br>
                            <span class="label label-default restart_tour finger pls prs pts pbs" title="Take a tour of our site.">Take a tour!</span>
                        </div>

                        <div class="col-sm-7 mt">
                            <div class="row">
                                
                                <div class="col-xs-12 col-lg-10 pull-right">
                                    <a href="mailto:shop@offordandsons.co.uk" class="label label-info contact email" title="Email us."><span class="glyphicon glyphicon-envelope"></span> shop@offordandsons.co.uk</a>
                                    <a href="tel:01962867772" class="label label-info contact phone" title="Give us a call."><span class="glyphicon glyphicon-earphone"></span> 01962 867772</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <form class="form-inline pull-right mts" role="form" method="GET" action="<?=base_url('/product/');?>">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                                                <input id="search" class="form-control" name="search" type="text">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php $this->load->view("shared/social2")?>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    
                    <?php if($page->id == "Home"): ?>
                </div>    
                            <?=$slider_html;?>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 view">
                            <?php $this->load->view("onehome")?>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row">
                        <div class="col-xs-12 view">
                            <?php $this->load->view($view)?>
                        </div>
                    </div>
                    <?php endif; ?>                        
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <?php echo Modules::run('storage')?>
                        </div>
                    </div>
                    
                </div>
            </div> <!-- content -->
            
        </div> <!-- wrap -->

        <?php $this->load->view('footer'); ?>

        <nav id="menu"><?=$menu->content?></nav>     
        
        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/jquery.hammer.js')?>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets/mmenu/js/jquery.mmenu.min.all.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-tour/js/bootstrap-tour.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-select/js/bootstrap-select.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/owl-slider/owl.carousel.min.js')?>"></script>
        <?php if(isset($scripts)):?>
            <?php foreach($scripts as $script):?>
            <script type="text/javascript" src="<?=$script?>"></script>
            <?php endforeach;?>
        <?php endif?>
        <script type="text/javascript" src="<?=base_url('assets/js/app.js?a='.microtime())?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/slider.js')?>"></script>
    </body>
    
</html>
