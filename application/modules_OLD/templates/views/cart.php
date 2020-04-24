<!DOCTYPE html>
<html>
    <head>
        
        <title><?=$meta['title']?></title>        
    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <meta name="title" content="<?=$meta['title']?>">
        <meta name="description" content="<?=$meta['description']?>">
        <meta name="keywords" content="<?=$meta['keywords']?>">
        <meta name="author" content="Graham Simmons">
        
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel='shortcut icon' type='image/x-icon' href='<?=base_url('assets/ico/favicon.ico')?>' />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-select/css/bootstrap-select.min.css')?>" />
        <?php if(isset($css)):?>
            <?php foreach($css as $css):?>
            <link rel="stylesheet" type="text/css" href="<?=$css?>" />
            <?php endforeach;?>
        <?php endif?>
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/app.css?a='.microtime())?>">
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/mmenu/css/jquery.mmenu.all.css')?>">
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
        
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
        
        <!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
        <script type="text/javascript">
            window.cookieconsent_options = {"message":"This website uses cookies to ensure you get the best experience on our website","dismiss":"Got it!","learnMore":"More info","link":null,"theme":"dark-floating"};
        </script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
        <!-- End Cookie Consent plugin -->
        
    </head>
    
    <body>
        
        <div id="wrap">
            
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <img onclick="API.open();return false;" class="menu visible-xs finger" title="Open menu." style="position:static; margin-top:5px; overflow:auto;" src="<?=$this->config->item("domainLOCAL").'/assets/img/menu.jpg';?>">
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
                            <a class="open-mmenu" href="#menu" title="Open menu."><img id="logo" class="img-responsive" src="<?=$this->config->item("domainLIVE").'assets/img/logo_b.png';?>" alt="Offord &amp; Sons Logo"></a>
                            
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
                                <div class="col-xs-12 social_col">
                                    <?php $this->load->view("shared/social")?>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 view">                        
                            <?php $this->load->view($view)?>
                        </div>
                    </div>
                    
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
        
        <script type="text/javascript" src="http://hammerjs.github.io/dist/hammer.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets/mmenu/js/jquery.mmenu.min.all.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-select/js/bootstrap-select.min.js')?>"></script>
        <?php if(isset($scripts)):?>
            <?php foreach($scripts as $script):?>
            <script type="text/javascript" src="<?=$script?>"></script>
            <?php endforeach;?>
        <?php endif?>
        <script type="text/javascript" src="<?=base_url('assets/js/menu.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/cart.js')?>"></script>
        
    </body>
    
</html>
