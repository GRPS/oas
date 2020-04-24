<!DOCTYPE html>
<html>
    <head>
        
        <title><?=$meta['title']?></title>        
    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <meta name="description" content="<?=$meta['description']?>">
        <meta name="keywords" content="<?=$meta['keywords']?>">
        <meta name="author" content="Graham Simmons">
        
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel='shortcut icon' type='image/x-icon' href='<?=base_url('assets/ico/favicon.ico')?>' />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-tour/css/bootstrap-tour.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-select/css/bootstrap-select.min.css')?>" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/mmenu/css/jquery.mmenu.all.css')?>">
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
    </head>
    
    <body>
        
        <div id="wrap">
            
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <a class="menu" href="#menu"><span class="pull-left" style="margin-left:50px; color:#fff;">Menu</span></a>                
                        </div>
                        <div class="col-sm-8" style="text-align: right;">       
                            <span id="shopping_cart" class="show_cart" style="z-index:10000;"><i class="glyphicon glyphicon-shopping-cart" data-toggle="tooltip" data-placement="bottom" title="Open shopping cart"></i>&nbsp;Shopping Cart:&nbsp;<span class="badge alert-info"><?=$cart_badge->cnt.($cart_badge->cnt!=1?" items":" item").($cart_badge->cnt>0?" @ ".$cart_badge->price:"")?></span></span>
                        </div>
                    </div>
                </div>
            </div> <!-- header -->

            <div class="content">
                <div class="container">
                    
                    <div class="row">
                    
                        <div class="col-sm-5 mt">                        
                            <a href="#menu" title="Open menu."><img id="logo" class="img-responsive" src="<?=$this->config->item("domainLIVE").'/img/logo.jpg';?>" alt="Offord &amp; Sons Logo"></a>
                        </div>

                        <div class="col-sm-7 mt">
                            <div class="row">
                                <div class="col-xs-12 col-lg-2">
                                    <span class="label label-default pull-right restart_tour finger" title="Take a tour of our site.">Take a tour!</span>
                                </div>
                                <div class="col-xs-12 col-lg-10">
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

                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 view">     
                            <?php if(isset($slider_html)): ?>
                            <?=$slider_html;?>
                            <?php endif; ?>
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
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-tour/js/bootstrap-tour.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-select/js/bootstrap-select.min.js')?>"></script>
        <?php if(isset($scripts)):?>
            <?php foreach($scripts as $script):?>
            <script type="text/javascript" src="<?=$script?>"></script>
            <?php endforeach;?>
        <?php endif?>
        <script type="text/javascript" src="<?=base_url('assets/js/app.js')?>"></script>
        
    </body>
    
</html>
