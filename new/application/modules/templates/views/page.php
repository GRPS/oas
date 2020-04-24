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
<div class="container">
        <img src="<?=base_url('assets/img/'.$page->banner)?>" alt="banner" style="width:100%;"/>

        
            <div class="row">
                <div class="col-xs-12">
                    
                    
                    <?php if(strtolower($title) == "contact us"): ?>
                        <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="callout-left bs-callout-info" style="margin-bottom:20px;">
                                    <?php if ($page->h1 == ""): ?>
                                    <h1><?=$title?></h1>
                                    <?php else: ?>
                                    <h1><?=$page->h1?></h1>
                                    <h2><?=$page->h2?></h2>
                                    <?php endif; ?>
                                    </div>

                                    <?=$page->content?>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    
                                    <div class="callout-left bs-callout-info" style="margin-bottom:20px;">
                                        <h1>Enquiry Form</h1>
                                    </div>
                                    
                                    <form class="form-horizontal" role="form" method="post" action="<?=site_url('contact-us')?>">
                                        <div class="form-group">
                                                <label for="name" class="col-sm-3 control-label">Name</label>
                                                <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($name); ?>">
                                                        <?php echo "<p class='text-danger'>$errName</p>";?>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="email" class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($email); ?>">
                                                        <?php echo "<p class='text-danger'>$errEmail</p>";?>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="message" class="col-sm-3 control-label">Message</label>
                                                <div class="col-sm-9">
                                                        <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($message);?></textarea>
                                                        <?php echo "<p class='text-danger'>$errMessage</p>";?>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="human" class="col-sm-3 control-label">2 + 3 = ?</label>
                                                <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
                                                        <?php echo "<p class='text-danger'>$errHuman</p>";?>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-3">
                                                        <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-3">
                                                        <?php echo $result; ?>	
                                                </div>
                                        </div>
                                    </form> 
                                </div>
                        </div>
                    <?php else: ?>
                    <div class="callout-left bs-callout-info" style="margin-bottom:20px;">
                                    <?php if ($page->h1 == ""): ?>
                                    <h1><?=$title?></h1>
                                    <?php else: ?>
                                    <h1><?=$page->h1?></h1>
                                    <h2><?=$page->h2?></h2>
                                    <?php endif; ?>
                                    </div>
                    <?=$page->content?>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>

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

    </body>

</html>
