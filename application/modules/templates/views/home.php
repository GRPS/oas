<!DOCTYPE html>
<html>
    <head>

        <title>Offord &amp; Sons - Independent Jewellers in Hampshire</title>

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

        <link rel='stylesheet' type='text/css' media="all" href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900'>
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-select/css/bootstrap-select.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/css/app.css')?>">

        <?php if(isset($css)):?>
            <?php foreach($css as $css):?>
            <link rel="stylesheet" type="text/css" href="<?=$css?>" />
            <?php endforeach;?>
        <?php endif?>

        <!--[if lt IE 9]>
            <script src="<?=base_url('assets/bootstrap/js/html5shiv.js')?>"></script>
            <script src="<?=base_url('assets/bootstrap/js/respond.min.js')?>"></script>
        <![endif]-->

        <!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
        <script type="text/javascript">
            var path = '<?=site_url();?>';
            window.cookieconsent_options = {"message":"This website uses cookies to ensure you get the best experience on our website","dismiss":"Got it!","learnMore":"More info","link":null,"theme":"dark-floating"};
        </script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
        <!-- End Cookie Consent plugin -->
   
    </head>

    <body style="background-color: #f5f5f5;">

    <div id="fb-root"></div>

        <?php $this->load->view('shared/menu_top'); ?>
        <?php $this->load->view('shared/header'); ?>

        <div class="container">
            
            <div class="row mt">
                <?php foreach($panels as $i => $p): ?>
                <div class="<?=$p->col?> mb">
                    <?php if($p->use_scroller == "No"):?>
                        <?php if($p->banner != null && $p->banner != ""): ?>
                            <?php if(substr(strtolower($p->link), 0, 4) == "http"): ?>
                            <a href="<?=$p->link?>" title="<?=$p->title?>">
                            <?php else: ?>
                            <a href="<?=base_url($p->link)?>" title="<?=$p->title?>">
                            <?php endif; ?>
                        <?php endif; ?>
                            <img class="img-responsive" src="<?=base_url('assets/img/panels/'.$p->banner)?>" alt="<?=$p->banner?>" />
                        <?php if($p->banner != null && $p->banner != ""): ?>
                        </a>
                        <?php endif; ?>
                    <?php else: ?>
                    <?php
                    $sss = explode("\n", strip_tags($p->scroller));
                    $interval = $sss[0];
                    array_shift($sss);
                    ?>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="<?=$interval?>">
                        <ol class="carousel-indicators">
                        <?php foreach($sss as $i => $p): ?>
                        <li data-target="#myCarousel" data-slide-to="<?=$i?>"<?=($i==0?'class="active"':'')?>></li>
                        <?php endforeach; ?>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                        <?php foreach($sss as $ii => $ssss): 
                            $item = explode("|", $ssss)
                            ?>
                            <div class="item<?=($ii==0?' active':'')?>">
                                <a href="<?=$item[1]?>">
                                    <img src="<?=str_replace("/new","",base_url('assets/img/panels/'.$item[0]))?>" alt="<?=$item[0]?>">
                                    <?php if($item[2] != ""): ?>
                                    <div class="carousel-caption">
                                        <h3><?=$item[2]?></h3>
                                        <p><?=$item[3]?></p>
                                    </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>    
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            
            
        </div> 
    
        <?php $this->load->view('footer'); ?>

        <?php echo Modules::run('storage')?>

        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/jquery.hammer.js')?>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-select/js/bootstrap-select.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/app.js?v=1')?>"></script>
        <?php if(isset($scripts)):?>
            <?php foreach($scripts as $script):?>
            <script type="text/javascript" src="<?=$script?>"></script>
            <?php endforeach;?>
        <?php endif?>

    </body>

</html>
